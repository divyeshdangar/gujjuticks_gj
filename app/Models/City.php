<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'name', 'state', 'country', 'latitude', 'longitude', 'image'];

    protected $searchable = [
        'name'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            $q->where(function ($query) {
                foreach ($this->searchable as $key => $value) {
                    $query->orWhere($value, 'LIKE', '%' . request('search') . '%');
                }
            });
        }
        return $q;
    }

    public function placeCategories()
    {
        return $this->belongsToMany(
            PlaceCategory::class,
            'city_business_categories',
            'city_id',
            'place_category_id'
        );
    }

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }

    public function limitedPlaceCategories($limit = 5)
    {
        return $this->placeCategories()->limit($limit)->get();
    }
}
