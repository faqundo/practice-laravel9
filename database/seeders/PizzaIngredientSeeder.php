<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('pizza_ingredients_pivot')->insert([
            [
                'pizza_id' => 1,
                'ingredient_id' => 1
            ],
        ]);
    }
}
