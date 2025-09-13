<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Applicants;
use App\Models\Organizations;
use App\Models\OrganizationCourse;

class OrganizationCourseFactory extends Factory
{
    protected $model = OrganizationCourse::class;

    public function definition(): array
    {
        return [
            'applicant_id' => Applicants::inRandomOrder()->first()?->id ?? Applicants::factory(),
            'organization_id' => Organizations::inRandomOrder()->first()?->id ?? Organizations::factory(),
            'course_name' => $this->faker->sentence(3),
            'course_title' => $this->faker->sentence(2), // Added required field
            'course_description' => $this->faker->paragraph(),
            'applied' => $this->faker->boolean(30),
        ];
    }
}
