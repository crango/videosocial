<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_video', function (Blueprint $table) {
            $table->unsignedBigInteger('video_id')->index('fk_channel_video_video_id');
            $table->unsignedBigInteger('channel_id')->index('fk_channel_video_channel_id');
         //   $table->primary(['video_id', 'channel_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_video');
    }
}
