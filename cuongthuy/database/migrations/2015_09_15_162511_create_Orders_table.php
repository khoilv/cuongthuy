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
            $table->increments('order_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->datetime('order_date');
            $table->string('order_email');
            $table->string('order_user_fistname',50);
            $table->string('order_user_lastname',50);
            $table->unsignedInteger('order_status');
            $table->string('order_ship_city',50);
            $table->string('order_ship_address');
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
