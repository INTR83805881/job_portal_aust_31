<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Applicants;
use App\Models\Applicant_contacts;

class ApplicantsFactory extends Factory
{
    protected $model = Applicants::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'applicant']),
            'address' => $this->faker->address,
            'qualification' => $this->faker->word,
            //'skills' => $this->faker->words(3, true),
            'resume' => 'resumes/' . $this->faker->uuid() . '.pdf',
            'cover_letter' => 'covers/' . $this->faker->uuid() . '.pdf',
        ];
    }

    /**
     * Automatically create contacts after creating an applicant.
     */
    public function configure(): self
    {
        return $this->afterCreating(function (Applicants $applicant) {
            // 1–2 random phone contacts
            $numPhones = $this->faker->numberBetween(1, 2);
            for ($i = 0; $i < $numPhones; $i++) {
                Applicant_contacts::factory()->type('phone')->create([
                    'applicant_id' => $applicant->id,
                ]);
            }

            // 1–2 random email contacts
            $numEmails = $this->faker->numberBetween(1, 2);
            for ($i = 0; $i < $numEmails; $i++) {
                Applicant_contacts::factory()->type('email')->create([
                    'applicant_id' => $applicant->id,
                ]);
            }
        });
    }
}

/*
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
            $table->string('address');// Applicant's address
            $table->string('qualification'); // Applicant's qualification
            $table->json('skills'); // Applicant's skills stored as JSON
            $table->string('resume')->nullable(); // Path to the applicant's resume
            $table->string('cover_letter')->nullable(); // Path to the applicant's cover letter
*/
