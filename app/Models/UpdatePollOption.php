<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdatePollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'update_post_id',
        'option_text',
        'sort_order',
        'votes_count',
    ];

    public function post()
    {
        return $this->belongsTo(UpdatePost::class, 'update_post_id');
    }

    public function votes()
    {
        return $this->hasMany(UpdatePollVote::class);
    }
}

