<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Storage;

class userAuthController extends Controller
{
   //PasswordPage
   public function passwordPage(){
    return view('User.acccount.password');
   }
   //changePassword
   public function changePassword(Request $request ){
    $this->passwordValidationCheck($request);
    $id=Auth::user()->id;
    $user=User::where('id',$id)->first();
    $dbPassword=$user->password;
    //dd($dbPassword);
        if (Hash::check($request->oldPassword, $dbPassword)) {
            # code...
            $data=[
                'password'=>Hash::make($request->newPassword)
            ];
         User::where('id',$id)->update($data);
         Auth::logout();
         return redirect()->route('auth#loginPage');
        }
        else{
            return redirect()->route('info#passwordPage')->with(['fail'=>'YOur Password is Wrong!Please Train Again LAter']);
         }

   }
    //Account Info
    public function info(){
        return view('User.acccount.info');
    }
    //Edit Page
    public function editPage(){
        return view('User.acccount.editPage');
    }
    public function update(Request $request){
        $this->accountInfoValidationCheck($request);
        $id=Auth::user()->id;
        $data=$this->requestData($request);
        if($request->hasFile('image')){
            $dbImage=User::where('id',$id)->first();
            $dbImage=$dbImage->image;
            if($dbImage!=null){
                Storage::delete('public/'.$dbImage);
            }
            $fileName=uniqid().$request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public',$fileName);
        $data['image']=$fileName;
        }
        User::where('id',$id)->update($data);
        return redirect()->route('user#info');


    }


    private function passwordValidationCheck($request){
        Validator::make($request->all(),[
            'oldPassword'=>'required|min:8',
            'newPassword'=>'required|min:8',
            'confirmPassword'=>'required|min:8|same:newPassword',

        ])->validate();
    }

    private function requestData($request){
        return[
            'name'=> $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address'=>$request->address,
            'gender'=> $request->gender,

        ];
    }

    private function accountInfoValidationCheck($request){
        Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'image'=>'mimes:png,jpg,jpeg,wepp|file',
            'gender'=>'required',
            'address'=>'required',
        ])->validate();
    }

}
