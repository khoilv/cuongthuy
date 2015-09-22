<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductRatingTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('ProductRating', function(Blueprint $table)
        {
            $table->increments('product_id');
            $table->unsignedInteger('count_start_1')->default(0);
            $table->unsignedInteger('count_start_2')->default(0);
            $table->unsignedInteger('count_start_3')->default(0);
            $table->unsignedInteger('count_start_4')->default(0);
            $table->unsignedInteger('count_start_5')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('ProductRating');
    }
}
