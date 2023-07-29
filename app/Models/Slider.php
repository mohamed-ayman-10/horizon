<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasFactory, hasTranslations;
     protected $guarded = [];
    public $translatable = ['title', 'description'];
}
