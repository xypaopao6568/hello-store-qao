<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\ImagesProducts;
use App\Models\Product_Categories;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
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
        if ($request->session()->has('sort-product')) {
            $sort = $request->session()->get('sort-product');
            $sorts = $request->session()->get('sort-products');

            $product = Products::orderBy($sort, $sorts)->paginate($limit);
        } else {
            $product = Products::orderBy('name', 'desc')->paginate($limit);
        }
        if ($request->ajax) {
            return view('dashboards.ajax.body-table-product', ['lists' => $product]);
        }
        return view('dashboards.product.index', ['title' => 'Sản Phẩm', 'lists' => $product, 'categories' => Categories::orderBy('id', 'desc')]);
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

            $product = Products::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('description', 'LIKE', '%' . $request->key . '%')
                ->orWhere('cost_price', 'LIKE', '%' . $request->key . '%')
                ->orWhere('count', 'LIKE', '%' . $request->key . '%')
                ->orderBy($sort, $sorts)->paginate($limit);
        } else {
            $product = Products::where('id', 'LIKE', '%' . $request->key . '%')
                ->orWhere('name', 'LIKE', '%' . $request->key . '%')
                ->orWhere('description', 'LIKE', '%' . $request->key . '%')
                ->orWhere('cost_price', 'LIKE', '%' . $request->key . '%')
                ->orWhere('count', 'LIKE', '%' . $request->key . '%')
                ->orderBy('name', 'desc')->paginate($limit);
        }
        return view('dashboards.ajax.body-table-product', ['lists' => $product]);
    }
    public function post_add(Request $request)
    {
        if ($request) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:6|max:250',
                'image' => 'required',
                'cost_price' => 'required|numeric',
                'unit' => 'required|min:1|max:20',
                'description' => 'max:250',
                'count' => 'required|numeric',
            ], [
                'name.required' => 'Chưa nhập tên sản phẩm.',
                'name.min' => 'Tên sản phẩm phải lớn hơn 6 ký tự.',
                'name.max' => 'Tên sản phẩm không vượt quá 250 ký tự.',
                'unit.required' => 'Chưa nhập đơn vị tính.',
                'unit.min' => 'Đơn vị tính phải từ 1 ký tự.',
                'unit.max' => 'Đơn vị tính không vượt quá 20 ký tự.',
                'image.required' => 'Chưa nhập ảnh sản phẩm.',
                'description.max' => 'Mô tả sản phẩm quá dài.',
                'cost_price.required' => 'Chưa nhập giá sản phẩm.',
                'cost_price.numeric' => 'Giá sản phẩm không hợp lệ.',
                'count.required' => 'Chưa nhập số lượng.',
                'count.numeric' => 'Số lượng không hợp lệ.',
            ]);
            if ($validator->fails()) {
                return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
            }
            $product = new Products();
            $product->name = $request->name;
            $product->name_en = vn_to_str($request->name);
            $product->description = $request->description;
            $product->cost_price = $request->cost_price;
            $product->unit = $request->unit;
            $product->count = $request->count;
            if ($request->image) {
                $image = $request->image;
                list($type, $image) = explode(';', $image);
                list(, $image)      = explode(',', $image);
                $image = base64_decode($image);
                $image_name = getToken() . time() . '.png';
                $path = 'images/product/' . $image_name;
                file_put_contents(public_path($path), $image);
                $product->image = $path;
            }
            $product->save();
            return response()->json(array('status' => 1, 'id' => $product->id, 'msg' => 'Thêm sản phẩm thành công!'), 200);
        }
        return response()->json(array('status' => -1, 'msg' => 'Không có dữ liệu gửi lên!'), 200);
    }
    public function post_view(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                return view('dashboards.ajax.view-product', ['product' => $product]);
            }
            return 0;
        }
        return 0;
    }
    public function get_edit(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product)
                return view('dashboards.product.edit', ['title' => 'Sửa sản phẩm', 'product' => $product, 'categories' => Categories::orderBy('name', 'desc')->get()]);
            return redirect(route('product'));
        }
        return redirect(route('product'));
    }
    public function post_edit(Request $request)
    {
        if ($request->name) {
            $product = Products::find($request->id);
            if ($product) {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|min:6|max:250',
                    'cost_price' => 'required|numeric',
                    'unit' => 'required|min:1|max:20',
                    'description' => 'max:250',
                    'count' => 'required|numeric',
                ], [
                    'name.required' => 'Chưa nhập tên sản phẩm.',
                    'name.min' => 'Tên sản phẩm phải lớn hơn 6 ký tự.',
                    'name.max' => 'Tên sản phẩm không vượt quá 250 ký tự.',
                    'unit.required' => 'Chưa nhập đơn vị tính.',
                    'unit.min' => 'Đơn vị tính phải từ 1 ký tự.',
                    'unit.max' => 'Đơn vị tính không vượt quá 20 ký tự.',
                    'description.max' => 'Mô tả sản phẩm quá dài.',
                    'cost_price.required' => 'Chưa nhập giá sản phẩm.',
                    'cost_price.numeric' => 'Giá sản phẩm không hợp lệ.',
                    'count.required' => 'Chưa nhập số lượng.',
                    'count.numeric' => 'Số lượng không hợp lệ.',
                ]);
                if ($validator->fails()) {
                    return response()->json(array('status' => 0, 'errors' => $validator->errors()), 200);
                }
                $product->slug = null;
                $product->name = $request->name;
                $product->name_en = vn_to_str($request->name);
                $product->description = $request->description;
                $product->cost_price = $request->cost_price ? $request->cost_price : 0;
                $product->sale_price = $request->sale_price ? $request->sale_price : 0;
                $product->unit = $request->unit;
                $product->info = $request->info ? $request->info : null;
                $product->status = $request->status;
                $product->count = $request->count;
                Product_Categories::where('product_id', $product->id)->delete();
                if ($request->categories && sizeof($request->categories) > 0)
                    foreach ($request->categories as $id) {
                        $tmp = new Product_Categories();
                        $tmp->product_id = $product->id;
                        $tmp->category_id = $id;
                        $tmp->save();
                    }
                $product->save();
                return response()->json(array('status' => 1, 'id' => $product->id, 'msg' => 'Sửa sản phẩm thành công!'), 200);
            }
            return response()->json(array('status' => -1, 'msg' => 'Không tìm thấy sản phẩm!'), 200);
        }
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                return view('dashboards.ajax.edit-product', ['product' => $product]);
            }
            return 0;
        }
        return 0;
    }
    public function post_delete(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                if ($product->image) {
                    try {
                        unlink(public_path($product->image));
                        //code...
                    } catch (\Throwable $th) {
                        //throw $th;
                    }
                }
                if ($product->images) {
                    foreach ($product->images as $item) {
                        if ($item->url) {
                            try {
                                unlink(public_path($item->url));
                            } catch (\Throwable $th) {
                            }
                        }
                        $item->delete();
                    }
                }
                Product_Categories::where('product_id', $product->id)->delete();
                $product->delete();
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
                $product = Products::find($id);
                if ($product) {
                    if ($product->image) {
                        try {
                            unlink(public_path($product->image));
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                    }
                    if ($product->images) {
                        foreach ($product->images as $item) {
                            if ($item->url) {
                                unlink(public_path($item->url));
                            }
                            $item->delete();
                        }
                    }
                    Product_Categories::where('product_id', $product->id)->delete();
                    $product->delete();
                }
            }
            return 1;
        }
        return 0;
    }
    public function add_image_product(Request $request)
    {
        if ($request->id && $request->image) {
            $product = Products::find($request->id);
            if ($product) {
                $image = $request->image;
                list($type, $image) = explode(';', $image);
                list(, $image)      = explode(',', $image);
                $image = base64_decode($image);
                $image_name = $product->id . "_" . getToken() . time() . '.png';
                $path = 'images/product/' . $image_name;
                file_put_contents(public_path($path), $image);
                $data = new ImagesProducts();
                $data->product_id = $product->id;
                $data->url = $path;
                $data->save();
                return 1;
            }
            return 0;
        }
        return 0;
    }
    public function ajax_image_product(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                return view('dashboards.ajax.image-product', ['product' => $product]);
            }
            return 0;
        }
        return 0;
    }
    public function ajax_image_product_main(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                return view('dashboards.ajax.image-product-main', ['product' => $product]);
            }
            return 0;
        }
        return 0;
    }
    public function edit_image_product(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                if ($product->image) {
                    try {
                        unlink(public_path($product->image));
                    } catch (\Throwable $th) {
                    }
                    $product->image = '';
                    $product->save();
                }
                if ($request->image) {
                    $image = $request->image;
                    list($type, $image) = explode(';', $image);
                    list(, $image)      = explode(',', $image);
                    $image = base64_decode($image);
                    $image_name = getToken() . time() . '.png';
                    $path = 'images/product/' . $image_name;
                    file_put_contents(public_path($path), $image);
                    $product->image = $path;
                    $product->save();
                    return 1;
                }
                return 0;
            }
            return -1;
        }
        return 0;
    }
    public function delete_image_product(Request $request)
    {
        if ($request->id) {
            $image = ImagesProducts::find($request->id);
            if ($image) {
                if ($image->url) {
                    try {
                        unlink(public_path($image->image));
                    } catch (\Throwable $th) {
                    }
                    $image->delete();
                    return 1;
                }
                return -2;
            }
            return -1;
        }
        return 0;
    }
    public function post_change(Request $request)
    {
        if ($request->id) {
            $product = Products::find($request->id);
            if ($product) {
                $product->status = $request->status;
                $product->save();
                return 1;
            }
            return -1;
        }
        return 0;
    }
}