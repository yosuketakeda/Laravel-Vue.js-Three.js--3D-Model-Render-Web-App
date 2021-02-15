<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use Mail;

class OrderHistoryController extends Controller
{
    //
    public function index(Request $request)
    {
        $permission = Auth::user()->permission;
        $company = Auth::user()->companyName;
        $users = DB::table('users')->where('permission', '<', 30)->where('permission', '>', 21)->where('companyName', '=', $company)->get();
        $orders = DB::table('contacts')->where('company', '=', $company)->get();

        return view('order_history')->with('users', $users)->with('orders', $orders)->with('permission', $permission);
    }
    public function viewOrderStatus(Request $request)
    {
        $id = $request->id;
        $order = DB::select('select * from contacts where id = ?', [$id]);
        
        $dateTemp = $order[0]->created_at;
        $dates = explode(" ", $dateTemp);
        $date = $dates[0];
        
        $orderNum = $order[0]->orderNumber;
        
        $productsOri = $order[0]->orders;
        $productsTemp = explode("|", $productsOri);
        array_pop($productsTemp);
        
        $products = [];
        foreach($productsTemp as $pd){
            $buf = explode(":", $pd);
            array_push($products, $buf[0]);
        }
        
        $name = $order[0]->name;
        
        $statusNum = $order[0]->orderStatus;
        switch ($statusNum) {
            case 0:
                $status="New Order";
                break;
            case 1:
                $status = "Processing";
                break;
            case 2:
                $status = "Manufacturing";
                break;
            case 3:
                $status = "In Transit";
                break;
            case 4:
                $status = "Delivered";
                break;
        }
        
        return view('viewOrderStatus')->with('date', $date)->with('orderNum', $orderNum)->with("name", $name)->with("status", $status)->with("products", $products)->with("statusNum", $statusNum)->with("orderID", $id);
    }
    public function emailContact(Request $request)
    {
        $orderID = DB::select('select id from contacts where orderNumber = ?', [$request->orderNumber]);
        $id = $orderID[0]->id;
        
        return view('emailContact')->with('orderNumber', $request->orderNumber)->with('orderID', $id);
    }
    public function emailSend(Request $request)
    {
        $subject = 'The new email has arrived from the client "'.$request->name.'"';
                
        $details = [
            'from_email' => $request->email,
            'to_email' => 'beth.Parsons@marketreadyinc.com',
            'name' => $request->name,
            'phone' => $request->phone,
            'company' => $request->company,
            'orderNumber' => $request->orderNumber,
            'note' => $request->note,
            'subject' => $subject,
        ];
        Mail::send('emails.contactmail', $details, function($message) use ($details) {
            $message->to($details['to_email'])->subject($details['subject']);
            $message->from("Brandon@gmail.com","Visualization Tool Development Team");
        });

        $details = [
            'from_email' => $request->email,
            'to_email' => 'morgan.Nathan@marketreadyinc.com',
            'name' => $request->name,
            'phone' => $request->phone,
            'company' => $request->company,
            'orderNumber' => $request->orderNumber,
            'note' => $request->note,
            'subject' => $subject,
        ];
        Mail::send('emails.contactmail', $details, function($message) use ($details) {
            $message->to($details['to_email'])->subject($details['subject']);
            $message->from("Brandon@gmail.com","Visualization Tool Development Team");
        });

        $details = [
            'from_email' => $request->email,
            'to_email' => 'Lauren.Hoffstadt@marketreadyinc.com',
            'name' => $request->name,
            'phone' => $request->phone,
            'company' => $request->company,
            'orderNumber' => $request->orderNumber,
            'note' => $request->note,
            'subject' => $subject,
        ];
        Mail::send('emails.contactmail', $details, function($message) use ($details) {
            $message->to($details['to_email'])->subject($details['subject']);
            $message->from("Brandon@gmail.com","Visualization Tool Development Team");
        });

        return redirect()->route('orderHistory');
    }
    public function orderAgain(Request $request)
    {
        $order =  DB::select('select * from contacts where id = ?', [$request->orderID]); 
        $order_content = $order[0]->orders;
        return redirect()->route('contact_form', ['q' => $order_content, 'reflag' => 1, 'orderID' => $request->orderID]);
    }
}
