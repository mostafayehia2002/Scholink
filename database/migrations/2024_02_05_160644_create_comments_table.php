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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained('contents')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->morphs('commentable');
            $table->text('comment');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
