<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityBusinessCategory extends Model
{
    protected $fillable = [
        'city_id',
        'place_category_id',
        'status',
        'results_count'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function placeCategory()
    {
        return $this->belongsTo(PlaceCategory::class);
    }

}
