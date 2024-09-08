<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductSize;
use Cart;
class PaymentController extends Controller
{
    public function addToCart(Request $request)
    {
        $getProduct = Product::getSingle($request->product_id);
        $total = $getProduct->discount_price;


        if (!empty($request->size_id)) {
            $size_id = $request->size_id;
            $getSize = ProductSize::getSingle($size_id);
            $size_price = !empty($getSize->price) ? $getSize->price : 0;
            $total = $total + $size_price;
        } else {
            $size_id = 0;
        }
        $color_id = !empty($request->color_id) ? $request->color_id : 0;
        Cart::add(array(
            'id' => $getProduct->id, // inique row ID
            'name' => 'Sample Item',
            'price' => $total,
            'quantity' => 4,
            'attributes' => array(
                'size_id' => $size_id,
                'color_id' => $color_id
            )
        ));
      
        return redirect()->back();
    }
}
