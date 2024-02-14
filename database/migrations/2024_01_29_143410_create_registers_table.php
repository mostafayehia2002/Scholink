<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration{
	public function up()
	{
		Schema::create('register', function(Blueprint $table) {
			$table->id('id');
			$table->string('parent_name', 255);
			$table->string('parent_email', 100);
			$table->string('parent_mobile', 30);
			$table->date('parent_data_birth');
			$table->string('parent_personal_identification');
			$table->string('parent_national_id', 14);
			$table->string('parent_address');
			$table->string('parent_job');
			$table->enum('parent_gender', array('male','female'));
			$table->string('child_name');
			$table->date('child_date_birth');
			$table->string('child_birth_certificate');
			$table->enum('child_gender', array('male', 'female'));
			$table->enum('child_level', array('1', '2', '3', '4', '5', '6'));
			$table->string('child_school_name')->nullable();
			$table->char('message_otp', 6)->nullable();
			$table->enum('status', array('pending','confirmed','accept', 'reject'))->default('pending');
            $table->timestamps();
            $table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('register');
	}
};
