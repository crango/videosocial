<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('video');
            $table->string('cover')->nullable();
            $table->string('title', 20);
            $table->string('about');
            $table->enum('type', ['1', '2'])->default('1')->comment('1: Public 2: Private');
            $table->enum('monetize', ['0', '1'])->default('0')->comment('0: No 1: Yes');
            $table->enum('status', ['1', '2', '3'])->default('1')->comment('1: Review 2: Approved 3: Disapproved');
            $table->string('license', 20)->nullable();
            $table->string('lang', 20)->nullable();
            $table->string('cast')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('dislikes')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
