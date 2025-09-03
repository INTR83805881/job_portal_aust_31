<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JobsSkillsetsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'skill_id' => $this->skill_id,
            'skill_name' => $this->skill ? $this->skill->skill_name : null,
            //eikhane pore ig change korte hoite pare
        ];
    }
}
