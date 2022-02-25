<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use GuzzleHttp\Handler\Proxy;
// use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
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
    public function exportPdf(Request $request)
    {  
        $counts = $request->input('count');
        $customer_name = $request->input('customer_name');
        $customer_email = $request->input('customer_email');
        $customer_phone = $request->input('customer_phone');
        $customer_address = $request->input('customer_address');
        $order_date = $request->input('input_date');
        $order_time = $request->input('input_time');
        $order_id = $request->input('input_order_id');
        $status = $request->status;
        // dd($order_date);
        for ($i = 0; $i < count($counts); $i++) {
            $data[$i]['name'] = $request->name[$i];
            $data[$i]['price'] = $request->price[$i];
            $data[$i]['tax'] = $request->tax[$i];
            $data[$i]['quantity'] = $request->quantity[$i];
            $data[$i]['total'] = $request->total[$i];
            $order = new Orders();
            $order->order_no = $order_id;
            $order->name = $customer_name;
            $order->email = $customer_email;
            $order->phone = $customer_phone;
            $order->address = $customer_address;
            $order->product_name = $request->name[$i];
            $order->product_id = Products::where('product_name', $request->name[$i])->first()->id;
            $order->product_price = $request->price[$i];
            $order->product_tax = $request->tax[$i];
            $order->product_quantity = $request->quantity[$i];
            $order->product_total = $request->total[$i];
            $order->order_date = $order_date;
            $order->order_time = $order_time;
            $order->status = $status;
            $order->save();
        }
        //  dd($data);
        return view('admin::invoice.pdf_view',['datas'=>$data]);
        // $pdf = PDF::loadView('admin::invoice.pdf_view',['datas'=>$data]);
        // $filename = time().'.pdf'; 
        // return $pdf->download($filename);
    }

}
