<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_models')->insert([
            'name' => 'Creamy Parmesan Garlic Mushroom Chicken',
            'description' => 'A dish with tender chicken breast, sauteed mushrooms, and a flavorful sauce made with garlic, parmesan cheese, and cream',
            'image' => 'chicken1.jpg',
            'price' => 20,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Baked honey mustard chicken',
            'description' => 'A simple and flavorful dish made with chicken breasts or thighs baked in a sweet and tangy honey mustard sauce',
            'image' => 'chicken2.jpg',
            'price' => 10,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Roast chicken breast, potato purée and pine nuts',
            'description' => 'Tender, roasted chicken breast sits atop a bed of smooth mashed potatoes, all finished with the toasted pine nuts',
            'image' => 'chicken3.jpg',
            'price' => 18,
            'category_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Pork fillet with mushroom sauce and lemon potatoes',
            'description' => 'Tender pork fillet smothered in a creamy mushroom sauce, served alongside crispy lemon-flavored potatoes',
            'image' => 'pork1.jpg',
            'price' => 10,
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Creamy pork and wild mushroom casserole',
            'description' => 'Tender pork pieces are browned and simmered in a rich sauce with a variety of mushrooms, fresh herbs, and cream',
            'image' => 'pork2.jpg',
            'price' => 15,
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Crumbed pork chops with braised red cabbage',
            'description' => 'Juicy and flavorful pork chops, with tender and slightly sweet red cabbage that has a hint of acidity',
            'image' => 'pork3.jpg',
            'price' => 20,
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Seafood stew',
            'description' => 'Tender fish, shrimp, and mussels simmered in a rich white wine broth, with potatos and other vegetables',
            'image' => 'seafood1.jpg',
            'price' => 20,
            'category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Herby fish skewers',
            'description' => 'Skewers of marinated fish grilled to perfection and seasoned with a vibrant herb blend',
            'image' => 'seafood2.jpg',
            'price' => 15,
            'category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Mojito prawn tacos',
            'description' => 'Fresh, citrusy prawns marinated in a lime-mint mojo, served on warm tortillas with a vibrant salsa and creamy slaw',
            'image' => 'seafood3.jpg',
            'price' => 12,
            'category_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Japanese-style vegetable stir-fry',
            'description' => 'Tender crisp vegetables like cabbage, carrots, and snow peas are stir-fried with ginger and garlic',
            'image' => 'vegi1.jpg',
            'price' => 8,
            'category_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Winter root vegetable tagine',
            'description' => 'A fragrant Moroccan-inspired stew packed with tender carrots, parsnips, sweet potatoes, and other seasonal root vegetables simmered in a rich broth',
            'image' => 'vegi2.jpg',
            'price' => 12,
            'category_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Rich vegetable moussaka',
            'description' => 'Layered delight of roasted eggplant, zucchini, peppers, and a savory lentil tomato sauce, topped with creamy béchamel sauce',
            'image' => 'vegi3.jpg',
            'price' => 15,
            'category_id' => 4,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Rosemary and sausage soup',
            'description' => 'The soul-warming stew Savory sausage crumbles mingle with creamy white beans in a fragrant rosemary broth',
            'image' => 'soup1.jpg',
            'price' => 10,
            'category_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Leek and cheese soup',
            'description' => 'Tender leeks and diced potatoes simmer in a smooth, flavorful broth enriched with cream for a touch of richness',
            'image' => 'soup2.jpg',
            'price' => 12,
            'category_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Rendang noodle soup',
            'description' => 'a flavorful dish featuring tender noodles in a rich and spicy coconut curry broth simmered with rendang (braised beef)',
            'image' => 'soup3.jpg',
            'price' => 15,
            'category_id' => 5,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Old Fashioned',
            'description' => 'A classic whiskey cocktail made with sugar, bitters, and a citrus twist and has a balanced sweetness, bitterness, and booziness',
            'image' => 'drink1.jpg',
            'price' => 10,
            'category_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Negroni',
            'description' => 'A classic Italian cocktail made with equal parts gin, Campari, and sweet vermouth and has bitter-sweet flavor profile',
            'image' => 'drink2.jpg',
            'price' => 12,
            'category_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('menu_models')->insert([
            'name' => 'Mojito',
            'description' => 'A refreshing Cuban highball cocktail that combines white rum, mint, lime, sugar, and soda water',
            'image' => 'drink3.jpg',
            'price' => 15,
            'category_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
