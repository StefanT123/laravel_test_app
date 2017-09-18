<?php

use Illuminate\Database\Seeder;
use App\Role;

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
        $role_admin->description = 'Administrator';
        $role_admin->save();

        $role_editor = new Role();
        $role_editor->name = 'editor';
        $role_editor->description = 'Editor';
        $role_editor->save();

        $role_author = new Role();
        $role_author->name = 'author';
        $role_author->description = 'Author';
        $role_author->save();

        $role_subscriber = new Role();
        $role_subscriber->name = 'subscriber';
        $role_subscriber->description = 'Subscriber';
        $role_subscriber->save();
    }
}
