<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasFactory, hasTranslations;

    protected $guarded = [];

    public $translatable = ['title', 'description'];

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    public function card() {
        return $this->belongsToMany(Card::class,'cards');
    }
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function quantityOfCart() {
        return $this->hasOne(Quantity_product::class);
    }

    public function sections() {
        return $this->belongsToMany(Section::class);
    }
}
