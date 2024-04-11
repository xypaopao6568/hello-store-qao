<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Product_Categories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('dashboards');
    }
    public function index(Request $request)
    {
        $limit = 10;
        if ($request->session()->has('limit')) {
            $limit = $request->session()->get('limit');
        }
        if ($request->session()->has('sort-category')) {
            $sort = $request->session()->get('sort-category');
            $sorts = $request->session()->get('sort-categories');

            $lists = Categories::orderBy($sort, $sorts)->paginate($limit);
        } else {
            $lists = Categories::orderBy('name', 'desc')->paginate($limit);
        }


        if ($request->ajax) {
            return view('dashboards.ajax.body-table-category', ['lists' => $lists]);
        }
        return view('dashboards.category.index', ['title' => 'Danh Mục', 'lists' => $lists]);
    }
    public function get_view_products(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category) {
                $limit = 10;
                if ($request->session()->has('limit')) {
                    $limit = $request->session()->get('limit');
                }
                $product = $category->products()->paginate($limit);
                // if($request->session()->has('sort-product')){
                //     $sort = $request->session()->get('sort-product');
                //     $sorts = $request->session()->get('sort-products');

                //     $product = $category->products()->orderBy($sort, $sorts)->paginate($limit);
                // }else{
                //     $product = $category->products()->orderBy('name', 'desc')->paginate($limit);
                // }
                if ($request->ajax) {
                    return view('dashboards.ajax.body-table-view-product', ['lists' => $product, 'category' => $category]);
                }
                return view('dashboards.category.view-product', ['title' => $category->name . " | Sản phẩm", 'lists' => $product, 'category' => $category]);
            } else {
                return redirect()->route('category');
            }
        } else {
            return redirect()->route('category');
        }
    }
    public function seach(Request $request)
    {

        $limit = 10;
        if ($request->session()->has('limit')) {
            $limit = $request->session()->get('limit');
        }
        if ($request->session()->has('sort-category')) {
            $sort = $request->session()->get('sort-category');
            $sorts = $request->session()->get('sort-categories');

            $lists = Categories::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('description', 'LIKE', '%' . $request->key . '%')
                ->orderBy($sort, $sorts)->paginate($limit);
        } else {
            $lists = Categories::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('description', 'LIKE', '%' . $request->key . '%')
                ->orderBy($sort, $sorts)->paginate($limit);
        }
        return view('dashboards.ajax.body-table-category', ['lists' => $lists]);
    }
    public function post_add(Request $request)
    {
        if ($request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:50',
                'image' => 'required',
                'description' => 'max:250',
            ], [
                'name.required' => 'Chưa nhập tên danh mục.',
                'name.min' => 'Tên danh mục phải lớn hơn 6 ký tự.',
                'name.max' => 'Tên danh mục không vượt quá 50 ký tự.',
                'image.required' => 'Chưa nhập ảnh danh mục.',
                'description.max' => 'Mô tả danh mục quá dài.',
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
            }
            $category = new Categories();
            $category->name = $request->name;
            $category->name_en = vn_to_str($request->name);
            $category->description = $request->description;
            if ($request->image) {
                $image = $request->image;
                list($type, $image) = explode(';', $image);
                list(, $image)      = explode(',', $image);
                $image = base64_decode($image);
                $image_name = getToken() . time() . '.png';
                $path = 'images/category/' . $image_name;
                file_put_contents(public_path($path), $image);
                $category->image = $path;
            }
            $category->save();
            return response()->json(array('status' => 1, 'msg' => 'Thêm danh mục thành công!'), 200);
        }
        return response()->json(array('status' => -1, 'msg' => 'Không có dữ liệu gửi lên!'), 200);
    }
    public function post_delete(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category) {
                if ($category->image) {
                    try {
                        unlink(public_path($category->image));
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
                Product_Categories::where('category_id', $category->id)->delete();
                $category->delete();
                return 1;
            }
            return -1;
        }
        return 0;
    }
    public function post_deletes(Request $request)
    {
        if ($request->ids) {
            foreach ($request->ids as $id) {
                $category = Categories::find($id);
                if ($category) {
                    if ($category->image) {
                        try {
                            unlink(public_path($category->image));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                    Product_Categories::where('category_id', $category->id)->delete();
                    $category->delete();
                }
            }
            return 1;
        }
        return 0;
    }
    public function post_view(Request $request, $id)
    {
        if ($request->id) {
            $category = Categories::find($id);
            if ($category)
                return view('dashboards.category.view-category', ['title' => 'Danh sách danh mục', 'category' => $category, 'categories' => Categories::orderBy('name', 'desc')->get()]);
            return redirect(route('category'));
        }
        return redirect(route('category'));
    }
    public function get_edit(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category)
                return view('dashboards.category.edit', ['title' => 'Sửa sản phẩm', 'category' => $category, 'categories' => Categories::orderBy('name', 'desc')->get()]);
            return redirect(route('category'));
        }
        return redirect(route('category'));
    }
    public function post_edit(Request $request)
    {
        if ($request->name) {
            $user = Categories::find($request->id);
            if ($user) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:6|max:250',
                    'description' => 'required',
                ], [
                    'name.required' => 'Chưa nhập tên sản phẩm.',
                    'name.min' => 'Tên sản phẩm phải lớn hơn 6 ký tự.',
                    'name.max' => 'Tên sản phẩm không vượt quá 250 ký tự.',
                ]);
                if ($validator->fails()) {
                    return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
                }
                Categories::find($request->id)->update([
                    'slug' => null,
                    'name' => $request->name,
                    'description' => $request->description,
                    'name_en' => vn_to_str($request->name),
                ]);
                return redirect()->route('category');
            }
            return response()->json(array('status' => -1, 'msg' => 'Danh mục không tồn tại!'), 200);
        }
        return 0;
    }
    public function post_change(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category) {
                $category->status = $request->status;
                $category->save();
                return 1;
            }
            return -1;
        }
        return 0;
    }
    public function ajax_image_slider_main(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category) {
                return view('dashboards.ajax.image-category-main', ['category' => $category]);
            }
            return 0;
        }
        return 0;
    }
    public function edit_image_category(Request $request)
    {
        if ($request->id) {
            $category = Categories::find($request->id);
            if ($category) {
                if ($category->image) {
                    try {
                        unlink(public_path($category->image));
                    } catch (\Throwable $th) {
                    }
                    $category->image = '';
                    $category->save();
                }
                if ($request->image) {
                    $image = $request->image;
                    list($type, $image) = explode(';', $image);
                    list(, $image)      = explode(',', $image);
                    $image = base64_decode($image);
                    $image_name = getToken() . time() . '.png';
                    $path = 'images/category/' . $image_name;
                    file_put_contents(public_path($path), $image);
                    $category->image = $path;
                    $category->save();
                    return 1;
                }
                return 0;
            }
            return -1;
        }
        return 0;
    }
}
