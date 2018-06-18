<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_editor = Role::where('name', 'editor')->first();
        $role_admin = Role::where('name', 'admin')->first();

        $user_editor = new User();
        $user_editor->name = 'Duy Nguyen';
        $user_editor->email = 'duy210697@gmail.com';
        $user_editor->password = bcrypt('123456');
        $user_editor->status = true;
        $user_editor->verify = true;
        $user_editor->save();
        $user_editor->roles()->attach($role_editor);

        $user_admin = new User();
        $user_admin->name = 'Bin Nguyen';
        $user_admin->email = 'bin210697@gmail.com';
        $user_admin->password = bcrypt('123456');
        $user_admin->status = true;
        $user_admin->verify = true;
        $user_admin->save();
        $user_admin->roles()->attach($role_admin);
    }
}
