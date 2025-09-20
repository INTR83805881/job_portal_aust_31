<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicant;
use App\Models\Jobs;

class JobCompletion extends Model
{
   protected $table = 'job_completions';

    protected $fillable = [
        'applicant_id',
        'job_id',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    // Relationship to Applicant
    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    // Relationship to Job
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
