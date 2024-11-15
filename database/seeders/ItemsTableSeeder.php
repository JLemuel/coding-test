<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 500 sample items
        for ($i = 1; $i <= 500; $i++) {
            Item::create(['name' => 'Item ' . $i]);
        }
    }
}
