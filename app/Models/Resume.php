<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resume extends Model
{
    protected $fillable = [
        'token',
        'firstname',
        'lastname',
        'email',
        'mobile',
        'website',
        'designation',
        'about',
        'image',
        'links',
        'language'
    ];

    // Auto-generate token on create
    protected static function booted()
    {
        static::creating(function ($resume) {
            $resume->token = (string) Str::uuid();
        });
    }

    public function skills()
    {
        return $this->hasMany(ResumeSkill::class);
    }

    public function educations()
    {
        return $this->hasMany(ResumeEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(ResumeExperience::class);
    }

    public function portfolios()
    {
        return $this->hasMany(ResumePortfolio::class);
    }
}
