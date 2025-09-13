<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobCart extends Model
{
    use HasFactory;

     protected $table = 'job_carts';

    protected $fillable = [
        'jobs_id',
        'applicant_id',
        
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    /**
     * The job this application is for.
     */
    public function job()
    {
        return $this->belongsTo(Jobs::class, 'jobs_id');
    }
    
}
