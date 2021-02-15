<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class CustomersController extends Controller
{
    public function adminIndex(Request $request)
    {
        return view('admin.login');
    }
    public function adminRegister(Request $request){
        return view('admin.register');
    }

    public function resetPassword(Request $request){
        return view('auth.passwords.reset');
    }  

    public function userCheck(Request $request)
    {
        $user = DB::select('select * from users where email = ?', [$request->email]);  /// origin method
        if(empty($user)){
            return response()->json(['check'=>-1, 'val'=>$user]);
        }else{
            if(($user[0]->permission < 30) && ($user[0]->permission > 21)){
                if($user[0]->status == 0){
                    return response()->json(['check'=>0, 'val'=>$user[0]->status]);  // locked user
                }else{                
                    return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
                }
            }else if($user[0]->permission == 21){
                return response()->json(['check'=>2, 'val'=>$user[0]->status]);  // admin
            }else{
                return response()->json(['check'=>-2, 'val'=>$user[0]->permission]);  // not master -- Rapid Closure member
            }
        }      
    }

    public function adminCheck(Request $request)  //// Rapid Closure Login Check
    {
        $user = DB::select('select * from users where email = ?', [$request->email]);  /// origin method
        if(empty($user)){
            return response()->json(['check'=>-1, 'val'=>$user]);
        }else{
            if($user[0]->permission == 21){
                if($user[0]->status == 0){
                    return response()->json(['check'=>0, 'val'=>$user[0]->status]);  // locked user
                }else{                
                    return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
                }                
            }else if(($user[0]->permission < 30) && ($user[0]->permission > 21)){
                return response()->json(['check'=>2, 'val'=>$user[0]->permission]);  // not admin
            }else{
                return response()->json(['check'=>-2, 'val'=>$user[0]->permission]);  // not master -- Rapid
            }
        }  
    }

    public function adminIs(Request $request)
    {
        $admin = DB::select('select * from users where permission = 1');  /// admin
        if(empty($admin)){
            return response()->json(['check'=>true]);
        }else{
            return response()->json(['check'=>false]);
        }
    }
}
