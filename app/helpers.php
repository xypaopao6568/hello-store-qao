<?php
if (! function_exists('total_cart')) {
    function total_cart($carts) {
        return $carts->sum(function ($carts) {
            return $carts->product->sale_price > 0?
                $carts->product->sale_price*$carts->quantity:
                $carts->product->cost_price*$carts->quantity;
        });
    }
}
if (! function_exists('reset_cart')) {
    function reset_cart() {
        \App\Models\Cart::where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->delete();
    }
}
if (! function_exists('check_pay')) {
    function check_pay($key) {
        $val = \App\Models\Config::where('key', $key)->first();
        return $val?(boolean)$val->value:0;
    }
}
if (! function_exists('config_site')) {
    function config_site($key) {
        $val = \App\Models\Config::where('key', $key)->first();
        return $val?$val->value:0;
    }
}
if (! function_exists('reset_order')) {
    function reset_order($id) {
        \App\Models\OrderDetail::where('order_id', $id)->delete();
    }
}
if (! function_exists('vn_to_str')) {
    function vn_to_str($str) {
        $unicode = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd'=>'đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D'=>'Đ',
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );
        foreach($unicode as $khongdau=>$codau) {
            $arr=explode("|",$codau);
            $str = str_replace($arr,$khongdau,$str);
        }
        return $str;
    }
}
if (! function_exists('getToken')) {
    function getToken(){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet.= "0123456789";

        mt_srand(mt_rand(1, 9999999));
        $length = 12;
        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }
}
