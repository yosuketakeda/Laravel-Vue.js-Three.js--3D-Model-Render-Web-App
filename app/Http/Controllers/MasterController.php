<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class MasterController extends Controller
{
    public function index(Request $request)
    {
        return view('master.login');
    }
    public function adminIndex(Request $request)
    {
        return view('master.adminLogin');
    }
    public function register(Request $request){
        return view('master.register');
    }
    public function adminRegister(Request $request){
        return view('master.adminRegister');
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
            if(($user[0]->permission != 11) && ($user[0]->permission < 20)){
                if($user[0]->status == 0){
                    return response()->json(['check'=>0, 'val'=>$user[0]->status]);  // locked user
                }else{                
                    return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
                }
            }else if($user[0]->permission == 11){
                return response()->json(['check'=>2, 'val'=>$user[0]->status]);  // admin
            }else{
                return response()->json(['check'=>-2, 'val'=>$user[0]->permission]);  // not master -- Rapid Closure member
            }
        }      
    }

    public function updateUser(Request $request){
        DB::table('users')
            ->where('id',$request->id)
            ->update([
                'name' => $request->name,
                'address1' => $request->address1,
                'address2' => $request->address2,
                'city' => $request->city,
                'region' => $request->region,
                'zipcode' => $request->zipcode,
                'country' => $request->country
            ]);

        return response()->json(['result'=>"success"]);
    }
    // redirect after registering
    public function checkUser(Request $request){
        $user = auth()->user();
        $company_name = $user->companyName;
        $email = $user->email;
        $phone = $user->phone;

        if($user->permission < 20){ // master -- Rapid Closure
            return redirect()->route('masterDashboard');     
        }else if($user->permission > 30){ // suppliers
            $companies = DB::table('suppliers')->where('company_name', '=', $company_name)->get('company_name');
            if(empty($companies[0])){  // new supplier company
                DB::table('suppliers')
                    ->insert([
                        'company_name' => $company_name,
                        'status' => 1,
                        'email' => $email,
                        'phone' => $phone,                        
                    ]);
            }        

            return redirect()->route('suppliersDashboard');
        }else { // customer            
            $companies = DB::table('company')->where('name', '=', $company_name)->get('name');
            if(empty($companies[0])){ // new customer company
                DB::table('company')
                    ->insert([
                        'name' => $company_name,
                        'status' => 1,
                        'email' => $email,
                        'phone' => $phone,
                    ]);
            }            

            return redirect()->route('orderHistory');
        }
    }

    public function adminCheck(Request $request)  //// Rapid Closure Login Check
    {
        $user = DB::select('select * from users where email = ?', [$request->email]);  /// origin method
        if(empty($user)){
            return response()->json(['check'=>-1, 'val'=>$user]);
        }else{
            if($user[0]->permission == 11){
                return response()->json(['check'=>1, 'val'=>$user[0]->status]);  // OK
            }else if($user[0]->permission < 20){
                return response()->json(['check'=>0, 'val'=>$user[0]->permission]);  // not admin
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
    
    public function adminDashboard(Request $request)
    {   
        $user=auth()->user();
        
        $users = DB::select('select * from users where permission != 11');  /// Editor, Viewer accounts
        $orders = DB::select('select * from contacts'); 
       
        $products = DB::select('select * from product_management');

        $companies = DB::select('select * from company'); 
        $suppliers_company = DB::select('select * from suppliers'); 
        
        return view('master.dashboard')->with('users', $users)->with('orders', $orders)->with('loggedInPermission', $user->permission)->with('products', $products)->with('companies', $companies)->with('suppliers_company', $suppliers_company);
    }

    public function freezeSupplier(Request $request)
    {
        $id = $request->id;
        // set supplier's status to 0
        DB::table('suppliers')
            ->where('id',$id)
            ->update([
                'status' => 0
            ]);
        // set all users' status of freezed supplier company to 0
        $company = DB::table('suppliers')->where('id', $id)->get('company_name');
        DB::table('users')->where('companyName', '=', $company[0]->company_name)->update(['status'=>0]);
        
        return response()->json(['id'=>$id]);
    }

    public function delSupplier(Request $request)
    {
        $id = $request->id;
        $company = DB::table('suppliers')->where('id', $id)->get('company_name');

        //DB::table('suppliers')->where('id',$id)->update(['status' => -1]);
        DB::table('suppliers')->where('id',$id)->delete();
        // delete all users of deleted supplier company
        DB::table('users')->where('companyName', '=', $company[0]->company_name)->delete();
        //DB::table('users')->where('companyName', '=', $company[0]->company_name)->update(['status'=>-3]);
        
        return response()->json(['result'=>"OK"]);
    }

    public function freezeCustomer(Request $request)
    {
        $id = $request->id;
        // set supplier's status to 0
        DB::table('company')
            ->where('id',$id)
            ->update([
                'status' => 0
            ]);
        // set all users' status of freezed supplier company to 0
        $company = DB::table('company')->where('id', $id)->get('name');
        DB::table('users')->where('companyName', '=', $company[0]->name)->update(['status'=>0]);
        
        return response()->json(['id'=>$id]);
    }

    public function delCustomer(Request $request)
    {
        $id = $request->id;
        $company = DB::table('company')->where('id', $id)->get('name');

        //DB::table('company')->where('id',$id)->update(['status' => -1]);
        DB::table('company')->where('id',$id)->delete();
        // set all users of deleted customer company        
        DB::table('users')->where('companyName', '=', $company[0]->name)->delete();
        //DB::table('users')->where('companyName', '=', $company[0]->name)->update(['status'=>-3]);
        
        return response()->json(['result'=>"OK"]);
    }

    public function assignCustomerClick(Request $request)
    {
        $products_temp = DB::table('product_management')->get();
        $products = [];
        foreach($products_temp as $product){        
            $products[$product->id] = $product->product_name;
        }
        
        return response()->json(['products'=>$products]);
    }

    public function assignCustomerProducts(Request $request)
    {        
        DB::table('company')->where('id', $request->id)->update(['products'=>$request->products]);
        return response()->json(['result'=>"OK"]);
    }

    public function assignSupplierProducts(Request $request)
    {        
        // add products into suppliers table
        DB::table('suppliers')->where('id', $request->id)->update(['products'=>$request->products]);
        // add supplier id into product manaegment table
        $olds = "";
        foreach($request->products as $pd){            
            $old_ids = DB::table('product_management')->where('product_name', '=', $pd)->get('supplier_id');            
            $olds = $old_ids[0]->supplier_id;
            $vals = explode(',', $olds);            
            $flag = true;
            if(!empty($vals)){
                foreach($vals as $val){
                    if($val == $request->id){
                        $flag = false;
                        break;
                    }
                }
            }
            if($flag){
                $updated_ids = $olds.$request->id.',';
                DB::table('product_management')->where('product_name', '=', $pd)->update(['supplier_id'=>$updated_ids]);
            }
        }
        return response()->json(['result'=>$olds]);
    }

    public function changeUserPermission(Request $request)
    {
        $id = $request->id;
        $permission = $request->permission;
        $user = DB::select('select name from users where id = ?', [$id]);  /// origin method 
        DB::table('users')
            ->where('id',$id)
            ->update([
                'permission' => $permission
            ]);
        return response()->json(['name'=>$user[0]->name]);
    }
   
    public function orderToSuppliers(Request $request)
    {
        /////////// request->date
        // orderNum=2020928173337&piece-quantity%5B%5D=200&piece-quantity%5B%5D=300&piece-supplier-input%5B%5D=Dingman&piece-supplier-input%5B%5D=SZ%20Beauty

        $datas = explode("&", $request->data);
        $orderNum = (explode("=", $datas[0]))[1];
        array_shift($datas);  /// remove first element

        $quantities = [];
        $supplier_ids = [];

        foreach($datas as $data){
            $buf=explode("=", $data);
            if($buf[1] != ""){
                if( strpos($buf[0], "quantity") > 0){
                    array_push($quantities, $buf[1]);
                }else{
                    $name = str_replace("%20", " ", $buf[1]);
                    $id = DB::select('select id from suppliers where company_name = ?', [$name]);
                    array_push($supplier_ids, $id[0]->id);
                }
            }            
        }
        
        $i = 0;
        foreach($quantities as $quantity){  
            $old = DB::table('supplier_order')->where('supplier_id', '=', $supplier_ids[$i])->where('contact_ordernumber', '=', $orderNum)->first();
            if($old === null){
                DB::table('supplier_order')
                ->insert([
                    'supplier_id' => $supplier_ids[$i],
                    'contact_ordernumber' => $orderNum,
                    'quantity' => $quantity,
                ]);
            }else{
                DB::table('supplier_order')->where('supplier_id', '=', $supplier_ids[$i])->where('contact_ordernumber', '=', $orderNum)
                    ->update(['quantity'=>$quantity]);
            }
            
            $i++;
        }
        
        return response()->json([ 'result'=>$datas ]);
    }

    public function delOrder(Request $request)
    {
        $id = $request->id;
        DB::table('contacts')->where('id', $id)->delete();
        //DB::table('contacts')->where('id', $id)->update(['orderStatus'=>-1]);
        return response()->json(["result"=>$id]);
    }

    public function changeOrderStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status;
        
        DB::table('contacts')
            ->where('id',$id)
            ->update([
                'orderStatus' => $status
            ]);
        return response()->json(['id'=>$id, 'status'=>$status ]);
    }

    public function getAdminProductDetails(Request $request)
    {
        $product = DB::select('select * from product_management where id = ?', [$request->id]);
        $product_name = $product[0]->product_name;
        $product_code = $product[0]->product_code;
        $product_quantity = $product[0]->quantity;
        $product_description = $product[0]->description;
        $product_vrml = $product[0]->vrml_name;

        return response()->json(['pd_code'=>$product_code, 'pd_name'=>$product_name, 'pd_quantity'=>$product_quantity, 'pd_description'=>$product_description, 'pd_vrml'=>$product_vrml]);
    }

    public function uploadProduct(Request $request)
    {
        // File name
        $file_name = $_FILES['file']['name'];
        $uploaded_path = public_path('VRML/').$file_name;

        $flag = true;
        $dir = public_path('VRML/');
        $files = scandir($dir);
        foreach($files as $file){
            if($file == $file_name){
                $flag = false;
                break;
            }            
        }
        if($flag){
            move_uploaded_file($_FILES['file']['tmp_name'], $uploaded_path);
        }
        
        return response()->json(['file'=>$file_name, 'flag'=>$flag]);
    }

    public function uploadThumbnail(Request $request)
    {
        // File name
        $file_name = $_FILES['thumbnail']['name'];
        $uploaded_path = public_path('images/products/').$file_name;

        $flag = true;
        $dir = public_path('images/products/');
        $files = scandir($dir);
        
        foreach($files as $file){
            if($file == $file_name){
                $flag = false;
                break;
            }
        }
        if($flag){
            move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploaded_path);
        }        
        return response()->json(['file'=>$file_name, 'flag'=>$flag]);
    }

    public function changeThumbnail(Request $request)
    {
        // File name
        $file_name = $_FILES['thumbnail']['name'];
        $uploaded_path = public_path('images/products/').$file_name;

        $flag = true;
        $dir = public_path('images/products/');
        
        move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploaded_path);
        
        return response()->json(['file'=>$file_name]);
    }


    public function updateProduct(Request $request)
    {
        DB::table('product_management')->where('id', $request->id)
            ->update([
                'product_code'=>$request->pdCode, 
                'product_name'=>$request->pdName,
                'quantity'=>$request->quantity,
                'description'=>$request->description,
            ]);
        return response()->json(['result'=>"here"]);
    }

    public function saveProduct(Request $request)
    {
        $suppliers = $request->suppliers;
        $supplier_ids = "";
        if(!empty($suppliers)){
            foreach($suppliers as $supplier){
                $buf = DB::table('suppliers')->where('company_name', '=', $supplier)->get('id');
                $supplier_ids .= $buf[0]->id.",";
            }
        }        
        DB::table('product_management')->insert([
            'supplier_id'=>$supplier_ids,
            'product_code'=>$request->productCode,
            'product_name'=>$request->productName,
            'thumbnail_name'=>$request->thumbname,
            'vrml_name'=>$request->filename,
            'quantity'=>$request->quantity,
            'description'=>$request->notes,
        ]);
        return response()->json(['supplier'=>$supplier_ids]);
    }

    public function editMasterOrder(Request $request)
    {
        $contact = DB::select('select * from contacts where id = ?', [$request->id]);
        $userID = $contact[0]->userID;
        $customer = DB::select('select * from users where id = ?', [$userID]);
        $address = $customer[0]->address1." ".$customer[0]->address2;
        $orders = $contact[0]->orders;
        $order_content = explode("|", $orders);
        $order=$order_content[0];
        $order_array = explode(":", $order);
        $pd_name = $order_array[0];
        unset($order_array[0]);
        array_pop($order_array);
        
        $quantities = $contact[0]->quantities;
        $quantity_array = explode("|", $quantities);
        $quantity = $quantity_array[0];

        $orderNum = $contact[0]->orderNumber;
        $old_values = DB::table('supplier_order')->where('contact_ordernumber', $orderNum)->get();
        $old_supplierID = [];
        $old_quantity=[];
        if(!empty($old_values)){
            foreach($old_values as $old){                                
                array_push($old_supplierID, DB::table('suppliers')->where('id', $old->supplier_id)->get('company_name')[0]->company_name );
                array_push($old_quantity, $old->quantity);
            }
        }

        $companiesDB = DB::select('select * from suppliers');
        $companies = array();
        foreach($companiesDB as $com){
            array_push($companies, $com->company_name);
        }

        return response()->json(['company'=>$customer[0]->companyName, 'address'=>$address, 'email'=>$contact[0]->email, 'phone'=>$contact[0]->phone, 'pd_name'=>$pd_name, 'order'=>$order_array, 'quantity'=>$quantity, 'companies'=>$companies, 'orderNum'=>$orderNum, 'old_supplierID'=>$old_supplierID, 'old_quantity'=>$old_quantity]);
    }

    public function getSuppliers(Request $request)
    {
        $companiesDB = DB::select('select * from company');
        $companies = array();
        foreach($companiesDB as $com){
            array_push($companies, $com->name);
        }
        return response()->json(['companies', $companies]);
    }

    public function supplierEdit(Request $request)
    {
        //$supplierID = $request->id;
        $products_temp = DB::table('product_management')->get();
        $products = [];
        foreach($products_temp as $product){        
            $products[$product->id] = $product->product_name;
        }
        
        return response()->json(['products'=>$products]);
    }

    public function saveCustomerData(Request $request)
    {
        if($request->flag == 1){
            DB::table('company')->where('id',$request->id)
            ->update([
                'name' => $request->value,
            ]);
        }else if($request->flag == 2){
            DB::table('company')->where('id',$request->id)
            ->update([
                'address' => $request->value,
            ]);
        }else if($request->flag == 3){
            DB::table('company')->where('id',$request->id)
            ->update([
                'email' => $request->value,
            ]);
        }else{
            DB::table('company')->where('id',$request->id)
            ->update([
                'phone' => $request->value,
            ]);
        }
        return response()->json(['flag'=>$request->flag, 'value'=>$request->value]);
    }

    public function saveCompanyData(Request $request)
    {
        if($request->flag == 1){
            DB::table('suppliers')->where('id',$request->id)
            ->update([
                'company_name' => $request->value,
            ]);
        }else if($request->flag == 2){
            DB::table('suppliers')->where('id',$request->id)
            ->update([
                'address' => $request->value,
            ]);
        }else if($request->flag == 3){
            DB::table('suppliers')->where('id',$request->id)
            ->update([
                'email' => $request->value,
            ]);
        }else{
            DB::table('suppliers')->where('id',$request->id)
            ->update([
                'phone' => $request->value,
            ]);
        }
        return response()->json(['flag'=>$request->flag, 'value'=>$request->value]);
    }

    // unUsed
    public function deleteProduct(Request $request)
    {
        $productName = $request->product;
        $vrml = public_path('VRML/').$productName;
        if(file_exists($vrml)){
            unlink($vrml);
        }        
        $imgName = str_replace(".wrl", "", $productName);
        $img = public_path('images/products/').$imgName.".png";
        if(file_exists($img)){
            unlink($img);
        }
        
        return response()->json(['result'=>"OK"]);
    }
}
