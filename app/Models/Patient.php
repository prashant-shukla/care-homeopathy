<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PatientAssessment;

class Patient extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    // protected $fillable = ['name', 'email'];

    /**
     * Get the assessments for the patient.
    */
    public function assessments(): HasMany
    {
        return $this->hasMany(PatientAssessment::class);
    }

}
