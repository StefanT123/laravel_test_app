<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin 		= Role::where('name', 'admin')->first();
        $role_editor 		= Role::where('name', 'editor')->first();
        $role_author 		= Role::where('name', 'author')->first();
        $role_subscriber 	= Role::where('name', 'subscriber')->first();

        $admin = new User();
        $admin->name = 'Admin Admin';
        $admin->email = 'admin@admin.com';
        $admin->password = bcrypt('admin123');
        $admin->save();
        $admin->roles()->attach($role_admin);

      	$editor = new User();
        $editor->name = 'Editor asd';
        $editor->email = 'editor@editor.com';
        $editor->password = bcrypt('editor123');
        $editor->save();
        $editor->roles()->attach($role_editor);

      	$author = new User();
        $author->name = 'Author gfjd';
        $author->email = 'author@author.com';
        $author->password = bcrypt('author123');
        $author->save();
        $author->roles()->attach($role_author);

      	$subscriber = new User();
        $subscriber->name = 'Subscriber poig';
        $subscriber->email = 'subscriber@subscriber.com';
        $subscriber->password = bcrypt('subscriber123');
        $subscriber->save();
        $subscriber->roles()->attach($role_subscriber);


    }
}
