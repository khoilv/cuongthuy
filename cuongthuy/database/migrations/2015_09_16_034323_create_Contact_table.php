<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Contact', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('contact_name',50);
            $table->string('contact_email');
            $table->text('contact_content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('Contact');
    }
}
