public function organization() {
    return $this->belongsTo(User::class, 'organization_id');
}
