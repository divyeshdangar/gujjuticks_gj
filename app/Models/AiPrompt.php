<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AiPrompt extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $slug = Str::slug($model->title);
                $count = 1;
                $originalSlug = $slug;
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $model->slug = $slug;
            }
        });
    }

    protected $fillable = [
        'ai_prompt_category_id',
        'unique_id',
        'slug',
        'title',
        'description',
        'image',
        'meta_description',
        'meta_keywords',
        'prompt',
        'prompt_version',
        'copy_count',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected $searchable = [
        'title',
        'description',
        'prompt',
    ];

    public function scopeSearching($query)
    {
        if (request('search')) {
            $term = request('search');
            $query->where(function ($q) use ($term) {
                foreach ($this->searchable as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $term . '%');
                }
            });
        }
        return $query;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function category()
    {
        return $this->belongsTo(AiPromptCategory::class, 'ai_prompt_category_id');
    }

    public function comments()
    {
        return $this->hasMany(AiPromptComment::class)->orderBy('created_at', 'DESC');
    }

    public function incrementCopyCount(): void
    {
        $this->increment('copy_count');
    }
}
