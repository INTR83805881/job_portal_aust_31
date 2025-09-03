<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobSkillset extends Model
{
    use HasFactory;

     protected $table = 'job_skillsets';

    protected $fillable = [
        'job_id',
        'skill_id',
    ];

    public function job()
    {
        return $this->belongsTo(Jobs::class, 'job_id');
    }

    /**
     * Link to the skill.
     */
   // App\Models\JobSkillset.php

public function skill()
{
    return $this->belongsTo(Skills::class, 'skill_id');
}
}
