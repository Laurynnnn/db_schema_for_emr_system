<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drug extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'brand_name',
        'form',
        'code',
    ];

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
