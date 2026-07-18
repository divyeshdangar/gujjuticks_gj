<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'place_id',
        'city_id',
        'place_category_id',
        'name',
        'slug',
        'phone',
        'website',
        'description',
        'address',
        'latitude',
        'longitude',
        'rating',
        'opening_hours',
        'user_ratings_total',
        'icon',
        'types',
        'vicinity',
        'google_maps_url',
        'category',
        'business_status',
        'reviews',
        'photos',
        'address_components',
        'editorial_summary',
        'price_level',
        'status'
    ];

    protected $searchable = [
        'name',
        'address'
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

        if (request('type')) {
            $q->where('place_category_id', request('type'));
        }

        if (request('city')) {
            $q->where('city_id', request('city'));
        }

        return $q;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function placeCategory()
    {
        return $this->belongsTo(PlaceCategory::class);
    }

    /** Public directory listings (imported / approved). */
    public function scopePublished($query)
    {
        return $query->where('status', 'success');
    }

    /** User form submissions awaiting admin review. */
    public function scopeAwaitingReview($query)
    {
        return $query->where('status', 'pending')
            ->where('place_id', 'like', 'manual-%');
    }

    public function isPublished(): bool
    {
        return $this->status === 'success';
    }

    public function isUserSubmission(): bool
    {
        return is_string($this->place_id) && str_starts_with($this->place_id, 'manual-');
    }
}
