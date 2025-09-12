<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Organizations;
use App\Models\Application_Form;
use App\Models\Interview;


class Jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';

    protected $fillable = [
       'organization_id',
        'title',
        'description',
        'location',
        'salary',
        'employment_type',
        'deadline',
        'status',
    ];

    protected $casts = [
        //'requirements' => 'array', // if you store as JSON
        //'posted_at' => 'datetime',
        'deadline' => 'date',
    ];

    /**
     * The organization that owns this job.
     */
    public function organization()
    {
        return $this->belongsTo(Organizations::class, 'organization_id');
    }

    /**
     * Applications submitted for this job.
     */
    public function applications()
    {
        return $this->hasMany(Application_Form::class, 'job_id');
    }

    /**
     * Interviews scheduled for this job through applications.
     */
    public function interviews()
    {
        return $this->hasManyThrough(
            Interview::class,
            Application_Form::class,
            'job_id',          // Foreign key on applications table
            'application_id',  // Foreign key on interviews table
            'id',              // Local key on jobs table
            'id'               // Local key on applications table
        );
    }
       public function jobSkillsets()
{
    return $this->hasMany(JobSkillset::class, 'job_id');
}
public function skills()
{
    return $this->belongsToMany(\App\Models\Skills::class, 'job_skillsets', 'job_id', 'skill_id');
}
}
