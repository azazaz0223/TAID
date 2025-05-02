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
        'image1',
        'image2',
    ];
}
