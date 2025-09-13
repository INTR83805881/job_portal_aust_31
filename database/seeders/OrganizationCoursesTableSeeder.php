<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OrganizationCourse;

class OrganizationCoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 fake organization courses
        OrganizationCourse::factory()->count(20)->create();
    }
}
