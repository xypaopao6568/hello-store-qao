<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function my_order(Request $request)
    {
        if (Auth::user()) {
            $orders = Order::where('user_id', Auth::user()->id)->where('status', '>',0)->get();
            return view('pages.my-order', [
                'title' => trans('system.my_order'),
                'orders' => $orders
            ]);
        }
        return redirect()->route('home');
    }
    public function my_address(Request $request)
    {
        if (Auth::user()) {
            $data = Address::where('user_id', Auth::user()->id)->get();
            return view('pages.my-address', [
                'title' => trans('system.my_address'),
                'address' => $data
            ]);
        }
        return redirect()->route('home');
    }
}
