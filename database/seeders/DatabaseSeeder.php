<?php

namespace Database\Seeders;

use App\Models\{ User, Song };
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('email', 'admin@testmail.com')->exists()) {
            User::factory()->create([
                'email' => 'admin@testmail.com',
            ]);
        }
        
        Song::factory(20)->create();
    }
}
