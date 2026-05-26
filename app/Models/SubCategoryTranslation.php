<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategoryTranslation extends Model
{
    protected $table = 'subcategory_translations';

    protected $fillable = [
        'subcategory_id',
        'name',
        'lang',
    ];

    public function subcategory()
    {
        return $this->belongsTo(
            SubCategory::class,
            'subcategory_id'
        );
    }
}
