<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class adminController extends Controller
{
    //password Page
    public function changePassword(){
        return view('admin.password.passwordPage');
    }
    //updatePassword
    public function updatePassword(Request $request){

        $this->passwordValidationCheck($request);
       // dd($request->all());
       $id=Auth::user()->id;
       $getPassword=User::select('password')
                        ->where('id',$id)->first();
       $dbPassword=$getPassword->password;
       //dd($dbPassword);
       if(Hash::check($request->oldPassword, $dbPassword)){
        //dd('true');
        $data=[
            'password'=>Hash::make($request->newPassword)
        ];

        User::where('id',$id)->update($data);
        Auth::logout();
        return redirect()->route('auth#loginPage');

        }
        else{
            return redirect()->route('profile#change')->with(['fail'=>'YOur Password is Wrong!Please Train Again LAter']);
         }




}
//Info Page
public function infoPage(){
    return view('admin.info.info');
}
//editInfo
public function editInfo(){
    return view('admin.info.changeInfo');
}
public function updateInfo(Request $request){

    $this->accountInfoValidationCheck($request);
   $data= $this->requestData($request);
   $dbImage = User::where('id',Auth::user()->id)->first();
   $dbImage=$dbImage->image;
    if($dbImage != null){
        storage::delete('public/'.$dbImage);
        }
        $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image']=$fileName;
User::where('id',Auth::user()->id)->update($data);
    return redirect()->route('info#infoPage');
}

//Admin Role
public function adminRole(){
    $data=User::when(request('searchData'),function($query){
        $query->orWhere('name','like','%'.request('searchData').'%')
                ->orWhere('phone','like','%'.request('searchData').'%')
                ->orWhere('email','like','%'.request('searchData').'%')
                ->orWhere('address','like','%'.request('searchData').'%');
                    })
                ->where('role','admin')->paginate(3);
                $data->appends(request()->all());
    //dd($data->toArray());
    return view('admin.info.role',compact('data'));
}
//delete
public function delete($id){
   // dd($id);
   User::where('id',$id)->delete();
    return back()->with(['delete'=>'Account Deleted']);
}
//changeRole
public function change(){
    $id=Auth::user()->id;
   $data= User::where('id',$id)->first();

    return view('admin.info.roleChange',compact('data'));
}
public function changeRole(Request $request){
   // dd($id);
   $id=Auth::user()->id;
    $data=[
        'role'=>$request->role,
    ];
    User::where('id',$id)->update($data);
    Auth::logout();
   return redirect()->route('auth#loginPage');
}
//AccountInfo Validation
private function accountInfoValidationCheck($request){
    Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'phone'=>'required',
        //'image'=>'required |mimes:png,jpg,jpeg,wepp|file',
        'gender'=>'required',
        'address'=>'required',
    ])->validate();
}

      //validation
      private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required||min:6',
            'newPassword'=>'required||min:6',
            'confirmPassword'=>'required||min:6 ||same:newPassword'
        ])->validate();
    }

    //AccountInfo
    private function requestData($request){
        return[
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address'=>$request->address,
            'gender'=> $request->gender,

        ];
    }
}

