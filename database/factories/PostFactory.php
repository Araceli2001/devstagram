<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //el titullo solo puede tener 5 caracteres
            'titulo' => $this->faker->sentence(5),
            'descripcion' => $this->faker->sentence(20),
            //la imagen va a tomar el id y su extension
            'imagen' => $this->faker->uuid() . '.jpg',
            'user_id' => $this->faker->randomElement([1, 2, 3, 4, 5])
        ];
    }
}
