<?php

namespace Database\Seeders;

use App\Models\Tipo_proposta;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call( RoleSeeder::class);

        $this->call( EscopoSeeder::class);

        $this->call(TipoPropostaSeeder::class);

        $this->call(StatusSeeder::class);

        $this->call(AdminSeeder::class);

    }
}
