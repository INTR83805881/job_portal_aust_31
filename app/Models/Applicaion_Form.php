<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Applicants;
use App\Models\Jobs;    
use App\Models\Interview;



class Applicaion_Form extends Model
{
    use HasFactory;


    protected $table = 'applicaion__forms';

    protected $fillable = [
        'job_id',
        'applicant_id',
        //'status',
        //'cover_letter',
        //'skills',
        //'resume',
        //'applied_at',
    ];

    protected $casts = [
        //'skills' => 'array',
        //'applied_at' => 'datetime',
    ];

    /**
     * The applicant who submitted this application.
     */
    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    /**
     * The job this application is for.
     */
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    /**
     * The interview associated with this application.
     */
    public function interview()
    {
        return $this->hasOne(Interview::class, 'application_id');
    }

    /**
     * Automatically get applicant info (skills, resume, cover letter) for this application.
     */
    public function getApplicantInfoAttribute()
    {
        return [
            'address' => $this->applicant->address ?? null,
            'qualification' => $this->applicant->qualification ?? null,
            'skills' => $this->applicant->skills ?? null,
            'resume' => $this->applicant->resume ?? null,
            'cover_letter' => $this->cover_letter ?? $this->applicant->cover_letter ?? null,
        ];
    }
}
