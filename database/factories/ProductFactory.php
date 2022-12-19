<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => $this->faker->numberBetween(100,1000),
            'name' => $this->faker->name,
            'information' => $this->faker->realText,
            'price' => $this->faker->numberBetween(7000, 20000),
            // 'color_A' => $this->faker->numberBetween(1, 30),
            // 'color_B' => $this->faker->numberBetween(1, 30),
            // 'color_C' => $this->faker->numberBetween(1, 30),
            // 'color_D' => $this->faker->numberBetween(1, 30),
            // 'color_E' => $this->faker->numberBetween(1, 30),
            // 'color_F' => $this->faker->numberBetween(1, 30),
            // 'color_G' => $this->faker->numberBetween(1, 30),
            // 'color_H' => $this->faker->numberBetween(1, 30),
            // 'color_I' => $this->faker->numberBetween(1, 30),
            // 'color_J' => $this->faker->numberBetween(1, 30),
            // 'color_K' => $this->faker->numberBetween(1, 30),
            // 'color_L' => $this->faker->numberBetween(1, 30),
            'is_selling' => $this->faker->numberBetween(0, 1),
            'sort_order' => $this->faker->numberBetween(1, 4),
            'brand_id' => $this->faker->numberBetween(1, 2),
            'secondary_category_id' => $this->faker->numberBetween(1, 15),
            'image1' => $this->faker->numberBetween(1, 6),
            'image2' => $this->faker->numberBetween(1, 6),
            'image3' => $this->faker->numberBetween(1, 6),
            'image4' => $this->faker->numberBetween(1, 6),
            'image5' => $this->faker->numberBetween(1, 6),
            'image6' => $this->faker->numberBetween(1, 6),
            'image7' => $this->faker->numberBetween(1, 6),
            'image8' => $this->faker->numberBetween(1, 6),
            'image9' => $this->faker->numberBetween(1, 6),
            'image10' => $this->faker->numberBetween(1, 6),
        ];
    }
}
