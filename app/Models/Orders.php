<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Orders extends Authenticatable
{
    // use HasFactory, Notifiable;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id', 'recipients_name', 'phone', 'address', 'prov', 'delivery_amount', 'sub_total', 'total',
    ];

    public function orderDetail()
    {
        return $this->hasMany(OrdersDetail::class, 'orders_id', 'id');
    }

    public static function allListOrder(User $user, Orders $order = null, $status = null)
    {
        return self::with(['orderDetail' => function ($query) use ($user) {
            $query->where(function ($query) use ($user) {
                $query->where('users_id', $user->id);
            });
        }])
        ->whereRaw($status !== null ? 'status='.$status : 'status=0')
        ->whereRaw($order !== null ? 'id='.$order->id : '1=1')
        ->orderBy('created_at', 'asc')
        ->get();
    }
}
