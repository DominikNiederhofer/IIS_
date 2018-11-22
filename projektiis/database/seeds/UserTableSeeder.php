<?php

use Illuminate\Database\Seeder;
use System\Role;
use System\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $role_admin = Role::where('name', 'admin')->first();
        $role_teacher = Role::where('name','teacher')->first();
        $role_student = Role::where('name','student')->first();

        $admin = new User();
        $admin->name = 'admin';
        $admin->email = 'admin@admin.com';
        $admin->username = 'admin';
        $admin->password = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $teacher = new User();
        $teacher->name = 'teacher';
        $teacher->email = 'teacher@teacher.com';
        $teacher->username = 'teacher';
        $teacher->password = bcrypt('teacher');
        $teacher->save();
        $teacher->roles()->attach($role_teacher);
    
    	$student = new User();
        $student->name = 'student';
        $student->email = 'student@student.com';
        $student->username = 'student';
        $student->password = bcrypt('student');
        $student->save();
        $student->roles()->attach($role_student);

    }
}
