<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use URL;

class Webpage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'link',
        'description',
        'user_id',
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

    public function profile()
    {
        $profile = URL::asset('/images/webpage/' . $this->profile);
        return $profile;
    }

    public function links()
    {
        return $this->hasMany(WebpageLink::class);
    }
}