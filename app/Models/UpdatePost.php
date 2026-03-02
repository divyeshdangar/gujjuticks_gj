<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class UpdatePost extends Model
{
    use HasFactory, SoftDeletes;

    public const TYPE_STATUS = 'status';
    public const TYPE_IMAGE = 'image';
    public const TYPE_YOUTUBE = 'youtube';
    public const TYPE_POLL = 'poll';
    public const TYPE_QA = 'qa';

    public const PRIVACY_PUBLIC = 'public';
    public const PRIVACY_PRIVATE = 'private';

    public const STATUS_ACTIVE = 'active';
    public const STATUS_DELETED = 'deleted';
    public const STATUS_REPORTED = 'reported';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'city_id',
        'update_category_id',
        'type',
        'privacy',
        'status',
        'created_by',
        'image',
        'youtube_url',
        'external_link',
        'poll_question',
        'qa_question',
    ];

    protected static function booted()
    {
        static::creating(function (self $model) {
            if (empty($model->slug)) {
                $baseSlug = Str::slug($model->title ?: 'update');
                $slug = $baseSlug;
                $count = 1;

                while (self::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $count++;
                }

                $model->slug = $slug;
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeVisibleFor($query, ?int $userId = null)
    {
        return $query->where(function ($inner) use ($userId) {
            $inner->where('privacy', self::PRIVACY_PUBLIC);

            if ($userId) {
                $inner->orWhere(function ($privateQuery) use ($userId) {
                    $privateQuery
                        ->where('privacy', self::PRIVACY_PRIVATE)
                        ->where('created_by', $userId);
                });
            }
        });
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function category()
    {
        return $this->belongsTo(UpdateCategory::class, 'update_category_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(UpdateComment::class)->orderBy('id', 'desc');
    }

    public function reactions()
    {
        return $this->hasMany(UpdateReaction::class);
    }

    public function pollOptions()
    {
        return $this->hasMany(UpdatePollOption::class);
    }

    public function answers()
    {
        return $this->hasMany(UpdateAnswer::class)->orderBy('id', 'desc');
    }
}

