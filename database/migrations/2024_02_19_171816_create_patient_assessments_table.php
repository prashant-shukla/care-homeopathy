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
        Schema::create('patient_assessments', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');

            $table->string('visited')->timestamp();
            // $table->string('family_history')->nullable();            
            // $table->string('medical_history');
            $table->string('past_illnesses')->nullable();
            $table->string('surgeries')->nullable();
            $table->string('medications')->nullable();
            $table->string('allergies')->nullable();
            $table->string('family_medical_history')->nullable();

            $table->string('chief_complaint')->nullable();
            $table->string('presenting_symptoms')->nullable();
            $table->string('physical_examination')->nullable();
            $table->string('review_of_systems')->nullable();
            $table->string('social_history')->nullable();

            $table->string('psychosocial_assessment')->nullable();
            $table->string('functional_assessment')->nullable();
            $table->string('diagnostic_tests_and_results')->nullable();
            $table->string('assessment_and_plan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
