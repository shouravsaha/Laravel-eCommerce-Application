<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\Order;
use App\Models\Product;

class AdminController extends Controller
{
    //next 3 methods are working to view catagory option
    // and add catagory option and delete catagory option
    public function view_catagory(){
        $data = Catagory::all();
        return view('admin.catagory', compact('data'));
    }
    public function add_catagory(Request $request){
        $data = new Catagory;
        $data->catagory_name = $request->catagory;
        $data->save();
        return redirect()->back()->with('message','Catagory Added Successfully');
    }
    public function delete_catagory($id){
        $data = Catagory::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Catagory Deleted Successfully');
    }
    //
    public function view_product(){
        $catagory = Catagory::all();
        return view('admin.product', compact('catagory'));
    }
    public function add_product(Request $request){
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->catagory = $request->catagory;
        $image = $request->image;
        $imagename = time().'.'.$image->getClientOriginalExtension();
        $request->image->move('product', $imagename);
        $product->image = $imagename;
        $product->save();
        return redirect()->back()->with('message', 'Product Added Successfully');
    }
    public function show_product(){
        $product = Product::all();
        return view('admin.show_product', compact('product'));
    }
    public function delete_product($id){
        $productDelete = Product::find($id);
        $productDelete->delete();
        return redirect()->back()->with('message', 'Product Deleted');
    }
    public function update_product($id){
        $updateProduct = Product::find($id);
        $catagory = Catagory::all();
        return view('admin.update_product', compact('updateProduct', 'catagory'));
    }
    public function update_product_confirm(Request $request, $id){
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->catagory = $request->catagory;
        $image = $request->image;
        if($image){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();
        return redirect()->back()->with('message', 'Product Updated Successfully');
    }
    public function showAllOrders(){
        $order = Order::all();
        return view('admin.order', compact('order'));
    }
}
