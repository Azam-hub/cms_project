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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name');
            $table->string('father_name');
            $table->string('cnic_bform_no', 100);
            $table->string('date_of_birth', 200);
            $table->string('email', 300);
            $table->string('password', 1000);
            $table->string('mobile_no', 100);
            $table->string('profile_pic', 1000);
            $table->text('address');
            $table->string('role', 200);
            $table->string('token', 200);
            $table->string('is_deleted', 100);
            $table->string('created_at', 100);
            $table->string('updated_at', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
