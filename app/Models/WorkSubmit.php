<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Applicants;
use App\Models\Jobs;

class WorkSubmit extends Model
{
    use HasFactory;

     protected $table = 'work_submits';

    protected $fillable = [
        'applicant_id',
        'job_id',
        'work_file_path',
        'rating',
        'feedback',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    // Optional: Relationship to Job if you have a Jobs model
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }
}
