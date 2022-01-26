<?php

// Home
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', route('home'));
});

// Home > Cart
Breadcrumbs::for('cart', function ($trail) {
    $trail->parent('home');
    $trail->push('Troli', route('cart'));
});

// Home > [Product]
Breadcrumbs::for('product', function ($trail, $product) {
    $trail->parent('home');
    $trail->push($product->title, route('product', $product->id));
});

// Home > Troli > Checkout
Breadcrumbs::for('checkout', function ($trail) {
    $trail->parent('cart');
    $trail->push('Checkout', route('checkout'));
});

// Home > Order
Breadcrumbs::for('orders', function ($trail) {
    $trail->parent('home');
    $trail->push('Orders', route('orders'));
});

// Home > Order > [Konfirmasi Pembayaran]
Breadcrumbs::for('paymentConfirmation', function ($trail, $order) {
    $trail->parent('orders');
    // dd($order[0]->id);
    $trail->push('Konfirmasi Pembayaran ['.$order[0]->id.']', route('payment', $order[0]->id));
});

