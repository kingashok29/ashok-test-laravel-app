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
            $table->increments('id');

            $table->string('name');
            $table->string('username');
            $table->string('ref_username')->nullable();
            $table->enum('user_role', ['user', 'admin']);
            $table->string('email')->unique();
            $table->string('paypal_email')->unique()->nullable();
            $table->string('skrill_email')->unique()->nullable();
            $table->string('neteller_email')->unique()->nullable();
            $table->string('bitcoin_address', 100)->unique()->nullable();
            $table->string('profile_pic')->nullable();
            $table->text('about')->nullable();

            $table->boolean('block')->default(false);
            $table->timestamp('last_logged_in')->nullable();

            $table->string('password');
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
