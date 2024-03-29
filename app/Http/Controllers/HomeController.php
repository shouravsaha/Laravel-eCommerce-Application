<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Session;
use Stripe;

class HomeController extends Controller
{
    //user home page controller
    public function index(){
        $product = Product::paginate(10);
        return view('home.userpage', compact('product'));
    }
    //user and admin login authentication controller
    public function redirect(){
        $usertype = Auth::user()->usertype;
        if($usertype=="1"){
            $total_product = Product::all()->count();
            $total_order = Order::all()->count();
            $total_user = User::all()->count();
            $order = Order::all();
            $total_revenue = 0;
            foreach($order as $order){
                $total_revenue = $total_revenue + $order->price;
            }
            $total_delivered = Order::where('delivery_status', '=', 'delivered')->get()->count();
            $total_processing = Order::where('delivery_status', '=', 'processing')->get()->count();
            return view('admin.home', compact('total_product', 'total_order', 'total_user', 'total_revenue', 'total_delivered', 'total_processing'));
        }else{
            $product = Product::paginate(10);
            return view('home.userpage', compact('product'));
        }
    }
    // product details controller
    public function product_details ($id){
        $product = Product::find($id);
        return view('home.product_details', compact('product'));
    }
    // product add to cart controller
    public function add_cart(Request $request, $id){
        if(Auth::id()){
            $user = Auth::user();
            $user_id = $user->id;
            $product = Product::find($id);
            $product_exist_id = Cart::where('Product_id', '=', $id)->where('user_id', '=', $user_id)->get('id')->first();

            if($product_exist_id){
                $cart = Cart::find($product_exist_id)->first();
                $quantity = $cart->quantity;
                $cart->quantity = $quantity + $request->quantity;
                if($product->discount_price!=null){
                    $cart->price = $product->discount_price * $cart->quantity;
                }else{
                    $cart->price = $product->price * $cart->quantity;
                }
                $cart->save();
                Alert::success('Product Added Successfully', 'We have added product to the cart');
                return redirect()->back()->with('message', 'Product Added Successfully');
            }else{
                $cart = new Cart;
                $cart->name = $user->name;
                $cart->email = $user->email;
                $cart->phone = $user->phone;
                $cart->address = $user->address;
                $cart->user_id = $user->id;
                $cart->Product_title = $product->title;
                if($product->discount_price!=null){
                    $cart->price = $product->discount_price * $request->quantity;
                }else{
                    $cart->price = $product->price * $request->quantity;
                }
                $cart->image = $product->image;
                $cart->product_id = $product->id;
                $cart->quantity = $request->quantity;
                $cart->save();
                Alert::success('Product Added Successfully', 'We have added product to the cart');
                return redirect()->back()->with('message', 'Product Added Successfully');
                return redirect()->back();
            }
        }else{
            return redirect('login');
        }
    }
    public function show_cart(){
        if(Auth::id()){
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));
        }else{
            return redirect('login');
        }
    }
    public function remove_cart($id){
        $cart = Cart::find($id);
        $cart->delete();
        return redirect()->back();
    }
    public function cash_order(){
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', '=', $userId)->get();
        foreach($data as $data){
            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'cash on delivery';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message', 'We have Received Your Order. We will connect with you soon');
    }
    public function stripe($totalprice){
        return view('home.stripe', compact('totalprice'));
    }
    public function stripePost(Request $request, $totalprice){
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thanks for payment"
        ]);
        $user = Auth::user();
        $userId = $user->id;
        $data = Cart::where('user_id', '=', $userId)->get();
        foreach($data as $data){
            $order = new Order;

            $order->name = $data->name;
            $order->email = $data->email;
            $order->phone = $data->phone;
            $order->phone = $data->phone;
            $order->address = $data->address;
            $order->user_id = $data->user_id;
            $order->product_title = $data->product_title;
            $order->price = $data->price;
            $order->quantity = $data->quantity;
            $order->image = $data->image;
            $order->product_id = $data->Product_id;
            $order->payment_status = 'paid';
            $order->delivery_status = 'processing';
            $order->save();

            $cart_id = $data->id;
            $cart = Cart::find($cart_id);
            $cart->delete();
        }

        Session('success', 'Payment successful!')->flash('success', 'Payment successful');
        return back();
    }
    public function show_order(){
        if(Auth::id()){
            $user = Auth::User();
            $userId = $user->id;
            $order = Order::where('user_id', '=', $userId)->get();
            return view('home.order', compact('order'));
        }else{
            return redirect('login');
        }
    }
    public function cancel_order($id){
        $order = Order::find($id);
        $order->delivery_status = 'You canceled the order';
        $order->save();
        return redirect()->back();
    }
    public function product_search(Request $request){
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "%$search_text%")->paginate(10);
        return view('home.userpage', compact('product'));
    }
    public function product(){

        $product = Product::paginate(10);
        return view('home.all_product', compact('product'));

    }

    public function search_product(Request $request){
        $search_text = $request->search;
        $product = Product::where('title', 'LIKE', "%$search_text%")->orWhere('catagory', 'LIKE', "%$search_text%")->paginate(10);
        return view('home.all_product', compact('product'));
    }
}
