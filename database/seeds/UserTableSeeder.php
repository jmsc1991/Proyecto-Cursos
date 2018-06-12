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

        $user = new User();

        $user->name = "admin";
        $user->email = "admin@admin.es";
        $user->password = bcrypt("123456");
        $user->save();

        factory(User::class,5)->create();
    }
}
