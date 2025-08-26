<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostSet extends Model
{
    use HasFactory;

    protected $statuses = [
        "pending" => [
            "lable" => "Pending",
            "class" => "text-dark text-bg-warning"
        ],
        "created" => [
            "lable" => "Created",
            "class" => "text-light text-bg-success"
        ],
        "failed" => [
            "lable" => "Failed",
            "class" => "text-light text-bg-danger"
        ]
    ];

    protected $fillable = ['title', 'topic', 'caption', 'slug', 'meta_description', 'keywords', 'image_id'];

    protected $searchable = [
        'topic',
        'title',
        'meta_description'
    ];

    public function scopeSearching($q)
    {
        if (request('search')) {
            foreach ($this->searchable as $key => $value) {
                $q->orwhere($value, 'LIKE', '%' . request('search') . '%');
            }
        }
        return $q;
    }

    public function posts()
    {
        return $this->hasMany(PostItem::class);
    }

    public function instagramPostSets()
    {
        return $this->hasMany(InstagramPostSet::class);
    }

    public function isPostedByLoginUser(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return $this->instagramPostSets()
            ->where('user_id', Auth::id())
            ->exists();
    }

    public function getStatus($returnHtml = false)
    {
        if ($returnHtml) {
            return '<span class="badge ' . $this->statuses[$this->status]["class"] . '">' . $this->statuses[$this->status]["lable"] . '</span>';
        } else {
            return $this->statuses[$this->status]["lable"];
        }
    }

    public function getStatuses()
    {
        return $this->statuses;
    }
}
