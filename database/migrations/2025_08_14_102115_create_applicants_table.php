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
            $table->binary('resume',255)->nullable(); // Store PDF as BLOB
        $table->binary('cover_letter',255)->nullable(); // Store PDF as BLOB
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
