<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
    //pizzaList Descending && Ascending
    public function pizzaList(Request $request){
        //logger($request->status);
        if($request->status=='asc'){
            $data=Product::orderBy('created_at','asc')->get();
        }
        else{
            $data=Product::orderBy('created_at','desc')->get();
        }

        return $data;
    }

    //createCart
    public function createCart(Request $request){
        $data=$this->requestDataCart($request);
        Cart::create($data);

        $response=[
            'message'=>'Add to card complete',
            'status'=>'success',
        ];
        return response()->json($response , 200);

    }

    private function requestDataCart($request){
       return[
        'user_id'=>$request->userId,
        'product_id'=>$request->pizzaId,
        'qty'=>$request->orderCount,
       ];
    }
}
