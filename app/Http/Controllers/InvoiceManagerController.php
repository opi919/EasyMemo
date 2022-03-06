<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use GuzzleHttp\Handler\Proxy;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\ArrayList;
use PhpParser\Node\Expr\Cast\Array_;

class InvoiceManagerController extends Controller
{
    public function index()
    {
        $data['products'] = \App\Models\Products::all();
        $data['order_id'] = \App\Models\Orders::max('order_no') + 1;
        return view('admin::invoice.index', $data);
    }
    public function getPrice(Request $request)
    {
        $id = $request->id;
        $price = \App\Models\Products::find($id)->price;
        $tax = \App\Models\Products::find($id)->tax;
        return response()->json(['price' => $price, 'tax' => $tax]);
    }
    public function exportPdf($id,Request $request)
    {  
        $ids = Auth::user()->id;
        $brand = User::find($ids)->get();
        $data['brand']=$brand;
        $counts = $request->input('count');
        $customer_name = $request->input('customer_name'); 
        $customer_email= $request->input('customer_email');
        $customer_phone= $request->input('customer_phone');
        $customer_phone = str_replace(' ','',$customer_phone);
        $customer_address= $request->input('customer_address');

        $product_name='';
        $product_tax = 0;        
        $product_total = 0;        
        $product_price = 0;        
        for ($i = 0; $i < count($counts); $i++) {
            $product_name = $product_name.$request->name[$i].', ';
            $product_total += (int)$request->total[$i];
            $product_tax += (int)$request->tax[$i];
            $product_price += (int)$request->price[$i];
            $data[$i]['name'] = $request->name[$i];
            $data[$i]['price'] = $request->price[$i];
            $data[$i]['tax'] = $request->tax[$i];
            $data[$i]['quantity'] = $request->quantity[$i];
            $data[$i]['total'] = $request->total[$i];
            $data[$i]['customer_name'] = $customer_name;
            $data[$i]['customer_email'] = $customer_email;
            $data[$i]['customer_phone'] = $customer_phone;
            $data[$i]['customer_address'] = $customer_address;
        }
            $order = new Orders();
            $order->order_no = $id;
            $order->name = $customer_name;
            $order->email = $customer_email;
            $order->phone = $customer_phone;
            $order->address = $customer_address;
            $order->product_name = $product_name;
            $order->product_price = $product_price;
            $order->product_tax = $product_tax;
            $order->product_total = $product_total;
            $order->order_date = $request->input('input_date');
            $order->order_time = $request->input('input_time');
            $order->save();
            // dd($data);
        // return view('admin::invoice.pdf_view',['datas'=>$data]);
        $pdf = PDF::loadView('admin::invoice.pdf_view',['datas'=>$data]);
        $filename = time().'.pdf';
        
        switch ($request->input('action')) {
            case 'Print':
                return $pdf->setPaper('A4')->stream($filename,array("Attachment" => false));
                break;
    
            case 'Download':
                return $pdf->setPaper('A4')->download($filename);
                break;
        }
    }

}
