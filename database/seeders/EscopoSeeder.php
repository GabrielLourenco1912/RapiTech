<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Escopo;

class EscopoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $linguagens = [
            'PHP', 'JavaScript', 'Python', 'Java', 'TypeScript', 'C#', 'Go', 'Ruby'
        ];

        $frameworks = [
            'Laravel', 'React', 'Vue.js', 'Angular', 'Node.js', 'Express.js',
            'Django', 'Spring Boot', 'Tailwind CSS', 'Bootstrap'
        ];

        $bancosDeDados = [
            'MySQL', 'PostgreSQL', 'MongoDB', 'Redis', 'SQLite', 'Microsoft SQL Server'
        ];

        $ferramentas = [
            'Git', 'Docker', 'Kubernetes', 'CI/CD', 'AWS', 'Google Cloud', 'Azure', 'Linux'
        ];

        $habilidades = [
            'Comunicação Efetiva', 'Trabalho em Equipe', 'Proatividade',
            'Resolução de Problemas', 'Pensamento Crítico', 'Liderança Técnica', 'Mentoria'
        ];

        $modulos = [
            'Autenticação de Usuários', 'Integração com Gateway de Pagamento',
            'Geração de Relatórios', 'Sistema de Notificações', 'API RESTful',
            'Painel Administrativo', 'Testes Automatizados', 'Otimização de Performance'
        ];

        $todosOsEscopos = array_merge(
            $linguagens,
            $frameworks,
            $bancosDeDados,
            $ferramentas,
            $habilidades,
            $modulos
        );

        foreach ($todosOsEscopos as $escopo) {
            Escopo::firstOrCreate(['nome' => $escopo]);
        }
    }
}
