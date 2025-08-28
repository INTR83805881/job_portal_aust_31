<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users table
             $table->string('address');// Applicant's address
             $table->string('qualification'); // Applicant's qualification
             // $table->json('skills'); // Applicant's skills stored as JSON
            $table->string('resume')->nullable(); // Path to the applicant's resume
            $table->string('cover_letter')->nullable(); // Path to the applicant's cover letter
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
