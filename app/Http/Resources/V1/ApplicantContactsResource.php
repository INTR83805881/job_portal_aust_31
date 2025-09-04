<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApplicantContactsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, //->uncomment to check id
            'applicantId' => $this->applicant_id,
            'type' => $this->type,      // 'phone' or 'email'
            'value' => $this->value,    // phone number or email address 
        ];
    }
}
