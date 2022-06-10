<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'is_admin' => 1
        ]);

        User::factory()->create([
            'name' => 'Jane',
            'email' => 'jane@example.com'
        ]);

        User::factory()->create([
            'name' => 'John',
            'email' => 'john@example.com'
        ]);

        Product::factory(10)->create();
    }
}
