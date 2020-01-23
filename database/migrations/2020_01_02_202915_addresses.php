<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Addresses extends Migration {

	/**
		* Run the migrations.
		*
		* @return void
		*/
	public function up() {

		Schema::create('addresses', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('first_name', 191);
			$table->string('last_name', 191);
			$table->string('email')->unique();
			$table->string('prim_phone', 20)->unique();
			$table->string('city', 191);
			$table->string('country', 191);
			$table->string('street');
			$table->string('home', 10);
			$table->string('sec_email')->unique()->nullable(true);
			$table->string('sec_phone', 20)->nullable(true);
			$table->string('fb_account_url')->nullable(true)->unique();
			$table->string('address2')->nullable(true);
			$table->string('userphoto', 255)->nullable(true);
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->collation = "utf8_general_ci";
			$table->charset = "utf8";
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
		* Reverse the migrations.
		*
		* @return void
		*/
	public function down() {
		Schema::dropIfExists('addresses');
	}
}
