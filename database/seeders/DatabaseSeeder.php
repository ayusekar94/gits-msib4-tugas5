<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $category = [
            ['name' => 'Elektronik',],
            ['name' => 'Makanan & Minuman',],
            ['name' => 'Tas',],
            ['name' => 'Pakaian',],
            ['name' => 'Sepatu',],
        ];

        DB::table('categories')->insert($category);
    }
}
