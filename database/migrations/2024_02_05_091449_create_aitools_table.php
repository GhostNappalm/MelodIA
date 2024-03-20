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
            $table->string('authors');
            $table->text('description');
            $table->json('inputs')->nullable();
            $table->string('method');
            $table->string('endpoint');
            $table->string('out_file_ext');
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('aitools');
    }
};
