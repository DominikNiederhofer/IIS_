<?php

use Illuminate\Database\Seeder;
use System\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->save();

        $role_teacher = new Role();
        $role_teacher->name = 'teacher';
        $role_teacher->save();

        $role_student = new Role();
        $role_student->name = 'student';
        $role_student->save();
    }
}
