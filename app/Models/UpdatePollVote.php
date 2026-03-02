<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdatePollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'update_post_id',
        'update_poll_option_id',
        'user_id',
    ];

    public function post()
    {
        return $this->belongsTo(UpdatePost::class, 'update_post_id');
    }

    public function option()
    {
        return $this->belongsTo(UpdatePollOption::class, 'update_poll_option_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

