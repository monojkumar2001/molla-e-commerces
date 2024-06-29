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
        'category_id',
        'sub_category_id',
        'sub_sub_category_id',
        'brand_id',
        'buy_price',
        'price',
        'discount_price',
        'stock_quantity',
        'meta_title',
        'meta_keywords',
        'meta_description',
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
    public function sub_sub_category()
    {
        return $this->belongsTo(SubSubCategory::class, 'sub_sub_category_id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }
    public function productColors()
    {
        return $this->hasMany(ProductColor::class, 'product_id');
    }
    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id');
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}