<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Cart;
use App\Models\UsersAddress;
use App\Models\Orders;
use App\Models\OrdersDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public $cartCount;

    public $back;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->back = redirect()->getUrlGenerator()->previous();
        // blade url()->previous()
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $products = Product::orderBy('price', 'desc')->get();

        if($request)
        {
            if($request->order) 
            {
                // $products = DB::table('product')
                //     ->select('*')
                //     ->whereRaw($request->key ? "description like '%".$request->key."%'" : "1=1")
                //     ->orderBy('price', $request->order)
                //     ->get();
                $products = Product::whereRaw($request->key ? "description like '%".$request->key."%'" : "1=1")
                                ->orderBy('price', $request->order)
                                ->get();
            }
        }

        return view('home', [
            'products' => $products,
            'order' => $request->order ? $request->order : 'desc',
            'key' => $request->key ? $request->key : '',
        ]);
    }

    public function product(Product $id)
    {
        $images = ProductImages::where('product_id', $id->id)->get();

        return view('product_detail', [
            'product' => $id,
            'images' => $images,
            'back' => $this->back,
        ]);
    }

    public function productAdd(Request $request, Product $id, $from = '')
    {
        $user = Auth::user();

        $product = Product::find($id->id);

        $oldCart = Cart::where(['product_id' => $id->id, 'users_id' => $user->id, 'has_order' => 0])->first();
        if($oldCart) 
        {
            $oldCart->qty = $oldCart->qty + ($request->qty ? $request->qty : 1);
            $oldCart->total = $oldCart->qty * $product->price;
            $oldCart->price = $product->price;
            $oldCart->save();
        }
        else 
        {
            $cart = new Cart();
            $cart->users_id = $user->id;
            $cart->product_id = $id->id;
            $cart->qty = ($request->qty ? $request->qty : 1);
            $cart->total = $cart->qty * $product->price;
            $cart->price = $product->price;
            $cart->save();
        }

        return redirect()->back()->with('success', 'Success! Product Added');
    }

    public function cart()
    {
        $user = Auth::user();

        $query = Cart::with('product')->where(['users_id' => $user->id, 'has_order' => 0]);
        
        $product = $query->get();

        $total = $query->sum('cart.total');

        return view('cart', [
            'products' => $product,
            'total' => $total,
        ]);
    }

    public function cartUpdate(Request $request)
    {
        foreach ($request->id as $key => $value)
        {
            $cart = Cart::find($value);
            $product = Product::find($cart->product_id);

            $cart->qty = $request->qty[$key];
            $cart->total = $cart->qty * $product->price;
            $cart->price = $product->price;
            $cart->save();
        }

        return redirect()->back()->with('success', 'Success! Update Troli');
    }

    public function cartProductDelete(Cart $id)
    {
        $cart = Cart::find($id->id);
        $cart->delete();

        return redirect()->back()->with('success', 'Success! Update Troli');
    }

    public function checkout()
    {
        $user = Auth::user();

        $query = Cart::with('product')
                    ->where(['users_id' => $user->id, 'has_order' => 0]);
        $product = $query->get();
        $subTotal = $query->sum('total');
        $userAddress = UsersAddress::where('users_id', $user->id)->first();

        $provinsi = $this->getProvinsi()->provinsi;

        return view('checkout', [
            'carts' => $product,
            'subTotal' => $subTotal,
            'userAddress' => $userAddress,
            'provinsi' => $provinsi,
        ]);
    }

    public function getProvinsi()
    {
        $url = 'http://dev.farizdotid.com/api/daerahindonesia/provinsi';

        $headers = [
            'Content-Type' => 'application/json',
        ];

        $client = new \GuzzleHttp\Client([
            'headers' => $headers,
        ]);

        $response = $client->request('GET', $url);

        $statusCode = $response->getStatusCode();
        $content = $response->getBody();

        return json_decode($content);
    }

    public function checkoutCreate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'recipients_name' => 'required|string',
            'phone' => 'required|string',
            'address' => 'required|string',
            'prov' => 'required',
        ]);

        $userAddress = UsersAddress::where('users_id', $user->id)->first();
        if (!$userAddress) 
        {
            $newUserAddress = new UsersAddress();
            $newUserAddress->users_id = Auth::user()->id;
        }
        else 
        {
            $newUserAddress = UsersAddress::find($userAddress->id);
        }

        $newUserAddress->recipients_name = $request->recipients_name;
        $newUserAddress->phone = $request->phone;
        $newUserAddress->address = $request->address;
        $newUserAddress->prov = $request->prov;
        $newUserAddress->save();

        $orders = new Orders();
        $orders->users_id = Auth::user()->id;
        $orders->recipients_name = $request->recipients_name;
        $orders->phone = $request->phone;
        $orders->address = $request->address;
        $orders->prov = $request->prov;
        $orders->delivery_amount = ($orders->prov == 31 || $orders->prov == 32 || $orders->prov == 36) ? 20000:40000;
        $orders->sub_total = Cart::where(['users_id' => $user->id, 'has_order' => 0])
                                ->sum('total');
        $orders->total = ($orders->delivery_amount + $orders->sub_total);
        $orders->save();
        $carts = Cart::select('*', 'cart.id as cartId')
                    ->join('product', 'cart.product_id', '=', 'product.id')
                    ->where(['users_id' => $user->id, 'has_order' => 0])
                    ->get();

        foreach($carts as $cart)
        {
            $ordersDetail = new OrdersDetail();
            $ordersDetail->orders_id = $orders->id;
            $ordersDetail->product_id = $cart->id;
            $ordersDetail->users_id = Auth::user()->id;
            $ordersDetail->qty = $cart->qty;
            $ordersDetail->product_name = $cart->name;
            $ordersDetail->product_title = $cart->title;
            $ordersDetail->product_description = $cart->description;
            $ordersDetail->product_price = $cart->price;
            $ordersDetail->product_thumbnail = $cart->thumbnail;
            $ordersDetail->save();

            $oldCart = Cart::find($cart->cartId);
            $oldCart->has_order = 1;
            $oldCart->save();
        }

        return redirect()->route('orders')->with('success', 'Hi '.Auth::user()->name.'. Terimakasih, Pesanan Anda Telah di Buat dan Akan Kami Proses Secepatnya. Silahkan Lakukan Konfirmasi Pembayaran!');
    }
}
