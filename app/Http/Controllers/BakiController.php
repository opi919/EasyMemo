<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BakiController extends Controller
{
    public function index(){
        // sort orders
        // get distinct value
        // $baki = Orders::query()->distinct()->where('status','due')->get();
        // dd($baki);
        // array
        $baki= DB::table('orders')->select('order_no')->where('status','due')->distinct();
        // add select
        $name = $baki->addSelect('name');
        $bakis = $name->addSelect('phone')->get()->toArray();
        // dd($bakis[0]->order_no);
        return view('admin::baki.index',compact('bakis'));
    }
}
