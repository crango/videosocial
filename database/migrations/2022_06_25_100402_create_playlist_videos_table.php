<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_videos', function (Blueprint $table) {
            $table->unsignedBigInteger('playlist_id')->index('fk_playlist_videos_playlist_id');
            $table->unsignedBigInteger('video_id')->index('fk_playlist_videos_video_id');
            $table->unsignedInteger('order')->default(0);
            $table->primary(['playlist_id', 'video_id']);
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
        Schema::dropIfExists('playlist_videos');
    }
}
