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
        Schema::create('propostas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recebedor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('enviador_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo');
            $table->string('descricao');
            $table->double('valor');
            $table->foreignId('tipo_id')->references('id')->on('tipo_propostas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propostas');
    }
};
