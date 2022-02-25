<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['products'] = Products::all();
    return view('dashboard',$data);
    }
    public function store(Request $request){
       
        $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'tax' => 'required',
        ]);
        // dd($request->product_name);
        $data = $request->all();
        Products::create($data);
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );
        return redirect('/dashboard')->with($notification);
    }
    public function edit($id){
        $data['product'] = Products::find($id);
        return view('admin::product.edit',$data);
    }
    public function update($id){
        $product = Products::find($id);
        $product->product_name = request('product_name');
        $product->price = request('price');
        $product->tax = request('tax');
        $product->save();
        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect('/dashboard')->with($notification);
    }
    public function destroy($id){
        $product = Products::find($id);
        $product->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect('/dashboard')->with($notification);
    }

}
