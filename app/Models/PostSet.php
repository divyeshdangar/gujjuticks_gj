<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostSet extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'slug', 'meta_description', 'keywords'];

    public function posts()
    {
        return $this->hasMany(PostItem::class);
    }
}
