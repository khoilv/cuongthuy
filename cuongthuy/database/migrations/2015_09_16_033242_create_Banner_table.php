<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('Banner', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('banner_title',64);
            $table->string('banner_url',100);
            $table->datetime('banner_expires_date');
            $table->datetime('banner_date_added');
            $table->unsignedInteger('banner_status');
			$table->string('banner_image_path');			
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('Banner');
    }
}
