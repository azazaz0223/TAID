<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    use HasFactory;

    protected $fillable = [
        'zh_title',
        'en_title',
        'content',
        'image2',
        'image2_title',
        'image2_content',
        'image2_content_image',
        'image3',
        'image3_title',
        'image3_content',
        'image3_content_image',
    ];
}
