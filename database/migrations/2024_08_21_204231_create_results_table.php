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
        Schema::create('results', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('correct_answers', 20);
            $table->string('wrong_answers', 20);
            $table->string('skipped_questions', 20);
            $table->integer('user_id')->index('user_id');
            $table->integer('is_deleted');
            $table->string('created_at', 100);
            $table->string('updated_at', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
