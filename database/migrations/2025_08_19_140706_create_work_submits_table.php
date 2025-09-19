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
        Schema::create('work_submits', function (Blueprint $table) {
             $table->id();
              $table->foreignId('applicant_id')->constrained('applicants')->onDelete('cascade');
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            $table->string('work_file_path')->nullable(); 
           $table->enum('rating', ['1', '2', '3', '4', '5'])->nullable(); // Rating out of 5
            $table->text('feedback')->nullable(); // Feedback from the organization
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_submits');
    }
};
