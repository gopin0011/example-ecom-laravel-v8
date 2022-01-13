<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrdersDetail extends Authenticatable
{
    // use HasFactory, Notifiable;

    protected $table = 'orders_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'orders_id', 'product_id', 'users_id', 'qty', 'product_name', 'product_title', 'product_description', 'product_price', 'product_thumbnail',
    ];
}
