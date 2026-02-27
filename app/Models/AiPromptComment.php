<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AiPromptComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ai_prompt_id',
        'user_id',
        'comment',
    ];

    public function aiPrompt()
    {
        return $this->belongsTo(AiPrompt::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
