<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Notificacao;
use App\Models\Servico;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = auth()->id();

        $avaliacoesRecebidas = Avaliacao::with(['enviador', 'destinatario', 'servico'])
            ->where('destinatario_id', $userId)
            ->latest()
            ->get();

        $avaliacoesFeitas = Avaliacao::with(['enviador', 'destinatario', 'servico'])
            ->where('enviador_id', $userId)
            ->latest()
            ->get();

        return view('avaliacao.index', compact('avaliacoesRecebidas', 'avaliacoesFeitas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Servico $servico)
    {
        $servico->load('dev', 'cliente', 'status');
        return view('avaliacao.create', compact('servico'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Servico $servico)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['required', 'string', 'max:1000'],
        ]);

        if ($request->input('destinatario_id') != $servico->dev_id) {
            return redirect()->back()->withErrors(['destinatario_id' => 'O destinatário da avaliação não corresponde ao desenvolvedor do serviço.']);
        }

        Avaliacao::create([
            'servico_id' => $servico->id,
            'enviador_id' => auth()->id(),
            'destinatario_id' => $request->input('destinatario_id'),
            'titulo' => $request->input('titulo'),
            'descricao' => $request->input('descricao'),
        ]);

        Notificacao::create([
            'titulo'          => 'Você foi avaliado pelo serviço ' . $servico->titulo . '.',
            'descricao'       => 'Veja sua avaliação referente ao serviço ' . $servico->titulo . '.',
            'proposta_id'     => $servico->proposta_id,
            'destinatario_id' => $servico->dev_id,
            'status_id'       => 1,
        ]);

        return redirect()->route('servico.show', $servico)->with('success', 'Sua avaliação foi enviada com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Avaliacao $avaliacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Avaliacao $avaliacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Avaliacao $avaliacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Avaliacao $avaliacao)
    {
        //
    }
}
