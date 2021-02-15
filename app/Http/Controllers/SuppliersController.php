<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

///// DB search with condition //////
///// $search = "Dingman F2X2 Quality Sprayer";
///// $orders = DB::table('contacts')->where('orders', 'LIKE', '%'.$search.'%')->get();


class SuppliersController extends Controller
{
    // dashboard View
    public function index(Request $request)
    {
        return view('suppliers.login');
    }
    // admin login
    public function adminIndex(Request $request)
    {
        return view('suppliers.adminLogin');
    }

    public function register(Request $request){
        return view('suppliers.register');
    }
    public function adminRegister(Request $request){
        return view('suppliers.adminRegister');
    }

    public function adminCheck(Request $request)  //// 
    {
        //$status = 0;
        $user = DB::select('select * from users where email = ?', [$request->email]);  /// origin method
        if(empty($user)){
            return response()->json(['check'=>-1, 'val'=>$user]);
        }else{
            if($user[0]->permission == 31){
                if($user[0]->status == 0){
                    return response()->json(['check'=>0, 'val'=>$user[0]->status]);  // locked user
                }else{                
                    return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
                }  
            }else if($user[0]->permission > 31){
                return response()->json(['check'=>2, 'val'=>$user[0]->permission]);  // not admin
            }else{
                return response()->json(['check'=>-2, 'val'=>$user[0]->permission]);  // not suppliers
            }
        }        
    }

    public function adminIs(Request $request)
    {
        $admin = DB::select('select * from users where permission = 31');  /// admin
        if(empty($admin)){
            return response()->json(['check'=>true]);
        }else{
            return response()->json(['check'=>false]);
        }
    }

    public function suppliersCheck(Request $request)
    {
        //$status = 0;
        $user = DB::select('select * from users where email = ?', [$request->emailTxt]);  /// origin method
        if(empty($user)){
            return response()->json(['check'=>-1, 'val'=>$user]);  // empty user
        }else{
            if($user[0]->permission > 31){
                if($user[0]->status == 0){
                    return response()->json(['check'=>0, 'val'=>$user[0]->status]);  // locked user
                }else{                
                    return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
                }
            }else if($user[0]->permission == 31){
                return response()->json(['check'=>2, 'val'=>$user[0]->status]);  // admin
            }else{
                return response()->json(['check'=>-2, 'val'=>$user[0]->permission]);  // not suppliers
            }
        }        
    }

    public function suppliersDashboard(Request $request)
    {
        $user=auth()->user();
        
        $company_id = DB::table('suppliers')->where('company_name', '=', $user->companyName)->get('id');
        $supplier_id = $company_id[0]->id;
                
        // get products that includes supplier_id in product management table
        $products_total = DB::table('product_management')->get();
        
        $products = [];
        foreach($products_total as $pd){
            $buf = explode(",", $pd->supplier_id);
            if(in_array($supplier_id, $buf)){
                array_push($products, $pd);
            }
        }
        
        $orderNums = DB::select('select contact_ordernumber from supplier_order where supplier_id = ?', [$supplier_id]);
        $orders = [];
        $quantities = [];
        
        if(!empty($orderNums)){
            foreach($orderNums as $orderNum){
                $order = DB::select('select * from contacts where orderNumber = ?',[$orderNum->contact_ordernumber]);                
                $quantity = DB::table('supplier_order')->where('supplier_id', '=', $supplier_id)->where('contact_ordernumber', '=', $orderNum->contact_ordernumber)->get('quantity');
                array_push($orders, $order);
                $quantities[$orderNum->contact_ordernumber] = $quantity[0]->quantity; // add element with key to array
            }
        }
        
        $users = DB::table('users')->where('permission', '>', 31)->where('companyName', '=', $user->companyName)->get();

        return view('suppliers.dashboard')->with('loggedInPermission', $user->permission)->with('products', $products)->with('orders', $orders)->with('users', $users)->with('quantities', $quantities);
    }

    public function getProductDetails(Request $request)
    {
        $products = DB::select('select * from product_management where vrml_name = ?', [$request->vrml]); 
        $pd_code = $products[0]->product_code;
        $pd_name = $products[0]->product_name;
        $pd_quantity = $products[0]->quantity;
        $pd_description = $products[0]->description;

        return response()->json(['pd_code'=>$pd_code, 'pd_name'=>$pd_name, 'pd_quantity'=>$pd_quantity, 'vrml'=>$request->vrml, 'pd_description'=>$pd_description]);
    }
}
