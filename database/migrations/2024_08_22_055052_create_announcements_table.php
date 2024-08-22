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
        Schema::create('announcements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->text('title');
            $table->text('description');
            $table->integer('student_id')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->string('created_at', 50);
            $table->string('updated_at', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
