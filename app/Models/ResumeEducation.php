<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeEducation extends Model
{
    protected $fillable = [
        'resume_id',
        'title',
        'place',
        'start_month',
        'start_year',
        'end_month',
        'end_year',
        'is_ongoing',
        'description'
    ];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
