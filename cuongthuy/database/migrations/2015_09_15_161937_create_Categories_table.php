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
            $table->string('name');
            $table->unsignedInteger('parent')->default(1);
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
