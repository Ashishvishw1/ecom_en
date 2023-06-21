<?php

namespace App\Http\Controllers;
use App\Models\Product;//imported mmodel
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Session;//imported session to get data to cartItem
use Illuminate\Support\Facades\DB;//for using joints we imported db class

use Razorpay\Api\Api;
class ProductController extends Controller
{
    function index(){
        $data= Product::all();
        return view('Product',['products'=>$data]);
    }
    function detail($id){
$data =Product::find($id);
return view('detail',['product'=>$data]);
    }

    function addToCart(Request $req){
        if($req->session()->has('user'))//IF USER HAS SEESSION THEN ONLY PRODUCT WILL BE IN CART OTHER WISE IT WILL REDIECT TO LOGIN PAGE
        {
            $cart =new Cart;
            $cart->user_id=$req->session()->get('user')['id'];//we getting user id by session 
            $cart->product_id=$req->product_id;//here we getting product id
            $cart->save();
            return redirect('/');
        }
else{

    return redirect('login');
}
    }

    static function cartItem(){
$userId=Session::get('user')['id'];
return Cart::where('user_id',$userId)->count();

    }
    function cartList()
    {
        $userId=Session::get('user')['id'];
       $products= DB::table('cart')
        ->join('products','cart.product_id','=','products.id')//Note::when fetching data from joins usiing db we gettijng data class and pobject format not in array format
        ->where('cart.user_id',$userId)
        ->select('products.*','cart.id as cart_id') //for Getting cart id for remioving of product
        ->get();

        return view('cartlist',['products'=>$products]);
    }
    function removeCart($id)
    {
        Cart::destroy($id);//remove the proeduct
        return redirect('cartlist');
    }
    function orderNow()
    {
        $userId=Session::get('user')['id'];
        $total= $products= DB::table('cart')
         ->join('products','cart.product_id','=','products.id')  //Note::when fetching data from joins usiing db we gettijng data class and pobject format not in array format
         ->where('cart.user_id',$userId)
         ->sum('products.price');
 
         return view('ordernow',['total'=>$total]);
    }
    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];//get all cart data depending on user who had loggedin 
         $allCart= Cart::where('user_id',$userId)->get();
         foreach($allCart as $cart)
         {
             $order= new Order; //created instance of order model
             $order->product_id=$cart['product_id'];
             $order->users_id=$cart['user_id'];
             $order->status="pending";
             $order->payment_method=$req->payment;
             $order->payment_status="pending";
             $order->address=$req->address;
             $order->save();
             Cart::where('user_id',$userId)->delete();  //after placcing oreder data remove from cart
         }
         $req->input();
         return redirect('/');
    }
    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
         ->join('products','orders.product_id','=','products.id')
         ->where('orders.users_id',$userId)
         ->get();
 
         return view('myorders',['orders'=>$orders]);

        }

        function onlinepay(){
            $userId=Session::get('user')['id'];
            $total= $products= DB::table('cart')
             ->join('products','cart.product_id','=','products.id')  //Note::when fetching data from joins usiing db we gettijng data class and pobject format not in array format
             ->where('cart.user_id',$userId)
             ->sum('products.price');
             return view('payment',['total'=>$total]);
            
            
        }
        public $api;
        public function __construct(Type $var = null) {
            $this->api = new Api("rzp_test_TixgzEzxWCouVt", "Q1n8Mf7Wesr11FAiPw1GsMrL");
        }
      public  function makeOrder (Request $req){
           $this->validate($req,[

            'amount'=>'required',
           ]);

           $orderid =rand(11111,99999);
           $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => ($req->get('amount') * 100), // 39900 rupees in paise
            'currency'        => 'INR',
           'notes'=>['order_id'=>$orderid,
           ],
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
       
return view('conformation',compact('orderid','razorpayOrder'));

        }
       
       
            function success(Request $req){



$status= $this->api->payment->fetch($req->get('payment_id'));

// dd($status);
if ($status->status == 'authorized') {
   // return redirect('/')->with('success','payment Sucessfully done');
    $userId=Session::get('user')['id'];//get all cart data depending on user who had loggedin 
 
    Cart::where('user_id',$userId)->delete();
    return redirect('/');
    # code...
}


        }
}

