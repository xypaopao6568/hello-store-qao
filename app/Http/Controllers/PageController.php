<?php

namespace App\Http\Controllers;

use App\Models\Slides;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function contact(Request $request)
    {
        return view('pages.contact');
    }
    public function shop()
    {
        $product_counts = Products::all();
        $product_count = count($product_counts);
        return view('pages.shop', [
            'title' => 'Trang Chủ',
            'categories' => Categories::where('status', true)->get(),
            'featured_products' => Products::where('status', true)
                ->orderBy('id', 'desc')
                ->limit(12)
                ->get(),
            'slide' => Slides::where('status', true)->inRandomOrder()->first(),
            'product_count' => $product_count
        ]);
    }
    public function index()
    {
        $slide = Slides::where('status', true)->get();
        $product = Products::where('status', true)
            ->orderBy('id', 'desc')
            ->limit(12)
            ->get();
        return view('pages.home', [
            'title' => 'Trang Chủ',
            'categories' => Categories::where('status', true)->get(),
            'featured_products' => $product,
            'slide' => $slide,
        ]);
    }
    public function category_detail(Request $request)
    {
        if (($slug = $request->slug) && $slug != '') {
            $data = Categories::where('slug', $slug)->get()->first();
            if ($data) {
                $product = $data->products;
                return view('pages.category', [
                    'title' => $data->name,
                    'category' => $data,
                    'products' => $product
                ]);
            }
        }
        return redirect()->route('home');
    }
    public function product_detail(Request $request)
    {
        if (($slug = $request->slug) && $slug != '') {
            $data = Products::where('slug', $slug)->get()->first();
            $related = Products::all()->random(4);
            if ($data) {
                return view('pages.product', [
                    'title' => $data->name,
                    'product' => $data,
                    'related' => $related
                ]);
            }
        }
        return redirect()->route('home');
    }

    public function search(Request $request)
    {
        $product = $request->input('search_key');
        $query = $request->input('query');

        if ($product === 'pro') {
            $results = Products::where('name', 'like', '%' . $query . '%')->get();
        } elseif ($product === 'cat') {
            $results = Categories::where('name', 'like', '%' . $query . '%')->get();
        } elseif ($product === 'all') {
            $results = Products::where('name', 'like', '%' . $query . '%')->get();
        } else {
            $results = [];
        }
        return view('pages.search', compact('results'));
    }
}
