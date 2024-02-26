<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained("levels")->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('class_name');
            $table->integer('number_seats')->default(30);
            $table->integer('available_seats')->default(30);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('classes');
    }
};
