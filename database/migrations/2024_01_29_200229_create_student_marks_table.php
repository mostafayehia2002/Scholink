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
            $table->id();
            $table->enum('level',[1,2,3,4,5,6]);
            $table->enum('term',['first','second']);
            $table->double('tasks')->default(0);
            $table->double('months')->default(0);
            $table->double('subject_grade')->default(0);
            $table->double('total_marks')->default(0);
            $table->foreignId('student_id')
                ->references('id')->on('students')
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
        Schema::dropIfExists('student_marks');
    }
};
