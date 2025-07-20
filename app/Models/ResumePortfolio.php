<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumePortfolio extends Model
{
    protected $fillable = ['resume_id', 'title', 'description', 'image'];

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
