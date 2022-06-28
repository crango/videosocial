<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVideoChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_channels', function (Blueprint $table) {
            $table->foreign(['channel_id'], 'fk_video_channels_channels')->references(['id'])->on('channels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['video_id'], 'fk_video_channels_videos')->references(['id'])->on('videos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_channels', function (Blueprint $table) {
            $table->dropForeign('fk_video_channels_channels');
            $table->dropForeign('fk_video_channels_videos');
        });
    }
}
