<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $status = [
            [
                'nome' => 'Pendente',
                'segmento' => 'proposta',
            ],
            [
                'nome' => 'Recusada',
                'segmento' => 'proposta',
            ],
            [
                'nome' => 'Aceita',
                'segmento' => 'proposta',
            ],
            [
                'nome' => 'Paga',
                'segmento' => 'proposta',
            ],
            [
                'nome' => 'Em desenvolvimento',
                'segmento' => 'servico',
            ],
            [
                'nome' => 'Finalizado',
                'segmento' => 'servico',
            ],
            [
                'nome' => 'Cancelado',
                'segmento' => 'servico',
            ],
            [
                'nome' => 'Pendente',
                'segmento' => 'pagamento',
            ],
            [
                'nome' => 'Realizado',
                'segmento' => 'pagamento',
            ],
            [
                'nome' => 'Cancelado',
                'segmento' => 'pagamento',
            ]
        ];

        foreach ($status as $status) {
            Status::firstOrCreate(['nome' => $status['nome'], 'segmento' => $status['segmento'], 'created_at' => now(),	'updated_at' => now()]);
        }
    }
}
