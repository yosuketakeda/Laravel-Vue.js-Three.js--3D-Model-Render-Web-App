<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Mail;
use PDF;
use Session;
use Auth;

class ThanksController extends Controller
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
     * print pdf
     */
    public function printPDF(Request $request)
    {
        $order = $request->order;
        $pdf = $this->createPDF($order);
        return  $pdf->download('Order-'.$order['order_number'].'.pdf');        
    }

    /**
     * send email
     */
    public function sendEmail($name, $email, $orderNumber, $pdf) 
    {        
        $subject = "Success of your order in Visualization Tool Website.";
                
        $details = [
            'to_name' => $name,
            'to_email' => $email,
            'subject' => $subject,
            'orderNum' => $orderNumber
        ];
        //if(Session::has('pdf_check')){            
            Mail::send('emails.sendmail', $details, function($message) use ($details, $pdf) {
                $message->to($details['to_email'], $details['to_name'])
                ->subject($details['subject'])
                ->attachData($pdf->output(), "Order-".$details['orderNum'].".pdf");
                $message->from("Brandon@gmail.com","Visualization Tool Development Team");
            });
        /*    
        }else{
            Mail::send('emails.sendmail', $details, function($message) use($details){
                $message->to($details['to_email'], $details['to_name'])
                ->subject($details['subject']);
                $message->from("Brandon@gmail.com","Visualization Tool Development Team");
            });
        } */       
    }

    public function createPDF($order)
    {
        $cartData = [];
        $products = explode("|", $order['order_content']);
        array_pop($products);
        foreach($products as $pd){
            $buf = explode(":", $pd);
            array_pop($buf);
            array_push($cartData, $buf);
        }

        $quantities = explode("|", $order['order_quantities']);        
        array_pop($quantities);
       
        $date = date_create($order['delivery_date']);
        $deliveryDate = date_format($date, "F j, Y");
        
        $data = [
            'title' => $order['order_number'],
            'heading' => 'Order Summary Information',
            'products' => $cartData,
            'quantities' => $quantities,
            'deliveryDate' => $deliveryDate,
            'date' => date("F j, Y"),
            'reflag' => $order['reflag'],
            'preOrderNum' => $order['preOrderNum'],
        ];
        
        $pdf = PDF::loadView('pdf.pdf_view', $data);  
        return $pdf;
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {    
        /*    
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            //'email' => 'required|unique:contacts',
            'company' => 'required',
            'phone' => 'required',
            'note' => 'nullable',
        ]);
        */
        $name = $request->input('name');
        $email = $request->input('email');
        $quantities = $request->input('quantities');
        $orderNumber = $request->input('orderNumber');
        $deliveryDate = $request->input('deliveryDate');
        
        if(Session::get('pdf_check')) {
            Session::forget('pdf_check');
        }
        if($request->input('pdf_check')) {
            Session::put('pdf_check', "on");
        }

        $order_details = [
            'order_number' => $orderNumber,
            'order_content' => $request->input('cartStr'),
            'order_quantities' => $quantities,
            'delivery_date' => $deliveryDate,
            'reflag' => $request->input('reflag'),
            'preOrderNum' => $request->input('preOrderNum'),
        ];

        $pdf = $this->createPDF($order_details);

        // send email to contact client            
        $this->sendEmail($name, $email, $orderNumber, $pdf);

        $contact = new Contact;
        $contact->userID = Auth::user()->id;
        $contact->name = $name;
        $contact->email = $email;
        $contact->company = $request->input('company');
        $contact->phone = $request->input('phone');
        $contact->note = $request->input('note');
        $contact->orders = $request->input('cartStr');
        $contact->quantities = $quantities;
        $contact->orderNumber = $orderNumber;
        $contact->deliveryDate = $deliveryDate;
        $contact->save();

        return view('thanks')->with('order', $order_details);

    }
}
