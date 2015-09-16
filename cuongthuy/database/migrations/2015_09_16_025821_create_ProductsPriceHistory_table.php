<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsPriceHistoryTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ProductsPriceHistory', function(Blueprint $table)
        {
            $table->increments('product_id');
            $table->string('product_price',100);
            $table->datetime('product_datetime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ProductsPriceHistory');
    }
}
