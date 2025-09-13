<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationCourse extends Model
{
    use HasFactory;

    protected $table = 'organization_courses';

    protected $fillable = [
        'applicant_id',
        'organization_id',
        'course_name',
        'course_title',
        'course_description',
        'applied',
    ];

    // Relations (optional)
    public function applicant()
    {
        return $this->belongsTo(\App\Models\Applicants::class, 'applicant_id');
    }

    public function organization()
    {
        return $this->belongsTo(\App\Models\Organizations::class, 'organization_id');
    }
}
