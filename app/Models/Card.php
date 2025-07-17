<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'card_category_id',
        'title',
        'slug',
        'description',
        'image',
        'preview_image',
        'price',
        'is_active'
    ];

    protected $boolean = [
        "1" => "Yes",
        "0" => "No"
    ];

    public function getBool()
    {
        return $this->boolean;
    }

    protected $searchable = [
        'title',
        'description'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%' . request('search') . '%');
            }
        }
        return $q;
    }

    public function category()
    {
        return $this->belongsTo(CardCategory::class, 'card_category_id');
    }

    public function orders()
    {
        return $this->belongsToMany(CardOrder::class, 'card_order_items')->withPivot(['front_image', 'back_image']);
    }
}
