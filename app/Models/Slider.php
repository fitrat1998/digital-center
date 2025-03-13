<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_uz',
        'title_en',
        'title_ru',
        'caption_uz',
        'caption_en',
        'caption_ru',
        'photo',
    ];
}
