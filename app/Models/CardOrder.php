<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardOrder extends Model
{
    protected $fillable = [
        'card_id',
        'name',
        'email',
        'phone',
        'custom_message',
        'card_image',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(CardOrderItem::class);
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'card_order_items')->withPivot(['front_image', 'back_image']);
    }
}
