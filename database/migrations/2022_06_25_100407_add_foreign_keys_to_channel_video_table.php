<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToChannelVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channel_video', function (Blueprint $table) {
            $table->foreign(['channel_id'], 'fk_channel_video_channels')->references(['id'])->on('channels')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['video_id'], 'fk_channel_video_videos')->references(['id'])->on('videos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('channel_video', function (Blueprint $table) {
            $table->dropForeign('fk_channel_video_channels');
            $table->dropForeign('fk_channel_video_videos');
        });
    }
}
