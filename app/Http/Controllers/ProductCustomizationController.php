<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Auth;
use Image;

class ProductCustomizationController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
        $directory = public_path("VRML/");
        $products = glob($directory . '*');
        /*
        $directory = "public/products";
        $products = Storage::files($directory);
        */
        $products_name = array();
        foreach($products as $product){
            array_push($products_name, basename($product));
        }        
        $pd_names = str_replace(".wrl", "", $products_name);
       
        $pd_names  =  json_encode ($pd_names);
        
        return view('product_customization')->with("products", $pd_names);
    }
    public function uploadProductImg(Request $request){
        //$id = Auth::user()->id;
        $imgName = $request->imgName;
        $imgData = $request->imgData;
        $orderNumber = $request->orderNumber;

        $directory_path = public_path('images/cart/'.$orderNumber.'/');
        $mode = 0777;
        @mkdir( $directory_path, $mode, false);
        $path = public_path('images/cart/'.$orderNumber.'/'.$imgName.'.jpg');

        $img = Image::make($imgData);
        $img->stream(); // <-- Key point
        $img->save($path);
        /*
        Storage::disk('local')->makeDirectory('public/Temp/cart/'.$orderNumber.'/');
        Storage::put('public/Temp/cart/'.$orderNumber.'/'.$imgName.'.jpg', $img);
        */
                        
        return response()->json(['imgName'=>$imgName ]);
    }
}
