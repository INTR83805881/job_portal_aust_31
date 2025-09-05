<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    use App\Models\Organization_contacts;
    use \App\Models\Jobs;
    use \App\Models\Application_Form;
    use \App\Models\Interview; 
    use \App\Models\User;

class Organizations extends Model
{
    use HasFactory;

    

    protected $table = 'organizations';

    protected $fillable = [
        'user_id',
        'company_name',
        //'website',  // primary website
        'address',
    ];

    /**
     * Link to the user account.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Organization contacts (phones and emails).
     */
    public function contacts()
    {
        return $this->hasMany(Organization_contacts::class, 'organization_id')
                    ->whereIn('type', ['phone', 'email', 'website']);
    }

    /**
     * Additional websites stored in organization_contacts.
     */
   /* public function websites()
    {
        return $this->hasMany(Organization_contacts::class, 'organization_id')
                    ->where('type', 'website');
    }
*/
    /**
     * Jobs this organization has enlisted (available jobs).
     */
    public function jobs()
    {
        return $this->hasMany(Jobs::class, 'organization_id')
                    ->where('status', 'enlisted');
    }

    /**
     * Applications received for this organization's jobs.
     */
    public function applicationsReceived()
    {
        return $this->hasManyThrough(
            Application_Form::class,
            Jobs::class,
            'organization_id',  // Foreign key on jobs table
            'job_id',           // Foreign key on application_forms table
            'id',               // Local key on organizations table
            'id'                // Local key on jobs table
        );
    }

    /**
     * Interviews scheduled for this organization's jobs.
     */
    public function interviewsScheduled()
    {
        return $this->hasManyThrough(
            Interview::class,
            Application_Form::class,
            'job_id',          // Foreign key on application_forms table
            'application_id',  // Foreign key on interviews table
            'id',              // Local key on organizations table
            'id'               // Local key on application_forms table
        );
    }
}
