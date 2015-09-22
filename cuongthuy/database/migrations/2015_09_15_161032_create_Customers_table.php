<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Customers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('customer_email');
            $table->string('customer_password');
            $table->string('customer_code',50);
            $table->string('customer_name',50);
            $table->string('customer_city',50)->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_phone',50)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('Customers');
    }
}
