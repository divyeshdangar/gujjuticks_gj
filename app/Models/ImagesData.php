<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesData extends Model
{
    use HasFactory;

    protected $types = [
        "text" => "Text",
        "image" => "Image",
        "paragraph" => "Paragraph",
        "random_text" => "Random Text"
    ];

    protected $aligns = [
        "manual" => "Manual",
        "center" => "Center"
    ];

    public function getTypes()
    {
        return $this->types;
    }

    public function getAligns()
    {
        return $this->aligns;
    }
}
