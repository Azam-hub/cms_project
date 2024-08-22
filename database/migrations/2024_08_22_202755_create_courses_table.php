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
        Schema::create('courses', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 500);
            $table->integer('duration');
            $table->integer('fees');
            $table->string('questions_to_ask', 100);
            $table->integer('deactive')->default(0);
            $table->string('is_deleted', 50)->default('0');
            $table->string('created_at', 100);
            $table->string('updated_at', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
