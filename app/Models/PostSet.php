<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostSet extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'slug', 'meta_description', 'keywords', 'image_id'];

    protected $searchable = [
        'title',
        'meta_description'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%' . request('search') . '%');
            }
        }
        return $q;
    }

    public function posts()
    {
        return $this->hasMany(PostItem::class);
    }
}
