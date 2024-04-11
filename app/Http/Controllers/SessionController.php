<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;

class SessionController extends Controller
{
    public function add_pagginate(Request $request){
        if(isset($request->limit)){
            $request->session()->put('limit', $request->limit);
            return 1;
        }
        return 0;
    }
    public function add_sort(Request $request){
        if(isset($request->type)){
            if($request->type=='product'){
                $request->session()->put('sort-product', $request->sort);
                $request->session()->put('sort-products', $request->sorts);
                return 1;
            }
            if($request->type=='category'){
                $request->session()->put('sort-category', $request->sort);
                $request->session()->put('sort-categories', $request->sorts);
                return 1;
            }
            if($request->type=='slide'){
                $request->session()->put('sort-slide', $request->sort);
                $request->session()->put('sort-slides', $request->sorts);
                return 1;
            }
            return -1;
        }
        return 0;
    }
}
