<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug', 500);
            $table->string('description', 700);
            $table->text('detail_info');
            $table->string('image', 1000);
            $table->double('price');
            $table->enum('status', ['Công khai', 'Đơi duyệt']);
            $table->boolean('hot');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('cat_id')->constrained('product_cats');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
