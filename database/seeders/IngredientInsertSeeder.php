<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientInsertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('ingredients')->insert([
            [
                'name' => 'Tomates',
                'price' => 0.50
            ],
            [
                'name' => 'Oregano',
                'price' => 0.05
            ],
            [
                'name' => 'Queso',
                'price' => 0.90
            ],
            [
                'name' => 'Harina',
                'price' => 0.35
            ],
            [
                'name' => 'Jamon',
                'price' => 1.50
            ],
        ]);
    }
}
