<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'file_number',
        'first_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone_number',
        'next_of_kin_name',
        'next_of_kin_relationship',
        'next_of_kin_phone_number',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->patient_number = 'SH-' . str_pad(rand(0, 99999), 5, '0', STR_PAD_LEFT);
        });
    }

    protected $dates = [
        'date_of_birth',
    ];

    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
