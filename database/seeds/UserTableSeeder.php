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
        $user1 = new User();
        $user2 = new User();

        $user->name = "admin";
        $user->email = "admin@admin.es";
        $user->password = bcrypt("123456");
        $user->subscription = 1;
        $user->save();

        $user1->name = "profe";
        $user1->email = "profe@profe.es";
        $user1->password = bcrypt("123456");
        $user1->subscription = 1;
        $user1->save();

        $user2->name = "alumno";
        $user2->email = "alumno@alumno.es";
        $user2->password = bcrypt("123456");
        $user2->subscription = 1;
        $user2->save();

        $user->assignRole('admin');
        $user1->assignRole('teacher');
        $user2->assignRole('student');

        factory(User::class,5)->create()->each(function ($u) {
            $u->assignRole('student');
        });
    }
}
