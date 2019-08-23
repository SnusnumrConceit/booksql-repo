<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'name' => 'Программирование'
        ]);

        Category::create([
        	'name' => 'Ужасы'
        ]);

        Category::create([
        	'name' => 'Драма'
        ]);

        Category::create([
        	'name' => 'Комедия'
        ]);
    }
}
