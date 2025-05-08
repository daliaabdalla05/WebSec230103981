<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic devices and gadgets'
        ]);

        Category::create([
            'name' => 'Accessories',
            'description' => 'Device accessories and peripherals'
        ]);

        Category::create([
            'name' => 'Computers',
            'description' => 'Computers and computing devices'
        ]);
    }
} 