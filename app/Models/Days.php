<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Days extends Model
{
    use HasFactory;

    const Types = [
        "History" => "history",
        "Fix" => "fix",
        "NonFix" => "non-fix",
        "News" => "news",
        "Event" => "event",
        "Wish" => "wish"
    ];

    protected $searchable = [
        'day',
        'month',
        'year',
        'slug',
        'title',
        'title_g',
        'title_h',
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

}
