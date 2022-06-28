<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToVideoCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_categories', function (Blueprint $table) {
            $table->foreign(['category_id'], 'fk_video_categories_categories1')->references(['id'])->on('categories')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['video_id'], 'fk_video_categories_videos1')->references(['id'])->on('videos')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_categories', function (Blueprint $table) {
            $table->dropForeign('fk_video_categories_categories1');
            $table->dropForeign('fk_video_categories_videos1');
        });
    }
}
