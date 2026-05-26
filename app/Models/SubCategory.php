<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    protected $with = ['subcategory_translations'];

    protected $fillable = [
        'category_id',
        'slug',
        'image',
        'description',
    ];



    public function getTranslation($field = '', $lang = false)
    {
        $lang = $lang ?: App::getLocale();

        $translation = $this->subcategory_translations
            ->firstWhere('lang', $lang);

        if (!empty($translation?->$field)) {
            return $translation->$field;
        }

        return $this->{$field} ?? null;
    }

    public function subcategory_translations()
    {
        return $this->hasMany(SubCategoryTranslation::class, 'subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id');
    }

    public function SubCategories()
    {
        return $this->hasMany(SubCategory::class, 'subcategory_id');
    }

    public function subcategoryImage()
    {
        return $this->belongsTo(Upload::class, 'image');
    }
}
