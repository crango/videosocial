<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index('fk_suscribers_user_id');
            $table->unsignedBigInteger('channel_id')->index('fk_suscribers_channel_id');
            $table->tinyInteger('status')->default(0);
            $table->primary(['user_id', 'channel_id']);
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
        Schema::dropIfExists('subscribers');
    }
}
