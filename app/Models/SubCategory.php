<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'subcategories';

    protected $fillable = ['name', 'slug', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function products()
    {
        // Products linked via sub_category_id column on products table
        return $this->hasMany(Product::class, 'sub_category_id');
    }

    public function subSubCategories()
    {
        return $this->hasMany(SubSubCategory::class);
    }
}
