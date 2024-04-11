<?php

namespace App\Http\Controllers;

use User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function get_login()
    {
        if (Auth::check() && Auth::user() &&  (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('staff'))) {
            return redirect()->route('dashboards');
        } else {
            return view('dashboards.auth.login');
        }
    }
    public function post_login(Request $request)
    {
        if (Auth::check() && Auth::user() &&  (Auth::user()->hasRole('Admin') || Auth::user()->hasRole('Manager') || Auth::user()->hasRole('Staff'))) {
            return redirect()->route('dashboards');
        } else {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:6|max:255',
            ], [
                'email.required' => 'Bạn chưa nhập email.',
                'email.email' => 'Email không hợp lệ.',
                'password.required' => 'Bạn chưa nhập mật khẩu.',
                'password.min' => 'Mật khẩu không hợp lệ.',
                'password.max' => 'Mật khẩu không hợp lệ.',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                $credentials = [
                    'email' => $request['email'],
                    'password' => $request['password'],
                ];
                if ($request->has('remember')) {
                    $remember = true;
                } else {
                    $remember = false;
                }
                if (Auth::attempt($credentials, $remember)) {
                    // $data = [
                    //     'last_login_at' => Carbon::now(),
                    //     'last_login_ip' => $request->getClientIp(),
                    // ];
                    // $admin->fill($data)->save();
                    return redirect()->route('dashboards');
                    // return 123;
                } else {
                    return redirect()->back()->withInput()->withErrors(['Tài khoản hoặc mật khẩu không chính xác.']);
                }
            }
        }
    }
    public function get_logout(Request $request)
    {
        if (Auth::check() && Auth::user() &&  (Auth::user()->hasRole('admin') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('staff'))) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('dashboards');
        } else {
            return view('dashboards.auth.login');
        }
    }
}
