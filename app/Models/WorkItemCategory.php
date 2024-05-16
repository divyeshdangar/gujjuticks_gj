<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkItemCategory extends Model
{
    use HasFactory;

    public function items(): HasMany
    {
        return $this->hasMany(WorkItem::class, 'category_id');
    }
}
