<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Proposta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->id();
        $propostas = Proposta::where('recebedor_id', $id)->where('tipo_id', 1)
            ->latest()
            ->get();
        $propostas_enviadas = Proposta::where('enviador_id', $id)->where('tipo_id', 1)
            ->latest()
            ->get();
        $contrapropostas = Proposta::where('tipo_id', 2)
            ->where(function ($query) {
                $query->where('recebedor_id', auth()->id())
                    ->orWhere('solicitante_id', auth()->id());
            })
            ->latest()
            ->get();

        return view('proposta.index', compact('propostas', 'contrapropostas', 'propostas_enviadas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('role_id', 2)->get();

        return view('proposta.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
            'recebedor_id' => 'required|integer',
            'valor'     => 'required|numeric|min:0',
        ]);

        $proposta = Proposta::create([
            'titulo'        => $validated['titulo'],
            'descricao'     => $validated['descricao'],
            'valor'         => $validated['valor'],
            'solicitante_id'   => auth()->id(),
            'enviador_id'   => auth()->id(),
            'recebedor_id'  => $validated['recebedor_id'],
            'status_id'     => 1,
            'tipo_id'       => 1,
        ]);

        Notificacao::create([
            'titulo'          => 'Uma proposta foi enviada a você!',
            'descricao'       => auth()->user()->name . ' enviou ums proposta "' . $validated['titulo'] . '".',
            'proposta_id'     => $proposta->id,
            'destinatario_id' => $validated['recebedor_id'],
            'status_id'       => 1,
        ]);

        return redirect()->route('proposta.index')->with('success', 'Proposta publicada com sucesso!');
    }
    function aceitar(Proposta $proposta)
    {
        if ($proposta->status_id !== 1) {
            abort(403, 'Ação não autorizada.');
        }

        $proposta->update([
            'status_id'       => 3,
        ]);

        Notificacao::create([
            'titulo'          => 'Sua proposta foi aceita!',
            'descricao'       => auth()->user()->name . ' aceitou a sua proposta "' . $proposta->titulo . '".',
            'proposta_id'     => $proposta->id,
            'destinatario_id' => $proposta->enviador_id,
            'status_id'       => 1,
        ]);

        return redirect()->route('proposta.show', $proposta)
            ->with('success', 'Proposta aceita com sucesso!');
    }
    function recusar(Proposta $proposta)
    {
        {
            if ($proposta->status_id !== 1) {
                abort(403, 'Ação não autorizada.');
            }

            $proposta->update([
                'status_id'       => 2,
            ]);

            Notificacao::create([
                'titulo'          => 'Sua proposta foi recusada!',
                'descricao'       => auth()->user()->name . ' recusou a sua proposta "' . $proposta->titulo . '".',
                'proposta_id'     => $proposta->id,
                'destinatario_id' => $proposta->enviador_id,
                'status_id'       => 1,
            ]);

            return redirect()->route('proposta.show', $proposta)
                ->with('success', 'Proposta aceita com sucesso!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Proposta $proposta)
    {
        $proposta->load('enviador', 'recebedor', 'status', 'tipo', 'solicitante');

        return view('proposta.show', compact('proposta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proposta $proposta)
    {
        if (auth()->id() !== $proposta->recebedor_id && auth()->id() !== $proposta->solicitante_id) {
            abort(403);
        }

        return view('proposta.edit', compact('proposta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proposta $proposta)
    {
        if (auth()->id() !== $proposta->recebedor_id && auth()->id() !== $proposta->solicitante_id) {
            abort(403, 'Ação não autorizada.');
        }

        $validated = $request->validate([
            'titulo'    => 'required|string|max:255',
            'descricao' => 'required|string',
            'valor'     => 'required|numeric|min:0',
        ]);

        $proposta->update([
            'titulo'    => $validated['titulo'],
            'descricao' => $validated['descricao'],
            'valor'     => $validated['valor'],
            'tipo_id'    => 2,
            'enviador_id' => auth()->id(),
        ]);

        $destinatarioId = (auth()->id() === $proposta->solicitante_id)
            ? $proposta->recebedor_id
            : $proposta->solicitante_id;

        if ($destinatarioId) {
            Notificacao::create([
                'titulo'          => 'Você recebeu uma contraproposta!',
                'descricao'       => auth()->user()->name . ' enviou uma nova oferta para o projeto "' . $proposta->titulo . '".',
                'proposta_id'     => $proposta->id,
                'remetente_id'    => auth()->id(),
                'destinatario_id' => $destinatarioId,
                'status_id'       => 1,
            ]);
        }

        return redirect()->route('proposta.show', $proposta)
            ->with('success', 'Contraproposta enviada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proposta $proposta)
    {
        //
    }
}
