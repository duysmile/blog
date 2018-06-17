<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->role_code = '1';
        $role_admin->name = 'admin';
        $role_admin->save();

        $role_editor = new Role();
        $role_editor->role_code = '2';
        $role_editor->name = 'editor';
        $role_editor->save();
    }
}
