<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name',128)->index();
            $table->string('family',128)->nullable();
            $table->string('email')->unique();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('sms_verified_at')->nullable();

            $table->string('password',256);
			
			$table->string('api_token',256)->nullable();
			$table->boolean('is_active')->default(0);

			$table->string('mobile', 25)->nullable();

			$table->string('avatar_url', 255)->nullable();

			
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
