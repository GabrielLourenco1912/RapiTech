<?php

namespace Database\Seeders;

use App\Models\Tipo_proposta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoPropostaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tipo_proposta::firstOrCreate(['nome' => 'proposta']);
        Tipo_proposta::firstOrCreate(['nome' => 'contra-proposta']);
    }
}
