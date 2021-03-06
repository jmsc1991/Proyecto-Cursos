<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        factory(Category::class,5)->create();
    }
}
