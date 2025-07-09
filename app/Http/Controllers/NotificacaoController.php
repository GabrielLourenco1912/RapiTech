<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use Illuminate\Http\Request;

class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id =  auth()->id();
        $notificacoes = Notificacao::where('destinatario_id', $id)
        ->latest()
        ->get();
        return view('notificacao.index', compact('id', 'notificacoes'));
    }

    public function marcarComoLida(Notificacao $notificacao)
    {
        if ($notificacao->destinatario_id !== auth()->id()) {
            abort(403, 'Ação não autorizada.');
        }

        $notificacao->update(['read_at' => now()]);

        return back()->with('success', 'Notificação marcada como lida!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Notificacao $notificacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notificacao $notificacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notificacao $notificacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notificacao $notificacao)
    {
        if ($notificacao->destinatario_id !== auth()->id()) {
            abort(403, 'Ação não autorizada.');
        }

        $notificacao->delete();

        return back()->with('success', 'Notificação apagada com sucesso!');
    }
}
