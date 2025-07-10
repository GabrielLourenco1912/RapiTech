<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
class ServicoController extends Controller
{
    public function storeRelatorio(Request $request, Servico $servico): RedirectResponse
    {
        // 1. Autorização
        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        // 2. Validação
        $request->validate([
            'relatorio_pdf' => 'required|file|mimes:pdf|max:2048', // PDF com no máximo 2MB
        ]);

        // 3. Salva o arquivo e pega o caminho
        $path = $request->file('relatorio_pdf')->store('relatorios', 'public');

        // 4. Atualiza o serviço com o caminho do relatório
        $servico->update(['path_relatorio' => $path]);

        // 5. Redireciona de volta
        return back()->with('success', 'Relatório enviado com sucesso!');
    }

    /**
     * Substitui um relatório existente por um novo.
     */
    public function updateRelatorio(Request $request, Servico $servico): RedirectResponse
    {
        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        $request->validate([
            'relatorio_pdf' => 'required|file|mimes:pdf|max:2048',
        ]);

        if ($servico->path_relatorio && Storage::disk('public')->exists($servico->path_relatorio)) {
            Storage::disk('public')->delete($servico->path_relatorio);
        }

        $novoPath = $request->file('relatorio_pdf')->store('relatorios', 'public');

        $servico->update(['path_relatorio' => $novoPath]);

        return back()->with('success', 'Relatório atualizado com sucesso!');
    }

    /**
     * Fornece o relatório do serviço para download.
     */
    public function downloadRelatorio(Servico $servico): StreamedResponse
    {
        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        if (!$servico->path_relatorio || !Storage::disk('public')->exists($servico->path_relatorio)) {
            abort(404, 'Arquivo de relatório não encontrado.');
        }

        return Storage::disk('public')->download($servico->path_relatorio);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->id();

        $servicos = Servico::with('cliente', 'dev', 'status')
            ->where('cliente_id', $id)
            ->orWhere('dev_id', $id)
            ->latest()
            ->get();

        return view('servico.index', compact('servicos'));
    }

    public function concluir(Servico $servico)
    {
        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        $servico->update([
            'status_id' => 6,
        ]);

        return view('servico.show', compact('servico'));
    }

    public function cancelar(Servico $servico)
    {
        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        $servico->update([
            'status_id' => 7,
        ]);

        return view('servico.show', compact('servico'));
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
    public function show(Servico $servico)
    {

        $servico->load('cliente', 'dev', 'status', 'avaliacao');

        if (auth()->id() !== $servico->cliente_id && auth()->id() !== $servico->dev_id) {
            abort(403);
        }

        return view('servico.show', compact('servico'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Servico $servico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        //
    }
}
