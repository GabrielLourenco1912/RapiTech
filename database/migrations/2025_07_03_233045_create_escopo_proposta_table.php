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
        Schema::create('escopo_proposta', function (Blueprint $table) {
            $table->foreignId('proposta_id')->references('id')->on('propostas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('escopo_id')->references('id')->on('escopos')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['proposta_id', 'escopo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('escopo_proposta');
    }
};
