<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{

    public function run()
    {
        Level::Create([
            'description' => 'Administrator'
        ]);

        Level::Create([
            'description' => 'Client'
        ]);
    }
}
