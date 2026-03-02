<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateComment extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 'active';
    public const STATUS_REPORTED = 'reported';
    public const STATUS_DELETED = 'deleted';

    protected $fillable = [
        'update_post_id',
        'user_id',
        'comment',
        'status',
        'reported_by',
    ];

    public function post()
    {
        return $this->belongsTo(UpdatePost::class, 'update_post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
}

