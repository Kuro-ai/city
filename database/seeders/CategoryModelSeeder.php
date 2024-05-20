<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_models')->insert([
            'name' => 'Chicken',
            'description' => 'Savory chicken dishes ranging from crispy fried options to flavorful stews or stir-fries.',
            'image' => 'chicken.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_models')->insert([
            'name' => 'Pork',
            'description' => 'Tender pork pieces cooked in a flavorful sauce or seasoned for grilling or roasting.',
            'image' => 'pork.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_models')->insert([
            'name' => 'Seafood',
            'description' => 'Seafood dishes feature an array of aquatic life, from tender fish fillets to shellfish with bold flavors.',
            'image' => 'seafood.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_models')->insert([
            'name' => 'Vegetables',
            'description' => 'A vibrant selection of roasted, steamed, stir-fried, or pickled vegetables.',
            'image' => 'vegetables.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_models')->insert([
            'name' => 'Soup',
            'description' => 'Hearty and comforting broths, creamy chowders, or refreshing light broths with various ingredients.',
            'image' => 'soup.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('category_models')->insert([
            'name' => 'Drinks',
            'description' => 'Drinks that are refreshing, hydrating, or stimulating, that can be enjoyed hot or cold',
            'image' => 'drinks.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
