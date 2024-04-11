<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Spatie\Analytics\Period;
use Spatie\Analytics\Analytics;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Products;

class DashboardsControllerAdmin extends Controller
{
    public function index()
    {
        $tatol = Payment::all();
        $total = 0;
        foreach ($tatol as $item) {
            $total = $total + $item->price;
        }

        $cart = Cart::all();
        $count_cart = count($cart);
        $productCount = Products::all()->count();
        $order = Order::all();
        return view('dashboards.dashboard', compact('order', 'total', 'count_cart', 'productCount'));
    }
}
