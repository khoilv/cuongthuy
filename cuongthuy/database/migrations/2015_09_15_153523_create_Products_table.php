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
            $table->float('product_rating');
            $table->unsignedInteger('product_price');
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
