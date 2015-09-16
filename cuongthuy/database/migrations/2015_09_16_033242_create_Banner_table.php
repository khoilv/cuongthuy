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
            $table->increments('banner_id');
            $table->string('banners_title',64);
            $table->string('banners_url',100);
            $table->datetime('expires_date');
            $table->datetime('date_added');
            $table->unsignedInteger('status');
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
