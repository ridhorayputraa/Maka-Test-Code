<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(3)->create();

        DB::table('users')->insert([
            'name' => 'Ridho',
            'address' => 'Jalan pegangsaan timur',
            'image_url' => 'imageee.png',
            'created_at' => Carbon::now()
            
        ]);
      
        DB::table('users')->insert([
            'name' => 'Ray',
            'address' => 'Jalan pegangsaan barat',
            'image_url' => 'imageee2.png',
            'created_at' => Carbon::now()

        ]);

      
    }
}
