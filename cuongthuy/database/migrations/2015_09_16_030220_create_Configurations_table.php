<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Configurations', function(Blueprint $table)
        {
            $table->increments('configuration_id');
            $table->string('configuration_key',64);
            $table->string('configuration_value');
            $table->string('configuration_description')->nullable();
            $table->datetime('date_added');
            $table->datetime('last_modify');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('Configurations');
    }
}
