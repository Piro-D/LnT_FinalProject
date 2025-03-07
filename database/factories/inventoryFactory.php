<?php

namespace Database\Factories;

use App\Models\Inventory;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class InventoryFactory extends Factory
{
    protected $model = Inventory::class;

    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id, // Use existing categories
            'itemName' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1000, 1000000), // 1,000 - 1,000,000
            'amount' => $this->faker->numberBetween(1, 100), // Stock: 1 - 100
            'image' => 'image.png', // Use a fixed image
        ];
    }
}
