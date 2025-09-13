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


    protected $table = 'application_forms';

    protected $fillable = [
        'jobs_id',
        'applicant_id',
       
    ];

    protected $casts = [
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
        return $this->belongsTo(Jobs::class, 'jobs_id');
    }
}
