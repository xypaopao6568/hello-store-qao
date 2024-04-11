<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Slides;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function product_detail(Request $request){
        if(($slug = $request->slug) && $slug!=''){
            $product = Products::where('slug', $slug)->get()->first();
            if($product){
                return view('pages.product', [
                    'title' => $product->name,
                    'product' => $product
                ]);
            }
        }
    }
}
