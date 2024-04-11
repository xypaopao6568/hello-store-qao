<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Http;

class VNPay extends Controller
{
    public function create($productId, Request $request)
    {

        // $product = Order::with(['products', 'address', 'user'])->find($productId);
        // $amount = $product->total; // Số tiền thanh toán
        // $description = $product->user->name; // Mô tả đơn hàng
        // $momoApiKey = 'your_momo_api_key'; // API key của bạn

        // // Gửi yêu cầu tạo mã QR tới Momo
        // $response = Http::post('https://payment.momo.vn/generate', [
        //     'partnerCode' => 'your_partner_code',
        //     'accessKey' => $momoApiKey,
        //     'amount' => $amount,
        //     'orderId' => 'unique_order_id',
        //     'orderInfo' => $description,
        // ]);

        // // Xử lý dữ liệu trả về từ Momo
        // $responseData = $response->json();
        // $qrCodeData = $responseData['data']['qrCode'];

        // // Tạo mã QR và trả về cho frontend
        //$qrCode = QrCode::format('png')->size(200)->generate($qrCodeData);

        // return response()->json(['qrCode' => base64_encode($qrCode)]);
        // Tìm thông tin sản phẩm dựa vào $productId
        $product = Order::with(['products', 'address'])->find($productId);

        //Tạo mã QR dựa trên thông tin sản phẩm
        $qrCode = QrCode::size(350)->generate($product); // Ví dụ: Sử dụng tên sản phẩm
        return view('pages.vnp', compact('product', 'qrCode'));
    }
}
