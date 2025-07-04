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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pagador_id')->constrained('users');
            $table->foreignId('recebedor_id')->constrained('users');
            $table->foreignId('metodo_pagamento_id')->constrained('metodo_pagamentos');
            $table->foreignId('status_id')->constrained('status');
            $table->double('valor');
            $table->string('referencia')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
