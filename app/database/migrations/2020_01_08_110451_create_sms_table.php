<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sms', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('message_id')->default(0);
            $table->string('message')->nullable();
            $table->integer('status')->default(0);
            $table->string('statustext')->nullable();
            $table->string('sender')->nullable();
            $table->string('receptor')->nullable();
            $table->string('date')->nullable();

            $table->float('cost')->default(0);


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
        Schema::dropIfExists('sms');
    }
}
