<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlaceCategory extends Model
{
    protected $fillable = ['name', 'label', 'is_active'];

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

    public function businesses()
    {
        return $this->hasMany(Business::class);
    }
}
