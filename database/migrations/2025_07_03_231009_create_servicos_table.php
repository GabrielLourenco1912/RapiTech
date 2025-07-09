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
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('dev_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('proposta_id')->references('id')->on('propostas')->onDelete('cascade')->onUpdate('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->foreignId('status_id')->references('id')->on('status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pagamento_id')->references('id')->on('pagamentos')->onDelete('cascade')->onUpdate('cascade');
            $table->double('valor');
            $table->string('path_relatorio');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servicos');
    }
};
