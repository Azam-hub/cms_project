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
        Schema::create('students', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('gr_no', 50);
            $table->integer('course_id')->index('course_id');
            $table->integer('discount');
            $table->integer('annual_fees');
            $table->json('total_modules');
            $table->json('completed_modules');
            $table->integer('room')->index('room');
            $table->string('seat', 10);
            $table->string('timing', 20);
            $table->string('shift', 50);
            $table->string('status', 20);
            $table->integer('exclude')->default(0);
            $table->integer('user_id')->index('user_id');
            $table->string('created_at', 50);
            $table->string('updated_at', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
