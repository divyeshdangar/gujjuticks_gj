<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
        'is_important',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_important' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function updates()
    {
        return $this->hasMany(UpdatePost::class);
    }
}

