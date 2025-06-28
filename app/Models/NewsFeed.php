<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsFeed extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'title',
        'location',
        'news_category_id',
    ];

    /**
     * Get the category associated with this feed.
     */
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'news_category_id');
    }
}
