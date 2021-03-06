<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersPayment;
use App\Models\Orders;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function orders()
    {
        $user = Auth::user();

        $pendingPayments = Orders::allListOrder($user);

        $orders = Orders::allListOrder($user, $order = null, $status = 1);

        return view('orders', [
            'pendingPayments' => $pendingPayments,
            'orders' => $orders,
        ]);
    }

    public function payment(Orders $order)
    {
        $user = Auth::user();

        $pendingPayments = Orders::allListOrder($user, $order);

        return view('payment', [
            'pendingPayments' => $pendingPayments,
        ]);
    }

    public function paymentCreate(Request $request, Orders $order)
    {
        $user = Auth::user();

        $request->validate([
            'senders_account' => 'required|string',
            'bank_name' => 'required|string',
            'amount' => 'required|integer',
        ]);

        $usersPayment = new UsersPayment();
        $usersPayment->orders_id = $order->id;
        $usersPayment->users_id = $user->id;
        $usersPayment->senders_account = $request->senders_account;
        $usersPayment->amount = $request->amount;
        $usersPayment->bank_name = $request->bank_name;
        $usersPayment->save();

        $order = Orders::find($order->id);
        $order->status = 1;
        $order->save();

        // notify()->success('Terimakasih, Kami Akan Segera Memproses Pesanan Anda!');
        return redirect()->route('orders')->with('success', 'Terimakasih, Kami Akan Segera Memproses Pesanan Anda');

    }
}