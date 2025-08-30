protected $fillable = ['skill_id', 'applicant_id', 'status'];

public function skill() {
    return $this->belongsTo(Skill::class);
}

public function applicant() {
    return $this->belongsTo(User::class, 'applicant_id');
}
