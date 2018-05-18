<?php

use Illuminate\Database\Seeder;
use App\Models\Admin\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        factory(User::class,5)->create();
    }
}
