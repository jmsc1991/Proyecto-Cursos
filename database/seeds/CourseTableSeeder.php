<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\Course;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::truncate();

        factory(Course::class,20)->create();
    }
}
