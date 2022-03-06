<?php

namespace App\Http\Controllers;

use App\Models\Baki;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;

class LiveSearchController extends Controller
{
    public function liveSearch()
    {
        $data = request()->get('data');
        $products = Products::where('product_name', 'like', '%' . $data . '%')->get();
        $orders = Orders::where('name', 'like', '%' . $data . '%')->orWhere('email', 'like', '%' . $data . '%')
            ->orWhere('phone', 'like', '%' . $data . '%')
            ->orWhere('order_no', 'like', '%' . $data . '%')
            ->orWhere('address', 'like', '%' . $data . '%')
            ->orWhere('order_date', 'like', '%' . $data . '%')
            ->orWhere('order_time', 'like', '%' . $data . '%')
            ->get();
            $baki = Baki::where('customer_name', 'like', '%' . $data . '%')
            ->orWhere('customer_phone', 'like', '%' . $data . '%')
            ->orWhere('customer_address', 'like', '%' . $data . '%')
            ->orWhere('order_no', 'like', '%' . $data . '%')
            ->get();
        $all2 = $products->concat($orders);
        $all = $all2->concat($baki);
        if (count($all) == 0) //error
        {
            return response()->json(['status' => 'error', 'message' => 'No data found']);
        }
        return response()->json(['all' => $all]);
    }
}
