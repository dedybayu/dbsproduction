<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Str;
class UserSeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Bayu Setiawan',
            'username' => 'bayusetiawan',
            'email' => 'bayusetiawan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)

        ]);
        User::create([
            'name' => 'Dedy Bayu Setiawan',
            'username' => 'aaaaa',
            'email' => 'bayusetiawan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)

        ]);

        User::factory(5)->create();

    }
}
