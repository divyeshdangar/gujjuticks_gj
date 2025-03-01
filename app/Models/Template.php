<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use URL;

class Template extends Model
{
    use HasFactory;

    protected $table = 'template';
    protected $types = [
        "1" => "Link Page",
        "2" => "Wish/One Page"
    ];

    protected $searchable = [
        'title',
        'description'
    ];

    public function getType()
    {
        return ($this->type) ? $this->types[$this->type] : "";
    }

    public function getTypes()
    {
        return $this->types;
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

    public function image()
    {
        $this->image = URL::asset('/images/template/' . $this->image);
        return $this->image;
    }

}
