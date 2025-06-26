<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Image extends Model
{
    use HasFactory;

    protected $types = [
        "color" => "Color",
        "image" => "Image",
        "random_color" => "Random Color"
    ];

    protected $searchable = [
        'title',
        'description'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%'.request('search').'%');
            }
        }
        return $q;
    }

    public function data($all = false): HasMany
    {
        if($all){
            return $this->hasMany(ImagesData::class);
        } else {
            return $this->hasMany(ImagesData::class)->where('list_order', '>', 0)->orderBy('list_order', 'ASC');
        }
    }

    public function getTypes()
    {
        return $this->types;
    }
}
