<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index(){
        return view('admin::sales.index');
    }
    public function getData(Request $request){
        
        $date = $request->date;
        $order = Orders::where('order_date','<=',$date)->get();
        // if order null
        if(count($order) == 0){
            $order = Orders::where('order_no',$date)->get();
        }
        if(count($order) == 0) //error
        {
            return response()->json(['status'=>'error','message'=>'No data found']);

        }
        return response()->json(['order' => $order]);
    }

}
