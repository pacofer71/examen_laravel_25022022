<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Storage::deleteDirectory('autos');
        Storage::makeDirectory('autos'); 
        \App\Models\User::factory(10)->create();
        $this->call(AutoSeeder::class);
        
    }
}
