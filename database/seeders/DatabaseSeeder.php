<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(1)->create();

        $processo = \App\Models\Processos::factory(10)->create();
        $signatarios = \App\Models\Signatarios::factory(10)->create();

        \App\Models\Documentos::factory(10)->create([
            'processo_id' => $processo->id,
            'caminho_arquivo' => 'caminho',
            'tipo' => 'jpg'
        ]);

        \App\Models\Aprovacoes::factory(10)->create([
            'processo_id' => $processo->id,
            'signatario_id' => $signatarios->id,
            'status' => 'reprovado',
            'justificativa' => 'Não sei',
            'data_aprovacao' => now(),
        ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
