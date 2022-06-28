<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPlaylistVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlist_videos', function (Blueprint $table) {
            $table->foreign(['playlist_id'], 'fk_playlist_videos_playlists')->references(['id'])->on('playlists')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['video_id'], 'fk_playlist_videos_videos')->references(['id'])->on('videos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('playlist_videos', function (Blueprint $table) {
            $table->dropForeign('fk_playlist_videos_playlists');
            $table->dropForeign('fk_playlist_videos_videos');
        });
    }
}
