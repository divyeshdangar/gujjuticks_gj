<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use URL;

class Location extends Model
{
    use HasFactory;

    protected $searchable = [
        'name',
        'name_gj',
        'description',
        'description_gj',
        'details',
        'details_gj'
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

    public function parent(): HasOne
    {
        return $this->hasOne(Location::class, 'id', 'parent_id');
    }

    public function image_link()
    {
        return URL::asset('/images/location/' . $this->image);
    }

}
