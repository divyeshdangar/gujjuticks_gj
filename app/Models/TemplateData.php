<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\CommonHelper;

class TemplateData extends Model
{
    use HasFactory;

    protected $fillable = ['link'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($user) {
            $user->link = CommonHelper::generateUniqueCode('template_data', 'link');
        });
    }
}
