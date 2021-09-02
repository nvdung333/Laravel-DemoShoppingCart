<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        Product::create([
            'P_Name' => 'Apple',
            'P_Price' => 3000,
        ]);
        Product::create([
            'P_Name' => 'Orange',
            'P_Price' => 4000,
        ]);
        Product::create([
            'P_Name' => 'Grape',
            'P_Price' => 1500,
        ]);
        Product::create([
            'P_Name' => 'Pear',
            'P_Price' => 2500,
        ]);
        Product::create([
            'P_Name' => 'WaterLemon',
            'P_Price' => 5000,
        ]);
        
        
    }
}
