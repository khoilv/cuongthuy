<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCommentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('Product_Comments', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('product_id');
            $table->text('comment_content');
            $table->string('comment_username',50);
            $table->datetime('comment_datetime');
            $table->unsignedInteger('comment_parent_id')->nullable();
            $table->unsignedInteger('comment_like');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('Product_Comments');
    }
}
