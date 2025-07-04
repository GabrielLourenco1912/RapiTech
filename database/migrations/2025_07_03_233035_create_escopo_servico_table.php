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
        Schema::create('escopo_servico', function (Blueprint $table) {
            $table->foreignId('servico_id')->references('id')->on('servicos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('escopo_id')->references('id')->on('escopos')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['servico_id', 'escopo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escopo_servico');
    }
};
