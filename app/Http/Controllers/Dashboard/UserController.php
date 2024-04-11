<?php

namespace App\Http\Controllers\Dashboard;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserAdminService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    protected $userAdminService;
    public function __construct(UserAdminService $userAdminService)
    {
        $this->middleware('dashboards');
        $this->userAdminService = $userAdminService;
    }
    public function index(Request $request)
    {
        $limit = 10;
        $role = Role::all();
        if ($request->session()->has('limit')) {
            $limit = $request->session()->get('limit');
        }
        if ($request->session()->has('sort-use')) {
            $sort = $request->session()->get('sort-use');
            $sorts = $request->session()->get('sort-use');

            $user = User::orderBy($sort, $sorts)->paginate($limit);
        } else {
            $user = User::orderBy('name', 'desc')->paginate($limit);
        }
        if ($request->ajax) {
            return view('dashboards.ajax.body-table-product', ['lists' => $user]);
        }
        return view('dashboards.user.index', ['title' => 'User', 'lists' => $user, 'users' => User::orderBy('id', 'desc'), 'role' => $role]);
        // return view('dashboards.user.index');
    }
    public function post_add(Request $request)
    {
        if ($request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:250',
                'email' => 'required',
                'password' => 'required|numeric',
            ], [
                'name.required' => 'Chưa nhập tên sản phẩm.',
                'name.min' => 'Tên phải lớn hơn 6 ký tự.',
                'name.max' => 'Tên không vượt quá 250 ký tự.',
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
            }

            $user = new User();
            $user->name = $request->name;
            // $user->name_en = vn_to_str($request->name);
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;
            $user->save();
            return response()->json(array('status' => 1, 'id' => $user->id, 'msg' => 'Thêm user thành công!'), 200);
        }
        return response()->json(array('status' => -1, 'msg' => 'Không có dữ liệu gửi lên!'), 200);
    }
    public function post_delete($id)
    {
        try {
            User::find($id)->delete();
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);
        } catch (Exception $exception) {
            Log::error('Message' . $exception->getMessage());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
    public function get_edit(Request $request)
    {
        $role = Role::all();
        if ($request->id) {
            $user = $this->userAdminService->getEdit($request);
            // $user = User::find($request->id);
            if ($user)
                return view('dashboards.user.edit', ['title' => 'Sửa user', 'user' => $user, 'users' => User::orderBy('name', 'desc')->get(), 'role' => $role]);
            return redirect(route('user'));
        }
        return redirect(route('user'));
    }
    public function post_edit($id, Request $request)
    {;
        if ($request->name) {
            $user = User::find($request->id);
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:6|max:250',
                    'email' => 'required',
                    'password' => 'required',
                ], [
                    'name.required' => 'Chưa nhập tên sản phẩm.',
                    'name.min' => 'Tên sản phẩm phải lớn hơn 6 ký tự.',
                    'name.max' => 'Tên sản phẩm không vượt quá 250 ký tự.',
                ]);
                if ($validator->fails()) {
                    return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
                }
                // $user->name = $request->name;
                // $user->email = $request->email;
                // $user->name_en = vn_to_str($request->name);
                // $user->password = $request->password;
                // $user->role = $request->role;
                // $user->save();
                User::find($id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
                return redirect()->route('user');
            }
            return response()->json(array('status' => -1, 'msg' => 'Không tìm thấy user!'), 200);
        }

        return 0;
    }
    public function seach(Request $request)
    {
        $limit = 10;
        if ($request->session()->has('limit')) {
            $limit = $request->session()->get('limit');
        }
        if ($request->session()->has('sort-product')) {
            $sort = $request->session()->get('sort-product');
            $sorts = $request->session()->get('sort-products');

            $product = User::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('email', 'LIKE', '%' . $request->key . '%')
                ->orderBy($sort, $sorts)->paginate($limit);
        } else {
            $product = User::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('email', 'LIKE', '%' . $request->key . '%')
                ->orderBy('name', 'desc')->paginate($limit);
        }
        return view('dashboards.ajax.body-table-product', ['lists' => $product]);
    }
}
