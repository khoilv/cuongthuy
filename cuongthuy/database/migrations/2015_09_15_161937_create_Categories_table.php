<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('Categories', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('category_name');
            $table->unsignedInteger('category_parent')->default(0);
            $table->string('category_code',50);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
            Schema::drop('Categories');
    }
}
