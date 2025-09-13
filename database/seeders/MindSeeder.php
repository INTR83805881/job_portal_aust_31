<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mind;

class MindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Using factory to generate dummy data
        Mind::factory()->count(10)->create();

        // One sample static record
        Mind::create([
            'name' => 'John Doe',
            'about' => 'Visionary leader of our organization.',
            'photo' => 'default.png'
        ]);
    }
}
