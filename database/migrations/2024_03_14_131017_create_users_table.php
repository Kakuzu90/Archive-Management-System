<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
			$table->id();
			$table->string('first_name', 100);
			$table->string('middle_name', 100);
			$table->string('last_name', 100);
			$table->string('username');
			$table->string('password');
			$table->foreignId('college_id')->nullable()->constrained()->cascadeOnDelete();
			$table->foreignId('role_id')->constrained()->cascadeOnDelete();
			$table->string('year_level', 20)->nullable();
			$table->rememberToken();
			$table->integer('avatar')->default(1);
			$table->date('verified_till_at')->nullable();
			$table->timestamp('verified_at')->nullable();
			$table->timestamp('deleted_at')->nullable();
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
