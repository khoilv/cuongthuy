<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Products', function(Blueprint $table){
            $table->increments('product_id');
            $table->string('product_name',100);
            $table->string('product_code',50);
            $table->unsignedInteger('product_status');
            $table->unsignedInteger('product_category');
            $table->string('product_image')->nullable();
            $table->string('product_other_image')->nullable();
            $table->string('product_short_description');
            $table->text('product_description');
            $table->unsignedInteger('product_quantity');
            $table->unsignedInteger('product_price');
            $table->unsignedInteger('product_discount_price')->nullable();
            $table->tinyInteger('product_discount_flag');
            $table->tinyInteger('product_display');
            $table->tinyInteger('product_type')->nullable();
            $table->datetime('product_date_added');
            $table->datetime('product_date_modify')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Products');
    }

}
