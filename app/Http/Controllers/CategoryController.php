<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function list(){
        $categories =Category::when(request('searchData'),function($query){
                    $query->where('category_name','like','%'.request('searchData').'%');
                            })
                             ->orderBy('id','desc')->paginate(5);
        //dd($getData->toArray());
        $categories->appends(request()->all());
        return view('admin.category',compact('categories'));
    }
    //addPage
    public function add(){
        return view('admin.addCategory');
    }
    //create Category
    public function create(Request $request){
       // dd($request->toArray());
       $this->categoryValidationCheck($request);
       $data=$this->requestData($request);

       //dd($data);
       Category::create($data);
       return redirect()->route('admin#list')->with(['category'=>'Category Crated']);
    }
//delete
public function delete($id){
    //dd($id);
    Category::where('id',$id)->delete();
    return back()->with(['delete'=>'Category Deleted']);
}
//edit
public function edit($id){
    //dd($id);
    $categories=Category::where('id',$id)->first();
   // dd($categories);
    return view('admin.edit',compact('categories'));
}
//Update
public function update(Request $request){

    $this->categoryValidationCheck($request);
    $data=$this->requestData($request);

    $update=Category::where('id',$request->categoryId)->update($data);
    return redirect()->route('admin#list')->with(['update'=>'Category Updated']);

}

    private function categoryValidationCheck($request){
        Validator::make($request->all(),[
            'categoryName'=>'required||unique:categories,category_name,'.$request->categoryId
        ])->validate();
    }

    private function requestData($request){
        return[
            'category_name'=> $request->categoryName,
        ];
    }


}
