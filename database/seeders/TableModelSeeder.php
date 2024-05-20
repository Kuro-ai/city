<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letters = ['A', 'B', 'C'];
        $locations = ['front', 'back', 'outside', 'room'];

        foreach ($letters as $letter) {
            for ($i = 1; $i <= 10; $i++) {
                DB::table('table_models')->insert([
                    'name' => $letter . $i,
                    'capacity' => rand(2, 20), // random capacity from 2 to 20
                    'status' => 'available',
                    'location' => $locations[array_rand($locations)],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
