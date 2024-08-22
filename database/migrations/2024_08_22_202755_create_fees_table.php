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
        Schema::create('fees', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('amount');
            $table->string('purpose', 50);
            $table->string('month', 200);
            $table->text('description');
            $table->integer('student_id')->index('student_id');
            $table->integer('is_deleted')->default(0);
            $table->string('created_at', 100);
            $table->string('updated_at', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
