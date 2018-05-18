<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Video;

class VideoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Video::truncate();

        factory(Video::class,10)->create();
    }
}
