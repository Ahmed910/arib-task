<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ahmed Abotaleb',
            'email' => 'ahmedabotaleb256@gmail.com',
            'password' => 'Amm@2030',
            'mobile_number' => '01068107713'
        ]);
    }
}
