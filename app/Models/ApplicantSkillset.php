<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantSkillset extends Model
{
    use HasFactory;

    protected $table = 'applicant_skillsets';

    protected $fillable = [
        'applicant_id',
        'skill_id',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    /**
     * Link to the skill.
     */
   // App\Models\ApplicantSkillset.php

public function skill()
{
    return $this->belongsTo(Skills::class, 'skill_id');
}

}
