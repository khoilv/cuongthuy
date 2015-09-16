<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('OrderDetail', function(Blueprint $table)
        {
            $table->increments('order_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('UnitPrice');
            $table->unsignedInteger('Quantity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
            Schema::drop('OrderDetail');
    }
}
