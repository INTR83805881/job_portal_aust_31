<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
                'id' => $this->id,
                'userId' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'role' => $this->user->role,
                'profilePicture' => $this->user->profile_picture,
            'companyName' => $this->company_name,
            'address' => $this->address,
            'contacts' => OrganizationContactsResource::collection($this->whenLoaded('contacts')),
            'jobs' => JobsResource::collection($this->whenLoaded('jobs')),
            'jobSkillsets' => JobSkillsetsResource::collection($this->whenLoaded('jobSkillsets')),
            ];
    }
}
