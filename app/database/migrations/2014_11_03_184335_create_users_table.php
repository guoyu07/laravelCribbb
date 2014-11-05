<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
	        $table->string('username')->unique();
	        $table->string('password');
	        $table->boolean('gender');
	        $table->date('birthday')->nullable();
	        $table->string('mobile')->unique();
	        $table->string('email')->unique();
	        $table->string('name');
	        $table->rememberToken()->nullable();
	        $table->boolean('active')->default(true);
	        $table->tinyInteger('userlevel')->default(1);
	        $table->dateTime('lastlogin')->nullable();
	        $table->integer('logintimes')->default(1);
	        $table->dateTime('lastloginfail')->nullable();
	        $table->tinyInteger('loginfailtimes')->default(0);
	        $table->string('ip')->nullable();
	        $table->string('uuid')->nullable();
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
		Schema::drop('users');
	}

}
