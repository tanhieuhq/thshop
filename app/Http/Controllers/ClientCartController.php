<?php

namespace App\Http\Controllers;


use App\Detail_order;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ClientCartController extends Controller
{
    public function __construct()
    {
        get_data_index();
    }
    function index()
    {
        return view('client.cart.cart');
    }
    function add($id, $request)
    {
        $product = Product::find($id);
        $image = json_decode($product->image);
        if ($request->input('num-order')) {
            $quantity = $request->input('num-order');
        } else {
            $quantity = 1;
        }
        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => $quantity,
            'price' => $product->price,
            'options' => ['image' => $image[0]]
        ])->associate(Product::class);
    }

    function addCart($slug, Request $request)
    {
        if (!isset($_SESSION["visits"]))
            $_SESSION["visits"] = 0;
        $_SESSION["visits"] = $_SESSION["visits"] + 1;
        $product = Product::where('slug', $slug)->first();
        if ($_SESSION["visits"] > 1) {
            return redirect(route('cart'));
        } else {
            $this->add($product->id, $request);
            return view('client.cart.cart');
        }
    }
    function buynow($slug, Request $request)
    {
        $product = Product::where('slug', $slug)->first();
        $this->add($product->id, $request);
        return view('client.cart.checkout');
    }
    function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('cart');
    }

    function destroy()
    {
        Cart::destroy();
        return redirect('cart');
    }

    function update(Request $request)
    {
        $data = $request->input('quantity_order');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return redirect('cart');
    }

    function updateAjax()
    {
        $rowId = $_POST['rowId'];
        $quantity = $_POST['quantity'];
        Cart::update($rowId, $quantity);
        $amount = number_format(Cart::get($rowId)->total, 0, ',', '.') . 'đ';
        $amount_total = Cart::total() . 'Đ';
        $data = array(
            'amount' => $amount,
            'amount_total' => $amount_total
        );

        echo json_encode($data);
    }

    function checkout()
    {
        return view('client.cart.checkout');
    }
    function saveOrder(Request $request)
    {
        $request->validate(
            [
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:225',
                'address' => 'required|string|max:300',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
                'note' => 'required|string|max:500'
            ],
            [
                'required' => ':attribute không được để trống',
                'max' => ':attribute có độ dài tối đa :max ký tự',
                'regex' => 'Vui lòng chỉ nhập số',
            ],
            [
                'fullname' => 'Tên người dùng',
                'email' => 'Email',
                'address' => 'Địa chỉ',
                'phone' => 'Số điện thoại',
                'note' => 'Ghi chú'
            ]
        );

        $data = $request->except('_token');
        $order = Order::create($data);
        $quantity_total = 0;
        foreach (Cart::content() as $item) {
            Detail_order::create([
                'row_id' => $item->rowId,
                'product_id' => $item->id,
                'order_id' => $order->id,
                'quantity' => $item->qty,
                'price' => $item->price,
                'amount' => $item->total,
            ]);
            $quantity_total += $item->qty;
        }
        Order::where('id', $order->id)->update(['quantity_total' => $quantity_total]);
        Cart::destroy();
        return view('client.cart.show', compact('order'));
    }
}