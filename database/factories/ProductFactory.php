<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::pluck('id')->toArray();
        return [
            'product_name' => $this->faker->text(30),
            'product_slug' => $this->faker->text(30),
            'quantily' => $this->faker->numberBetween(10, 100),
            'price' => $this->faker->numberBetween(5, 40) * 1000,
            'price_discount' => 0,
            'imageUrl' => 'images/sp-1.jpg',
            'category_id' => $this->faker->randomElement($category),
            'product_description' => $this->faker->paragraph
        ];
    }
}
