<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardOrderItem extends Model
{
    protected $fillable = ['card_order_id', 'card_id', 'quantity', 'card_image'];

    public function order()
    {
        return $this->belongsTo(CardOrder::class, 'card_order_id');
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
