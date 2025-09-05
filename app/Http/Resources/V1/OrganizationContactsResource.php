<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrganizationContactsResource extends JsonResource
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
           'organizationId' => $this->organization_id, // FK to organizations(check organizations table)
            'type' => $this->type,                        // 'phone', 'email', or 'website'
            'value' => $this->value,                      // actual phone/email/website
        ];
    }
}
