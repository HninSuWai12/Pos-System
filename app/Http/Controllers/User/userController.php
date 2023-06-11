<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class userController extends Controller
{
    //Home
    public function list(){
        $data=Product::get();
        $category=Category::get();
        $cart=Cart::where('user_id',Auth::user()->id)->get();

        //dd($user->toArray());
        return view('User.user')->with(['data'=>$data , 'category'=>$category , 'cart'=>$cart ]);
    }

    public function fliter($categoryId){

        $data=Product::where('category_id',$categoryId)->orderBy('created_at','desc')->get();

        $category=Category::get();
        return view('User.user')->with(['data'=>$data , 'category'=>$category]);

    }
    //detail
    public function detail($id){
        $data=Product::where('id',$id)->first();
        $pizza=Product::get();

        return view('User.Detail.DetailInfo')->with(['data'=>$data , 'pizza'=>$pizza]);
    }

    //cart
    public function cart(){
        $data=Cart::select('carts.*' , 'products.name as product_name' , 'products.price as product_price' , 'products.image as product_image')
                    ->leftJoin('products', 'products.id' ,'carts.product_id')->where('carts.user_id' ,Auth::user()->id)
                    ->get();
                    //dd($data->toArray());
                    $totalPrice=0;
                    foreach($data as $d){
                        $totalPrice+=$d->product_price * $d->qty;
                    }
                   // dd($totalPrice);
        return view('User.Detail.cart',compact('data' , 'totalPrice'));
    }
}
