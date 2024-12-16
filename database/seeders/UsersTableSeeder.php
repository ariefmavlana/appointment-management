<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Asep',
                'username' => 'asep',
                'preferred_timezone' => 'Asia/Jakarta'
            ],
            [
                'name' => 'Agus',
                'username' => 'agus',
                'preferred_timezone' => 'Asia/Jayapura'
            ],
            [
                'name' => 'Ujang',
                'username' => 'ujang',
                'preferred_timezone' => 'Pacific/Auckland'
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
