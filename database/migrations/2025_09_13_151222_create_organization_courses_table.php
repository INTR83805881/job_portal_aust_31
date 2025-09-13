<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organization_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('applicant_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('course_name');
            $table->string('course_title');
            $table->text('course_description');
            $table->boolean('applied')->default(false);
            $table->timestamps();

            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('organization_courses');
    }
};
