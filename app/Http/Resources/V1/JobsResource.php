<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id,
            'organizationId' => $this->organization_id,
            'companyName' => $this->organization?->company_name,
 // include company name
            'title' => $this->title,
            'description' => $this->description,
            'location' => $this->location,
            'employmentType' => $this->employment_type,
            'salary' => $this->salary, // updated field
            'deadline'=>$this->deadline,
             'jobSkillsets' => JobsSkillsetsResource::collection($this->whenLoaded('jobSkillsets')), // Eager loaded skills
        ];
    }
}
