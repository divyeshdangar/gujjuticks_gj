<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeExperience extends Model
{
    protected $fillable = [
        'resume_id',
        'title',
        'place',
        'city',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'is_ongoing',
        'experience'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
