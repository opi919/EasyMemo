<?php

namespace App\Http\Controllers;

use App\Models\Baki;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BakiController extends Controller
{
    public function index(){
        $data['bakis'] = DB::table('bakis')->paginate(10);
        return view('admin::baki.index',$data);
    }
    public function add(){
        return view('admin::baki.add');
    }
    public function store(Request $request){
        $baki = new Baki;
        $baki->order_no = $request->order_no;
        $baki->customer_name = $request->customer_name;
        $baki->customer_phone = $request->customer_phone;
        $baki->customer_email = $request->customer_email;
        $baki->customer_address = $request->customer_address;
        $baki->amount = $request->amount;
        $baki->save();
        $notification = array(
            'message' => 'Item Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('baki.index')->with($notification);
    }
    public function setPaid($id){
        $data = Baki::find($id);
        $data->delete();
        $notification = array(
            'message' => 'Item Set as Paid Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('baki.index')->with($notification);
    }
}
