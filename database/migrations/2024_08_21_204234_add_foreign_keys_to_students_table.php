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
        Schema::table('students', function (Blueprint $table) {
            $table->foreign(['course_id'], 'students_ibfk_1')->references(['id'])->on('courses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'students_ibfk_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['course_id'], 'students_ibfk_3')->references(['id'])->on('courses')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['user_id'], 'students_ibfk_4')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['room'], 'students_ibfk_5')->references(['id'])->on('rooms')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropForeign('students_ibfk_1');
            $table->dropForeign('students_ibfk_2');
            $table->dropForeign('students_ibfk_3');
            $table->dropForeign('students_ibfk_4');
            $table->dropForeign('students_ibfk_5');
        });
    }
};