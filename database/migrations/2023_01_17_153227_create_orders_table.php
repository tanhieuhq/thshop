<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('fullname', 40);
            $table->string('email', 40);
            $table->string('address', 300);
            $table->string('phone', 11);
            $table->string('note', 500);
            $table->enum('status', ['Đã thanh toán', 'Chưa thanh toán']);
            $table->unsignedSmallInteger('quantity_total');
            $table->unsignedDouble('amount_total',11);
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
        Schema::dropIfExists('orders');
    }
}
