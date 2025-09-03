<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organizations;
use App\Models\Organization_contacts;
use App\Models\Jobs;
use App\Models\Skills;
use App\Models\JobSkillset;

class OrganizationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orgs1 = Organizations::factory()
            ->count(10)
            ->has(Organization_contacts::factory()->count(2), 'contacts')
            ->has(Jobs::factory()->count(3), 'jobs')
            ->create();

        $orgs2 = Organizations::factory()
            ->count(15)
            ->has(Organization_contacts::factory()->count(4), 'contacts')
            ->has(Jobs::factory()->count(5), 'jobs')
            ->create();

        $orgs3 = Organizations::factory()
            ->count(5)
            ->has(Organization_contacts::factory()->count(1), 'contacts')
            ->has(Jobs::factory()->count(2), 'jobs')
            ->create();

        // Merge all created organizations
        $organizations = $orgs1->merge($orgs2)->merge($orgs3);

        // Get all skills
        $allSkills = Skills::all()->pluck('id')->toArray();

        // Attach random skillsets to each job
        foreach ($organizations as $organization) {
            foreach ($organization->jobs as $job) {
                if (!empty($allSkills)) {
                    $skillsToAttach = collect($allSkills)->random(rand(1, 5))->toArray();

                    foreach ($skillsToAttach as $skillId) {
                        JobSkillset::create([
                            'job_id'   => $job->id,
                            'skill_id' => $skillId,
                        ]);
                    }
                }
            }
        }
    }
}
