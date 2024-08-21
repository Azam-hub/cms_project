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
        Schema::create('rosters', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('admin_id')->index('admin_id');
            $table->integer('room_id')->index('room_id');
            $table->string('timing', 50);
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
        Schema::dropIfExists('rosters');
    }
};
