<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiPrompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'ai_prompt_category_id',
        'unique_id',
        'title',
        'description',
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

    public function incrementCopyCount(): void
    {
        $this->increment('copy_count');
    }
}
