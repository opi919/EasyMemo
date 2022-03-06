<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $total = Orders::select('product_total')->get();
        $from = Carbon::now()->isoFormat('Y-MM-DD');
        $to=Carbon::now()->subDays(6)->isoFormat('Y-MM-DD');
        $total = Orders::where('order_date','<=',$from)->where('order_date','>=',$to)->get();
        $subTotal =0;
        $tax=0;
        foreach($total as $item){
            $subTotal+=(int)$item->product_total;
            $tax+=(int)$item->product_tax;
       }
        // dd($from);
        $data['subTotal']=$subTotal;
        $data['tax']=$tax;
        return view('dashboard',$data);
    }

    public function setting()
    {
        $user = auth()->user();
        return view('setting', compact('user'));
    }
    public function update(Request $request)
    {
        $user = auth()->user();
        $user->brand_name = $request->brand_name;
        $user->brand_email = $request->brand_email;
        $user->brand_contact = $request->brand_contact;
        $user->brand_address = $request->brand_address;

        // dd($request->brand_logo->getClientOriginalExtension());
        $filename = time() . '.' . $request->file('brand_logo')->getClientOriginalExtension();
        $request->file('brand_logo')->storeAs('public/logo/', $filename);
        $user->brand_logo = $filename;
        $user->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('setting')->with($notification);
    }
}
