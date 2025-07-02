<?php

namespace Database\Factories;

use App\Models\Processos;
use App\Models\Signatarios;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aprovacoes>
 */
class AprovacoesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'processo_id' => Processos::factory()->create()->id,
            'signatario_id' => Signatarios::factory()->create()->id,
            'status' => $this->faker->randomElement(['aprovado', 'reprovado', 'pendente']),
            'justificativa' => $this->faker->text(),
            'data_aprovacao' => $this->faker->dateTime(),
        ];
    }
}
