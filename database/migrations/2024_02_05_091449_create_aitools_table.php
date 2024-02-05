<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('aitools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('autors');
            $table->text('description');
            $table->json('inputs')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('aitools');
    }
};
