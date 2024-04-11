<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('dashboards');
    }
    public function index()
    {
        $lists = Payment::with('User')->paginate(5);
        return view('dashboards.payment.index', ['title' => 'Payment', 'lists' => $lists, 'users' => Payment::orderBy('id', 'desc')]);
    }
    public function post_change(Request $request)
    {
        if ($request->id) {
            $category = Payment::find($request->id);
            if ($category) {
                $category->status = $request->status;
                $category->save();
                return 1;
            }
            return -1;
        }
        return 0;
    }
}
