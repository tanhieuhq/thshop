<?php
use App\Product;
use App\ProductCat;

session_start();
ob_start();
if (!function_exists('data_tree_c')) {
    function data_tree_c($data, $parent_id = 0, $level = 0)
    {
        global $tring;
        if ($level == 0) {
            $tring .= "<ul class='list-item'>";
        } else {
            $tring .= "<ul class='sub-menu'>";
        }
        foreach ($data as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $tring .= "<li><a href='" . "san-pham" . "/" . $item['slug'] . "' title=''>" . $item['name'] . "</a>";
                unset($data[$key]);
                data_tree_c($data, $item['id'], $level + 1);
                $tring .= "</li>";
            }
        }
        $tring .= "</ul>";
        return $tring;
    }
}

if (!function_exists('render_menu')) {
    function render_menu($data, $parent_id = 0, $level = 0)
    {
        global $tring2;
        if ($level == 0) {
            $tring2 .= "<ul id='main-menu-respon'>";
        } else {
            $tring2 .= "<ul class='sub-menu'>";
        }
        foreach ($data as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $tring2 .= "<li><a href='" . "san-pham" . "/" . $item['slug'] . "' title=''>" . $item['name'] . "</a>";
                unset($data[$key]);
                render_menu($data, $item['id'], $level + 1);
                $tring2 .= "</li>";
            }
        }
        $tring2 .= "</ul>";
        return $tring2;
    }
}

if (!function_exists('get_data_index')) {
    function get_data_index()
    {
        $product_cat = ProductCat::all();
        $data_tree_c = data_tree_c($product_cat);
        $data_tree = str_replace("<ul class='sub-menu'></ul>", '', $data_tree_c);

        $product_cat2 = ProductCat::all();
        $menu = render_menu($product_cat2);
        $render_menu = str_replace("<ul class='sub-menu'></ul>", '', $menu);

        $hot_products = Product::where('hot', 1)->get();
        session(['data_tree'=>$data_tree,'render_menu'=>$render_menu,'hot_products'=>$hot_products]);
    }
}

function get_product_cat($id)
{
    global $id_list;
    $productCat = ProductCat::where('parent_id', $id)->get();
    if (!empty($productCat)) {
        foreach ($productCat as $key => $item) {
            $id_list[] = $item['id'];
            unset($productCat[$key]);
            get_product_cat($item['id']);
        }
    }
    return $id_list;
}

function get_product_list($id)
{
    $idl = get_product_cat($id);
    $idl[] = $id;
    $products = [];
    foreach ($idl as $item) {
        $product = Product::where('cat_id', $item)->get();
        if (count($product) > 0) {
            foreach ($product as $item) {
                $products[] = $item;
            }
        }
    }
    return $products;
}

function get_laptop_product_cat($id)
{
    global $laptop_id_list;
    $productCat = ProductCat::where('parent_id', $id)->get();
    if (!empty($productCat)) {
        foreach ($productCat as $key => $item) {
            $laptop_id_list[] = $item['id'];
            unset($productCat[$key]);
            get_laptop_product_cat($item['id']);
        }
    }
    return $laptop_id_list;
}



function get_laptop_product_list($id)
{
    $idl = get_laptop_product_cat($id);
    $idl[] = $id;
    $products = [];
    foreach ($idl as $item) {
        $product = Product::where('cat_id', $item)->get();
        if (count($product) > 0) {
            foreach ($product as $item) {
                $products[] = $item;
            }
        }
    }
    return $products;
}
