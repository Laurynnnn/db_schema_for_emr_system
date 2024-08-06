<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'symptoms',
        'lab_tests',
        'medical_diagnoses',
        'treatment_given',
        'outcome',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function labTests()
    {
        return $this->hasMany(LabTest::class);
    }

    public function diagnoses()
    {
        return $this->hasMany(Diagnosis::class);
    }
}
