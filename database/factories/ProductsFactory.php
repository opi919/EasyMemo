<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;
use Ramsey\Uuid\Type\Integer;

class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_name' => $this->faker->name(),
            'price' => rand(100,500),
            'tax' => 1.5,
        ];
    }
}
