<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Wish;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class AjaxController extends Controller
{
    public function post_add_wish(Request $request)
    {
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric|exists:products,id'
            ], [
                'id.required' => 'Sản phẩm không hợp lệ.',
                'id.exists' => 'Sản phẩm không tồn tại.',
                'name.numeric' => 'Sản phẩm không hợp lệ.'
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'msg' => implode('<br />', $validator->errors()), 200));
            }
            $product = Products::find($request->id);
            if ($product) {
                if (Wish::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first()) {
                    return response()->json(array('msg' => 'Sản phẩm này đã tồn tại trong danh sách yêu thích.', 'status' => 0), 200);
                }
                $wish = new Wish();
                $wish->user_id = Auth::user()->id;
                $wish->product_id = $request->id;
                $wish->save();

                if ($wish->id) {
                    $count_wish = Wish::where('user_id', Auth::user()->id)->get();
                    return response()->json(array(
                        'msg' => 'Thêm vào yêu thích thành công 1.',
                        'status' => 1,
                        'wish' => $count_wish->count()
                    ), 200);
                }
            }
            return response()->json(array('msg' => 'Thêm vào yêu thích thất bại.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>', 'status' => 0), 200);
    }
    public function post_remove_wish(Request $request)
    {
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric|exists:products,id'
            ], [
                'id.required' => 'Sản phẩm không hợp lệ.',
                'id.exists' => 'Sản phẩm không tồn tại.',
                'name.numeric' => 'Sản phẩm không hợp lệ.'
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'msg' => implode('<br />', $validator->errors()), 200));
            }
            $product = Products::find($request->id);
            if ($product) {
                $wish = Wish::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
                if ($wish) {
                    $wish->delete();
                    $count_wish = Wish::where('user_id', Auth::user()->id)->get();
                    return response()->json(array(
                        'msg' => 'Xóa sản phẩm khỏi yêu thích thành công.',
                        'status' => 1,
                        'wish' => $count_wish->count()
                    ), 200);
                }
                return response()->json(array('msg' => 'Sản phẩm này chưa tồn tại trong danh sách yêu thích.', 'status' => 0), 200);
            }
            return response()->json(array('msg' => 'Xóa sản phẩm khỏi yêu thích thất bại 1.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>', 'status' => 0), 200);
    }
    public function post_get_cart(Request $request)
    {
        $carts = null;

        if (Auth::user()) {
            $carts = Auth::user()->cart;
        }
        if ($carts)
            $sub_total = total_cart($carts);
        else
            $sub_total = 0;
        return response()->json(array(
            'html' => view('pages.ajax.carts', compact('carts', 'sub_total'))->render(),
            'sub_total' => $sub_total,
            'status' => 1
        ), 200);
    }
    public function post_add_cart(Request $request)
    {
        if (Auth::user()) {
            $validator = Validator::make($request->all(), [
                'id' => 'required|numeric|exists:products,id'
            ], [
                'id.required' => 'Sản phẩm không hợp lệ.',
                'id.exists' => 'Sản phẩm không tồn tại.',
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'msg' => implode('<br />', $validator->errors()), 200));
            }
            $product = Products::find($request->id);
            if ($product) {
                $ecart = Cart::where('user_id', Auth::user()->id)->where('product_id', $request->id)->first();
                if ($ecart) {
                    if (isset($request->quantity) && $request->quantity > 0)
                        $ecart->quantity = (int)($ecart->quantity + $request->quantity);
                    else
                        $ecart->quantity = (int)($ecart->quantity + 1);
                    $ecart->save();
                    $count_cart = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                    return response()->json(array(
                        'msg' => 'Thêm vào giỏ hàng thành công.',
                        'status' => 1,
                        'cart' => $count_cart
                    ), 200);
                }
                $cart = new Cart();
                $cart->user_id = Auth::user()->id;
                $cart->product_id = $request->id;
                $cart->quantity = 1;
                $cart->save();
                if ($cart->id) {
                    $count_cart = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                    return response()->json(array(
                        'msg' => 'Thêm vào giỏ hàng thành công.',
                        'status' => 1,
                        'cart' => $count_cart
                    ), 200);
                }
            }
            return response()->json(array('msg' => 'Thêm vào giỏ hàng thất bại.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>', 'status' => 0), 200);
    }
    public function post_remove_product_cart(Request $request)
    {
        if (Auth::user()) {
            $cart = Cart::find($request->id);
            if ($cart) {
                $cart->delete();
                $count_cart = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                return response()->json(array(
                    'msg' => 'Xóa sản phẩm khỏi giỏ hàng thành công.',
                    'status' => 1,
                    'cart' => $count_cart
                ), 200);
            }
            return response()->json(array('msg' => 'Xóa sản phẩm khỏi giỏ hàng thất bại.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>.', 'status' => 0), 200);
    }
    public function dec_quantity(Request $request)
    {
        if (Auth::user()) {
            $cart = Cart::find($request->id);
            if ($cart) {
                $alert = '';
                if ($request->quantity != null && $request->quantity > 1) {
                    $cart->quantity = (int)($request->quantity - 1);
                } else if ($request->quantity != null && $request->quantity < 1) {
                    $cart->quantity = 1;
                    $alert = trans('system.min_product');
                } else {
                    $cart->quantity = 1;
                    $alert = trans('system.min_product');
                }
                $cart->save();
                $count_cart = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                $carts = null;
                if (Auth::user()) {
                    $carts = Auth::user()->cart;
                }
                $sub_total = total_cart($carts);
                return response()->json(array(
                    'quantity' => $cart->quantity,
                    'total' => ($cart->product->sale_price > 0 ? ($cart->product->sale_price * $cart->quantity) : ($cart->product->cost_price * $cart->quantity)),
                    'sub_total' => $sub_total,
                    'status' => 1,
                    'msg' => $alert,
                    'cart' => $count_cart
                ), 200);
            }
            return response()->json(array('msg' => 'Xóa sản phẩm khỏi giỏ hàng thất bại.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>.', 'status' => 0), 200);
    }
    public function inc_quantity(Request $request)
    {
        if (Auth::user()) {
            $cart = Cart::find($request->id);
            if ($cart) {
                $alert = '';
                if ($request->quantity != null && $request->quantity >= 1) {
                    $cart->quantity = (int)($request->quantity + 1);
                } else if ($request->quantity != null && $request->quantity < 1) {
                    $cart->quantity = 1;
                    $alert = trans('system.min_product');
                } else {
                    $cart->quantity = 1;
                    $alert = trans('system.min_product');
                }
                $cart->save();
                $count_cart = Cart::where('user_id', Auth::user()->id)->sum('quantity');
                $carts = null;
                if (Auth::user()) {
                    $carts = Auth::user()->cart;
                }
                $sub_total = total_cart($carts);
                return response()->json(array(
                    'quantity' => $cart->quantity,
                    'total' => ($cart->product->sale_price > 0 ? ($cart->product->sale_price * $cart->quantity) : ($cart->product->cost_price * $cart->quantity)),
                    'sub_total' => $sub_total,
                    'status' => 1,
                    'msg' => $alert,
                    'cart' => $count_cart
                ), 200);
            }
            return response()->json(array('msg' => 'Xóa sản phẩm khỏi giỏ hàng thất bại.', 'status' => 0), 200);
        }
        return response()->json(array('msg' => 'Bạn chưa đăng nhập.<br><a href="' . route('login') . '"><b>Đăng nhập ngay</b></a>.', 'status' => 0), 200);
    }
}