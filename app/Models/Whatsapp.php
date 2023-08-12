<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Whatsapp extends Model
{
    use HasFactory, hasTranslations;

    public $translatable = ['title', 'description', 'button'];

    protected $guarded = [];
}
