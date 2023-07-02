<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = config('dataseeder.users');
        foreach($users as $user)
        {
            $newUser  = new User();
            $newUser-> name = $user['name'];
            $newUser-> surname = $user['surname'];
            $newUser-> email = $user['email'];
            $newUser-> password = $user['password'];

            $newUser->save();
        }
    }
}
