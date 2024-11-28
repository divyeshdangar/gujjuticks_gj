<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use URL;

class WebpageLink extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type',
        'link',
        'title'
    ];

    protected $searchable = [
        'title',
        'link',
        'type'
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

    public function image()
    {
        $image = URL::asset('/images/link/' . $this->image);
        return $image;
    }


}
