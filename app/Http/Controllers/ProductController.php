<?php

namespace App\Http\Controllers;
use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{
    //
    public function list()
    {
        $products = Product::select('products.*' , 'categories.category_name as category_name')
                            ->when(request('searchData'),function($query){
                                $query->where('products.name','like','%'.request('searchData').'%');
                                    })
                                 ->leftJoin('categories','products.category_id','categories.id')
                                ->orderBy('products.id','desc')->paginate(3);


                                $products->appends(request()->all());

        return view('admin.Products.list', compact('products'));
    }

    public function add()
    {
        $categories = Category::select('id', 'category_name')->get();
        //dd($categories->toArray());
        return view('admin.Products.add', compact('categories'));
    }
    public function create(Request $request)
    {
         $this->validationProductCheck($request ,"create");
        $data = $this->requestData($request);
        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        //dd($data);
        Product::create($data);
        return redirect()->route('products#list');
    }

    //edit
    public function edit($id)
    {
        //dd($id);
        $data = Product::where('id', $id)->first();
        //dd($data->toArray());
        $categories = Category::select('id', 'category_name')->get();
        //dd($categories->toArray());
        return view('admin.Products.edit')->with(['data' => $data, 'category' => $categories]);
    }

    //update
    public function update(Request $request){
        //dd($id);
         $this->validationProductCheck($request , "update");
        $data=$this->requestData($request);
        if ($request->hasFile('image')) {
            $dbImage=Product::where('id' ,$request->pizzaId)->first();
            $dbImage=$dbImage->image;
            //dd($dbImage);
            if($dbImage!=null){
                storage::delete('public/'.$dbImage);
            }

            $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image']=$fileName;

        }



        Product::where('id',$request->pizzaId)->update($data);
        return redirect()->route('products#list');

    }
    //delete
    public function delete($id){
        //dd($id);
       //$data= Product::select('image')->where('id',$id)->first();
       //$fileName=$data['image'];
        //if (File::exists(public.path().'/storage/'.$fi
        //)) {
          //  dd('This is has');
        //}
        Product::where('id',$id)->delete();
        return back()->with(['delete'=>'Products Data Deleted']);
    }
    //SeeMore
    public function seeMore($id){
        $data=Product::select('products.*','categories.category_name')
                        ->leftJoin('categories','products.category_id','categories.id')
                        ->where('products.id',$id)->first();
        //dd($data->toArray());
        return view('admin.Products.seeMore',compact('data'));

    }

    private function requestData($request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'description' => $request->description,
            'waiting_time' => $request->waitingTime,
        ];
    }
    private function validationProductCheck($request , $action)
    {
        $ValidationRule= [
            'name' => 'required|unique:products,name,'.$request->pizzaId,
            'price' => 'required',
            //'image'=>'required|mimes:png,jpg|file',
            'description' => 'required',
            'category' =>'required',
            'waitingTime' => 'required',
        ];
        $ValidationRule['image']=$action == "create" ? "required|mimes:png,jpeg,webp,jpg|file" : "mimes:png,jpeg,webp,jpg|file";
        Validator::make($request->all(),$ValidationRule)->validate();
    }
}
