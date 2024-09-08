<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'price',
    ];
    static public function getSingle($id)
    {
        return self::find($id);
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
