<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Tag;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::truncate();

        factory(Tag::class,20)->create();
    }
}
