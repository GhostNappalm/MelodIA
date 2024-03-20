<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('charthistory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('aitool_id')->constrained();
            $table->text('file_name');
            $table->longText('fileb64');
            $table->json('inputs');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('charthistory');
    }
};
