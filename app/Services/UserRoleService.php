<?php

namespace App\Services;

use App\Models\Applicants;
use App\Models\Organizations;

class UserRoleService
{
    public function createApplicant($userId, $data)
    {
        $resumePath = isset($data['resume']) ? $data['resume']->store('resumes', 'public') : null;
        $coverLetterPath = isset($data['cover_letter']) ? $data['cover_letter']->store('cover_letters', 'public') : null;

        return Applicants::create([
            'user_id'      => $userId,
            'address'      => $data['address'],
            'qualification'=> $data['qualification'],
            'resume'       => $resumePath,
            'cover_letter' => $coverLetterPath,
        ]);
    }

    public function createOrganization($userId, $data)
    {
        return Organizations::create([
            'user_id'      => $userId,
            'company_name' => $data['company_name'],
            'address'      => $data['org_address'],
        ]);
    }
}
