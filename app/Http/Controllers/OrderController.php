<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\Products;
use App\Models\Slides;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    public function check_out(Request $request)
    {
        $carts = null;

        if (Auth::user()) {
            $carts = Auth::user()->cart;
        }
        if ($carts)
            $sub_total = total_cart($carts);
        else
            $sub_total = 0;
        return view('pages.check-out', [
            'title' => 'Check Out',
            'carts' => $carts,
            'sub_total' => $sub_total
        ]);
    }

    public function proccess_check_out(Request $request)
    {
        $carts = null;

        if (Auth::user()) {
            $carts = Auth::user()->cart;
        }
        if ($carts->count() == 0)
            return redirect()->route('check-out');
        if ($carts)
            $sub_total = total_cart($carts);
        else
            $sub_total = 0;
        $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        while ($order) {
            reset_order($order->id);
            $order->delete();
            $order = Order::where('user_id', Auth::user()->id)->where('status', 0)->first();
        }
        $order = new Order();
        $order->user_id = Auth::user()->id;
        $order->address_id = 0;
        $order->sub_total = $sub_total ? $sub_total : 0;
        $order->total = $sub_total ? $sub_total : 0;
        $order->save();
        return view('pages.check-out-proccess', [
            'title' => 'Check Out Process',
            'carts' => $carts,
            'sub_total' => $sub_total,
            'order_id' => $order->id
        ]);
    }

    public function payment_check_out(Request $request)
    {
        if ($request) {
            $validator = Validator::make($request->all(), [
                'payment' => 'required',
                'address_id' => 'required',
                'sub_total' => 'required',
                'total' => 'required',
            ], [
                'payment.required' => 'Chưa chọn phương thức thanh toán.',
                'address_id.required' => 'Chưa chọn địa chỉ.',
                'sub_total.required' => 'Chưa có tổng sản phẩm.',
                'total.required' => 'Chưa có tổng hóa đơn.'
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            $order = Order::find($request->order_id);
            if ($order) {
                $order->address_id = $request->address_id ? $request->address_id : 0;
                $order->sub_total = $request->sub_total ? $request->sub_total : 0;
                $order->total = $request->total ? $request->total : 0;
                $order->save();
                if ($order->id) {
                    reset_order($order->id);
                    if ($request->product_id && sizeof($request->product_id) > 0) {
                        for ($i = 0; $i < sizeof($request->product_id); $i++) {
                            $detail = new OrderDetail();
                            $detail->order_id = $order->id;
                            $detail->product_id = $request->product_id[$i];
                            $detail->product_name = $request->product_name[$i];
                            $detail->product_price = $request->product_price[$i];
                            $detail->quantity = $request->product_quantity[$i];
                            $detail->total = $request->product_total[$i];
                            $detail->save();
                        }
                    }
                    session(['url_prev' => url()->previous()]);
                    $request->request->add(['id' => $order->id]);
                    $request->request->add(['info' => 'Pay fot order ' . $order->id]);
                    if ($request->payment == 'vnpay') {
                        // return view('pages.vnp');
                        return redirect()->route('vnpay', ['id' => $order->id]);
                    }
                    if ($request->payment == 'cod') {
                        $order->status = true;
                        $order->save();
                        $payment = new Payment();
                        $payment->order_id = $order->id;
                        $payment->user_id = Auth::user()->id;
                        $payment->payment = 'cod';
                        $payment->info = 'COD Order ' . $order->id;
                        $payment->price = $order->total;
                        $payment->status = true;
                        $payment->save();
                        if ($payment) {
                            reset_cart();
                            return redirect()->route('show-order', ['id' => $order->id])->with('success', 'Đã thanh toán đơn hàng thành công!');
                        }
                        return redirect()->route('proccess-check-out')->withInput();
                    }
                }
            }
            return redirect()->route('proccess-check-out')->withInput();
        }
    }

    public function show_order(Request $request)
    {
        if ($request->id) {
            $order = Order::find($request->id);
            if ($order) {
                return view('pages.order-detail', [
                    'title' => trans('system.order_detail', ['id' => $order->id]),
                    'order' => $order
                ]);
            }
        }
        return redirect()->route('home');
    }
    public function cancel_order(Request $request)
    {
        if (Auth::user() && $request->id) {
            $orders = Order::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
            if ($orders) {
                $orders->status = 5;
                $orders->save();
                return response()->json(array(
                    'status' => 1,
                    'msg' => trans('page.cancel_order_success'),
                ), 200);
            }
            return response()->json(array(
                'status' => 0,
                'msg' => trans('page.cancel_order_failed_user'),
            ), 200);
        }
        return response()->json(array(
            'status' => 0,
            'msg' => trans('page.cancel_order_failed'),
        ), 200);
    }
}
