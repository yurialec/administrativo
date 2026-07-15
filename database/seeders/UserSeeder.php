<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'yuri@email.com'],
            [
                'name' => 'Yuri',
                'password' => Hash::make('123456a!'),
            ]
        );
    }
}
