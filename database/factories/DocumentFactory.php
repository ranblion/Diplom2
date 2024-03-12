<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use app\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=>ucfirst($this->faker->words(2,true)),
            'user_id'=>User::query()->inRandomOrder()->value('id'),
            'url'=>ucfirst($this->faker->words(2,true)),
        ];
    }

    
}
