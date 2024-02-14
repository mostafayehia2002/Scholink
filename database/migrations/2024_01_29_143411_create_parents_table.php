<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('mobile', 30)->unique();
            $table->string('email', 100)->unique();
            $table->string('national_id', 14)->unique();
            $table->string('address');
            $table->string('job');
            $table->enum('gender', array('male', 'female'));
            $table->date('date_birth');
            $table->string('password');
            $table->char('message_otp', 4)->nullable();
            $table->string('photo')->default('uploads/parents/profile/profile.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('parents');
    }
};
