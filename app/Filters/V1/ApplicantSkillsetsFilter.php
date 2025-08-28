<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class ApplicantSkillsetsFilter extends ApiFilter
{
    /**
     * Allowed parameters for filtering.
     */
    protected $safeParms = [
        'id' => ['eq', 'gt', 'lt', 'gte', 'lte'],           // filter by pivot ID
        'applicantId' => ['eq', 'gt', 'lt', 'gte', 'lte'],  // filter by applicant_id
        'skillId' => ['eq', 'gt', 'lt', 'gte', 'lte'],      // filter by skill_id
        'skillName' => ['eq', 'like'],                       // filter by skill_name (from related skill)
    ];

    /**
     * Map incoming query parameters to actual column names.
     */
    protected $columnMap = [
        'applicantId' => 'applicant_id',
        'skillId' => 'skill_id',
        'skillName' => 'skill_name', // for related table, may need join in query
    ];
}
