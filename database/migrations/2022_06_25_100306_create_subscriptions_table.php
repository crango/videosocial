<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index('fk_subscriptions_user_id');
            $table->unsignedBigInteger('channel_id')->index('fk_subscriptions_channel_id');
            $table->enum('status', ['1', '2'])->default('1')->comment('1: Active 2: Inactive');
            $table->primary(['user_id', 'channel_id']);
            $table->timestamps();
        });
    } //

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
