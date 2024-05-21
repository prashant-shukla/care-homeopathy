<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Patient;

class PatientAssessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get thepatient that owns the assessment.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

}
