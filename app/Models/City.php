<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'description', 'name', 'state', 'country', 'latitude', 'longitude', 'image'];

    public function placeCategories()
    {
        return $this->belongsToMany(
            PlaceCategory::class,
            'city_business_categories',
            'city_id',
            'place_category_id'
        );
    }

    public function limitedPlaceCategories($limit = 5)
    {
        return $this->placeCategories()->limit($limit)->get();
    }
}
