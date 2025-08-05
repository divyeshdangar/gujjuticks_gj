<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostItem extends Model
{
    use HasFactory;

    protected $fillable = ['post_set_id', 'title', 'description', 'slug', 'order'];

    public function set()
    {
        return $this->belongsTo(PostSet::class, 'post_set_id');
    }
}
