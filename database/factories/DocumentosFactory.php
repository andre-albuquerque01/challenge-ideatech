<?php

namespace Database\Factories;

use App\Models\Processos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Documentos>
 */
class DocumentosFactory extends Factory
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
            'caminho_arquivo' => $this->faker->filePath(),
            'tipo' => $this->faker->randomElement(['pdf', 'docx', 'jpg']),
        ];
    }
}
