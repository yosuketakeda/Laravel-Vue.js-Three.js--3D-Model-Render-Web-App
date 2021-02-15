<?php

namespace App\Http\Controllers;
use App\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactFormController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = $request->get('q');
        $objs = explode("|", $query);

        $reflag = $request->get('reflag');
        $orderNumber = end($objs);
        $re_orderNumber = "";

        if(empty($reflag)){  // new order
            
        }else{  // re-order
            $re_orderNumber = date("YmdHis");            
        }
        
        $cartData = [];
        foreach($objs as $obj){
            $buf = explode(":", $obj);
            array_pop($buf);
            array_push($cartData, $buf);
        }
        array_pop($cartData);

        $orderID = $request->orderID;
        //$storagePath =  Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
                              
        return view('contact_form')->with('cartData', $cartData)->with('cartStr', $query)->with('orderNumber', $orderNumber)->with('reOrderNumber', $re_orderNumber)->with('reflag', $reflag)->with('orderID', $orderID);//->with('storagePath', $storagePath);
    }
}
