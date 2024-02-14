<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->dateTime('deadline');

            $table->foreignId('class_id')
                ->references('id')->on('classes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->references('id')->on('teachers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->references('id')->on('subjects')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignments');
    }
};
