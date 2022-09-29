<?php

namespace Database\Factories;

use App\Models\Items;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Items::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' =>$this->faker->word(),
            'price' =>$this->faker->numberBetween(250, 9000),
            'type' =>$this->faker->randomElement(['woman', 'man', 'child']),
            'file_path' =>$this->faker->file('C:\Users\ADURAMIMO\Pictures\Celebs', 'C:\wamp64\www\shopping-cart\public\images', false)



        ];
    }
}
