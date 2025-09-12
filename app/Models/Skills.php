<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    public function applicants()
{
    return $this->belongsToMany(\App\Models\Applicants::class, 'applicant_skillsets', 'skill_id', 'applicant_id');
}
}
