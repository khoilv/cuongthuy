<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Orders', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->string('order_code',50);
            $table->datetime('order_date');
            $table->string('order_email');
            $table->string('order_phone')->nullable();
            $table->string('order_customer_name',50);
            $table->tinyInteger('order_status');
            $table->string('order_ship_city',50);
            $table->string('order_ship_address');
            $table->text('order_note')->nullable();
            $table->tinyInteger('payment_method');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
            Schema::drop('Orders');
    }
}
