<?php

use App\Http\Controllers\NotificacaoController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropostaController;
use App\Http\Controllers\ServicoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest')->name('welcome');

Route::middleware(['auth' , 'checkrole:1'])->group(function () {
    Route::get('/dashboard_admin', function () {
        return view('dashboard.admin');
    })->name('dashboard_admin');
});
Route::middleware(['auth' , 'checkrole:2'])->group(function () {
    Route::get('/dashboard_dev', function () {
        return view('dashboard.dev');
    })->name('dashboard_dev');
});

Route::middleware(['auth' , 'checkrole:3'])->group(function () {
    Route::get('/dashboard_cliente', function () {
        return view('dashboard.cliente');
    })->name('dashboard_cliente');
    Route::get('/proposta/create', [PropostaController::class, 'create'])->name('proposta.create');
    Route::post('/proposta/store', [PropostaController::class, 'store'])->name('proposta.store');
    Route::get('/proposta/edit/{id}', [PropostaController::class, 'edit'])->name('proposta.edit');

    Route::post('/proposta/{proposta}/pagar', [PagamentoController::class, 'iniciarPagamento'])->name('proposta.pagamento');
    Route::get('/pagamento/sucesso', [PagamentoController::class, 'sucesso'])->name('pagamento.sucesso');
    Route::get('/pagamento/cancelado', [PagamentoController::class, 'cancelado'])->name('pagamento.cancelado');

});

Route::middleware(['auth' , 'checkrole:3.2'])->group(function () {
    Route::get('/notificacao', [NotificacaoController::class, 'index'])->name('notificacao.index');
    Route::patch('/notificacoes/{notificacao}/ler', [NotificacaoController::class, 'marcarComoLida'])->name('notificacao.read');
    Route::delete('/notificacoes/{notificacao}', [NotificacaoController::class, 'destroy'])->name('notificacao.destroy');

    Route::get('/proposta', [PropostaController::class, 'index'])->name('proposta.index');
    Route::get('/proposta/{proposta}/show', [PropostaController::class, 'show'])->name('proposta.show');
    Route::post('/proposta/{proposta}/aceitar', [PropostaController::class, 'aceitar'])->name('proposta.aceitar');
    Route::post('/proposta/{proposta}/recusar', [PropostaController::class, 'recusar'])->name('proposta.recusar');
    Route::get('/proposta/{proposta}/editar', [PropostaController::class, 'edit'])->name('proposta.edit');
    Route::patch('/proposta/{proposta}', [PropostaController::class, 'update'])->name('proposta.update');

    Route::get('servico', [ServicoController::class, 'index'])->name('servico.index');
    Route::get('/servico/{servico}/show', [ServicoController::class, 'show'])->name('servico.show');
    Route::patch('/servico/{servico}/concluir', [ServicoController::class, 'concluir'])->name('servico.concluir');
    Route::patch('/servico/{servico}/cancelar', [ServicoController::class, 'cancelar'])->name('servico.cancelar');
    Route::post('/servicos/{servico}/relatorios', [ServicoController::class, 'storeRelatorio'])
        ->name('servico.relatorios.store');

    Route::post('/servicos/{servico}/relatorio/atualizar', [ServicoController::class, 'updateRelatorio'])
        ->name('servico.relatorio.update');

    Route::get('/servicos/{servico}/relatorio/download', [ServicoController::class, 'downloadRelatorio'])
        ->name('servico.relatorio.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
