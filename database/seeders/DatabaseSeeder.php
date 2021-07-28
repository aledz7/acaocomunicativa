<?php

namespace Database\Seeders;

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
        \App\Models\User::factory()->create([
        	'name'=>'Kleber Souza',
        	'email'=>'kleber@anewcon.com.br',
        	'password'=>bcrypt('acesso88')
        ]);
    }
}
