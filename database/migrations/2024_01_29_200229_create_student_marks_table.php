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
        Schema::create('student_marks', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('student_id')
                ->constrained('students')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('level_id')
                ->constrained('levels')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('subject_id')
                ->constrained('subjects')->cascadeOnUpdate()->cascadeOnDelete();
            $table->enum('term',['first','second']);
            $table->double('tasks')->default(0);
            $table->double('months')->default(0);
            $table->double('subject_grade')->default(0);
            $table->double('total_marks')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_marks');
    }
};
