<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function getImage()
    {
        if (!empty($this->image_name) && file_exists('admin/assets/images/product/' . $this->image_name)) {
            return asset('admin/assets/images/product/' . $this->image_name);
        } else {
            return '';
        }
    }
}
