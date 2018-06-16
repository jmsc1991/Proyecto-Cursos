<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;

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

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'teacher']);
        Role::create(['name' => 'student']);

        $user = new User();

        $user->name = "admin";
        $user->email = "admin@admin.es";
        $user->password = bcrypt("123456");
        $user->subscription = 1;
        $user->save();

        $user->assignRole('admin');

        factory(User::class,5)->create();
    }
}
