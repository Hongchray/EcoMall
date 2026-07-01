<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImageDetail extends Model
{
    protected $fillable = [
        'product_id',
        'upload_id',
        'sort_order',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function upload()
    {
        return $this->belongsTo(Upload::class);
    }
}
