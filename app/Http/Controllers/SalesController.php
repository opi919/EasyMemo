<?php

namespace App\Http\Controllers;

use App\Exports\exportData;
use App\Models\Orders;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SalesController extends Controller
{
    public function index(){
        return view('admin::sales.index');
    }
    public function search(Request $request){
        $date = $request->date;
        $from_date = substr($date,0,10);
        $to_date = substr($date,10,20);
        $order = Orders::where('order_date','<=',$from_date)
        ->where('order_date','>=',$to_date)
        ->get();
        if(count($order) == 0) //error
        {
            return response()->json(['status'=>'error','message'=>'No data found']);

        }
        return response()->json(['order' => $order]);
    }
    public function export(Request $request)
    {
        $from_date = $request->input('from_date');
        // dd($from_date);
        $to_date = $request->input('to_date');
        $order = Orders::where('order_date','<=',$from_date)
        ->where('order_date','>=',$to_date)
        ->get();
        $filename = $from_date.'_'.$to_date.'.xlsx';
        return Excel::download(new exportData($order),$filename);
    }
}
