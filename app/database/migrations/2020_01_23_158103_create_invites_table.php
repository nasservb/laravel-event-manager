<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('sender_user_id')->unsigned()->index();
            $table->foreign('sender_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->bigInteger('event_id')->unsigned()->index();
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->bigInteger('receiver_user_id')->unsigned()->index();
            $table->foreign('receiver_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');


            $table->enum('send_status',['sending','sent','failed']);


            $table->enum('is_accept',['no-response','yes','no','maybe'])->default('no-response');

            $table->boolean('is_read')->default(0);

            $table->timestamp('responded_at')->nullable();

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
        Schema::dropIfExists('invites');
    }
}
