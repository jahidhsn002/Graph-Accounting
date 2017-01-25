<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'Jahid Hasan';
        $user->email = 'a@a.a';
        $user->password = bcrypt('64526452');
        $user->salt = bcrypt('2345');
        $user->roll = 'admin';
        $user->save();
    }
}
