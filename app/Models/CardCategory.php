<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardCategory extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['name', 'slug', 'description'];

    protected $searchable = [
        'name',
        'description'
    ];

    protected $boolean = [
        "1" => "Yes",
        "0" => "No"
    ];

    public function getBool()
    {
        return $this->boolean;
    }

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%'.request('search').'%');
            }
        }
        return $q;
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

}
