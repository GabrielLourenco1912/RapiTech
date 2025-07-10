<?php

namespace App\Http\Controllers;

use App\Models\Metodo_pagamento;
use App\Models\Notificacao;
use App\Models\Pagamento;
use App\Models\Proposta;
use App\Models\Servico;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Stripe;


class PagamentoController extends Controller
{

    public function iniciarPagamento(Request $request, Proposta $proposta)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card', 'boleto'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'brl',
                    'product_data' => [
                        'name' => 'Pagamento da Proposta: ' . $proposta->titulo,
                    ],
                    'unit_amount' => $proposta->valor * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',

            'client_reference_id' => $proposta->id,

            'success_url' => route('pagamento.sucesso') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('pagamento.cancelado', ['proposta' => $proposta->id]),
        ]);

        return redirect()->away($session->url);
    }

    public function sucesso(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $sessionId = $request->query('session_id');

        //try {
        $session = Session::retrieve($sessionId, ['expand' => ['payment_intent']]);

            if (!$session) {
                abort(404);
            }

            $paymentIntent = $session->payment_intent;

            $paymentMethodType = $paymentIntent->charges->data[0]->payment_method_details->type ?? 'desconhecido';

            $propostaId = $session->client_reference_id;
            $proposta = Proposta::find($propostaId);

            if ($proposta && $proposta->status_id !== 4) {
                $proposta->update(['status_id' => 4]);
            }

            Notificacao::create([
                'titulo'          => 'Proposta foi paga ' . $proposta->titulo . '".',
                'descricao'       => 'Parabéns! A sua proposta foi paga ' . $proposta->titulo . '".',
                'proposta_id'     => $proposta->id,
                'destinatario_id' => $proposta->solicitante_id,
                'status_id'       => 1,
            ]);

            Notificacao::create([
                'titulo'          => 'Proposta foi paga ' . $proposta->titulo . '.',
                'descricao'       => 'Parabéns! A sua proposta foi paga ' . $proposta->titulo . '.',
                'proposta_id'     => $proposta->id,
                'destinatario_id' => $proposta->recebedor_id,
                'status_id'       => 1,
            ]);

            $metodo_pagamento = Metodo_pagamento::create([
                'nome' => $paymentMethodType,
            ]);

            $pagamento = Pagamento::create([
                'pagador_id' => $proposta->solicitante_id,
                'recebedor_id' => $proposta->recebedor_id,
                'metodo_pagamento_id' => $metodo_pagamento->id,
                'status_id' => 9,
                'valor' => $proposta->valor,
                'referencia' => $paymentMethodType,

            ]);

            Servico::create([
                'cliente_id' => $proposta->solicitante_id,
                'dev_id' => $proposta->recebedor_id,
                'proposta_id' => $proposta->id,
                'titulo' => $proposta->titulo,
                'descricao' => $proposta->descricao,
                'status_id' => 5,
                'valor' => $proposta->valor,
                'pagamento_id' => $pagamento->id,
                'path_relatorio' => 'null',
            ]);

            return redirect()->route('proposta.show', $proposta)
                ->with('success', 'Pagamento aprovado com sucesso!');

//        } catch (\Exception $e) {
//            return redirect()->route('welcome')->with('error', 'Ocorreu um erro ao processar seu pagamento.');
//        }
    }

    public function cancelado(Request $request)
    {
        $proposta = Proposta::find($request->query('proposta'));

        Notificacao::create([
            'titulo'          => 'Pagamento recusad ' . $proposta->titulo . '.',
            'descricao'       => 'O pagamento da sua proposta foi recusado ' . $proposta->titulo . '.',
            'proposta_id'     => $proposta->id,
            'destinatario_id' => $proposta->solicitante_id,
            'status_id'       => 1,
        ]);

        return redirect()->route('proposta.show', $proposta)
            ->with('error', 'O pagamento foi cancelado. Você pode tentar novamente.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Pagamento $pagamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pagamento $pagamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pagamento $pagamento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pagamento $pagamento)
    {
        //
    }
}
