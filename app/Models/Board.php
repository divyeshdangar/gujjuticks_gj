<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $searchable = [
        'title',
        'description'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%'.request('search').'%');
            }
        }
        return $q;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(BoardUser::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(WorkItemCategory::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(WorkItem::class);
    }
}
