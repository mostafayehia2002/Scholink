<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->references('id')->on('parents')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreignId('class_id')->references('id')->on('classes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->string('email');
            $table->date('date_birth');
            $table->enum('gender', array('male', 'female'));
            $table->string('password');
            $table->char('message_otp', 4)->nullable();
            $table->string('photo')->default('uploads/students/profile.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('students');
    }
};
