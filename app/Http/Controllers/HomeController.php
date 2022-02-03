<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\Cart;
use App\Models\UsersAddress;
use App\Models\Orders;
use App\Models\OrdersDetail;
use App\Models\CartProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

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
        // $this->back = redirect()->getUrlGenerator()->previous();
        if (!Cookie::get('cart-secret-key'))
        {
            // \Illuminate\Support\Str::random(32)
            $secretKey = md5(uniqid(rand(), true));
            Cookie::queue(Cookie::make('cart-secret-key', $secretKey, (30*24*60*60)));
            $cart = \App\Models\Cart::where('secret_key', $secretKey)->first();
            if(!$cart)
            {
                $cart = new \App\Models\Cart;
                $cart->secret_key = $secretKey;
                $cart->save();
            }
        }
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

    public function product(Product $product)
    {
        $images = ProductImages::where('product_id', $product->id)->get();

        return view('product_detail', [
            'product' => $product,
            'images' => $images,
            'back' => $this->back,
        ]);
    }

    public function productAdd(Request $request, Product $product, $from = '')
    {
        $flashMessage = [];

        $user = Auth::user();

        $carts = Cart::with('cart_product')
                    ->where('secret_key', Cookie::get('cart-secret-key'))
                    ->where('has_order', 0);
        if($user) 
        {
            $carts->orWhere('users_id', $user->id);
        }
        $carts = $carts->get();

        // dd($cart);
           
        $cartProduct = CartProduct::whereIn('cart_id', function ($query) use ($carts){
                                        foreach($carts as $cart)
                                        {
                                            $query->select('id')
                                                ->from('cart')
                                                ->where('cart_id', $cart->id);
                                        }
                                    })
                                    ->where('product_id', $product->id)
                                    ->first(); 
        if(!$cartProduct)
        {
            $cartProduct = new CartProduct();
            $cartProduct->cart_id = $carts[0]->id;
            $cartProduct->product_id = $product->id;
            $cartProduct->quantity = ($request->qty ? $request->qty : 1);
            $cartProduct->total = $request->qty * $product->price;
            $cartProduct->price = $product->price;
            $cartProduct->save();
            // Session::flash('success', 'Success! Product Added');
            $flashMessage = ['success'=>'Success! Product Added'];
        }
        else
        {
            $cartProduct->quantity = $cartProduct->quantity+1;
            $cartProduct->total = $cartProduct->quantity * $product->price;
            $cartProduct->save();
            $flashMessage = ['success'=>'Success! Quantity di tambah'];
        }
        
        return redirect()->back()->with($flashMessage);
    }

    public function cart()
    {
        $user = Auth::user();

        $carts = Cart::with('cart_product.product')
                    ->where('secret_key', Cookie::get('cart-secret-key'))
                    ->where('has_order', 0);
        if($user)
        {
            $carts->orWhere('users_id', $user->id);
        }
        $carts = $carts->get();

        $total = $carts->sum(function($carts){
            return $carts->cart_product->sum('total');
        });
        // dd();

        $items = $carts->sum(function($carts){
            return $carts->cart_product->count();
        });

        return view('cart', [
            'carts' => $carts,
            'total' => $total,
            'items' => $items,
        ]);
    }

    public function cartUpdate(Request $request)
    {
        if($request->action === 'checkout')
        {
            $data = Crypt::encrypt([ 'params' => $request->id ]);
            if(!Auth::check())
            {
                // dd($request->id);
                // route('post.show', ['post' => 1])
                return redirect()->route('doLogin', [ 'next' => route('cartCheckout', [ 'ref' => $data ]) ])->with('error', 'Kamu Harus Login Terlebih Dahulu');
            }

            return redirect()->route('cartCheckout', ['ref' => $data]);
        }

        foreach ($request->id as $key => $value)
        {
            $cartProduct = CartProduct::find($value);
            $product = Product::find($cartProduct->product_id);

            $cartProduct->quantity = $request->quantity[$key];
            $cartProduct->total = $cartProduct->quantity * $product->price;
            $cartProduct->price = $product->price;
            $cartProduct->save();
        }

        return redirect()->back()->with('success', 'Success! Update Troli');
    }

    public function cartCheckout(Request $request)
    {
        $data = Crypt::decrypt($request->ref);
        $cartProductId = $data['params'];

        $carts = Cart::whereHas('cart_product', function($q) use ($cartProductId){
            $q->whereIn('cart_product.id', $cartProductId);
        })
        ->with('cart_product.product')
        ->where('has_order', 0)
        ->get();

        $user = Auth::user();
        
        $userAddress = UsersAddress::where('users_id', $user->id)->first();

        $provinsi = $this->getProvinsi()->provinsi;
        $subTotal = 0;

        return view('checkout', [
            'carts' => $carts,
            'subTotal' => $subTotal,
            'userAddress' => $userAddress,
            'provinsi' => $provinsi,
        ]);
    }

    public function cartProductDelete(CartProduct $cartProduct)
    {
        $cartProduct->delete();

        return redirect()->back()->with('success', 'Success! Update Troli');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        $cart = Cart::withAndWhereHas('cart_product', function($query) use ($request){
            $query->whereIn('cart_product.id', $request->id);
        })
        ->with('cart_product.product')
        ->where('has_order', 0)
        ->get();

        dd($cart);
        $subTotal = $cart->cart_product->sum('total');

        $userAddress = UsersAddress::where('users_id', $user->id)->first();

        $provinsi = $this->getProvinsi()->provinsi;

        return view('checkout', [
            'carts' => $cart->cart_product,
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
        $carts = Cart::with('product')
                    ->where(['users_id' => $user->id, 'has_order' => 0])
                    ->get();

        foreach($carts as $cart)
        {
            $ordersDetail = new OrdersDetail();
            $ordersDetail->orders_id = $orders->id;
            $ordersDetail->product_id = $cart->product->id;
            $ordersDetail->users_id = Auth::user()->id;
            $ordersDetail->qty = $cart->qty;
            $ordersDetail->product_name = $cart->product->name;
            $ordersDetail->product_title = $cart->product->title;
            $ordersDetail->product_description = $cart->product->description;
            $ordersDetail->product_price = $cart->product->price;
            $ordersDetail->product_thumbnail = $cart->product->thumbnail;
            $ordersDetail->save();

            $oldCart = Cart::find($cart->id);
            $oldCart->has_order = 1;
            $oldCart->save();
        }

        return redirect()->route('orders')->with('success', 'Hi '.Auth::user()->name.'. Terimakasih, Pesanan Anda Telah di Buat dan Akan Kami Proses Secepatnya. Silahkan Lakukan Konfirmasi Pembayaran!');
    }
}
