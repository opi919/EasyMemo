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
        $data['products'] = Products::paginate(10);
        return view('admin::product.index',$data);
    }
    public function add(){
        return view('admin::product.add');
    }
    public function store(Request $request){
        $data = new Products;
        $data->product_name = $request->product_name;
        $data->price = $request->product_price;
        $data->tax = $request->product_tax;
        $data->save();
        $notification = array(
            'message' => 'Product Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('dashboard')->with($notification);
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
