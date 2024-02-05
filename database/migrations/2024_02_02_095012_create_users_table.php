<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->date('email_verified_at')->nullable();;
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
