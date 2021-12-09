<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $level = Level::where('description', 'Administrator')->first();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@seventh.com',
            'password' => Hash::make('123adm456'),
            'level_id' => $level->id]);
    }
}
