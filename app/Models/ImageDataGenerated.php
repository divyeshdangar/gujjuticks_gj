<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageDataGenerated extends Model
{
    protected $casts = [
        'options' => 'array',
    ];
}
