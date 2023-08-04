<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Category extends Model
{
    use HasFactory, hasTranslations;

    public $translatable = ['title'];
    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function parents() {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent');
    }
}
