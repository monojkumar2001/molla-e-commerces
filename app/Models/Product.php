<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_title',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'category_id',
        'sub_category_id',
        'brand_id',
        'image',
        'price',
        'old_price',
        'stock_quantity',
        'short_description',
        'description',
        'additional_information',
        'shipping_returns',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }


    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class,'product_id');
    }
}