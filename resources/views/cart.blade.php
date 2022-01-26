@extends('layouts.app')
@section('content')
<style>
/* body {
    background: #ddd;
    min-height: 100vh;
    vertical-align: middle;
    display: flex;
    font-family: sans-serif;
    font-size: 0.8rem;
    font-weight: bold
} */

.title {
    margin-bottom: 5vh
}

.card {
    margin: auto;
    /* max-width: 950px; */
    width: 100%;
    box-shadow: 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    /* border-radius: 1rem; */
    border: transparent
}

@media(max-width:767px) {
    .card {
        margin: 3vh auto
    }
}

.cart {
    background-color: #fff;
    padding: 4vh 5vh;
    /* border-bottom-left-radius: 1rem; */
    /* border-top-left-radius: 1rem */
}

@media(max-width:767px) {
    .cart {
        padding: 4vh;
        /* border-bottom-left-radius: unset; */
        /* border-top-right-radius: 1rem */
    }
}

.summary {
    background-color: #ddd;
    /* border-top-right-radius: 1rem; */
    /* border-bottom-right-radius: 1rem; */
    padding: 4vh;
    color: rgb(65, 65, 65)
}

@media(max-width:767px) {
    .summary {
        /* border-top-right-radius: unset; */
        /* border-bottom-left-radius: 1rem */
    }
}

.summary .col-2 {
    padding: 0
}

.summary .col-10 {
    padding: 0
}

.row {
    margin: 0
}

.title b {
    font-size: 1.5rem
}

.main {
    margin: 0;
    padding: 2vh 0;
    width: 100%
}

.col-2,
.col {
    padding: 0 1vh
}

/* a {
    padding: 0 1vh
}  */

.close {
    margin-left: auto;
    font-size: 0.7rem
}

img {
    width: 3.5rem
}

.back-to-shop {
    margin-top: 4.5rem
}

h5 {
    margin-top: 4vh
}

hr {
    margin-top: 1.25rem
}

/* form {
    padding: 2vh 0
} */

select {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1.5vh 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
}

input {
    border: 1px solid rgba(0, 0, 0, 0.137);
    padding: 1vh;
    margin-bottom: 4vh;
    outline: none;
    width: 100%;
    background-color: rgb(247, 247, 247)
} 

input:focus::-webkit-input-placeholder {
    color: transparent
}

.btn {
    /* background-color: #000;
    border-color: #000;
    color: white; */
    width: 100%;
    /* font-size: 0.7rem; */
    margin-top: 4vh;
    padding: 1vh;
    border-radius: 1
}

.btn:focus {
    box-shadow: none;
    outline: none;
    box-shadow: none;
    color: white;
    -webkit-box-shadow: none;
    -webkit-user-select: none;
    transition: none
}

.btn:hover {
    color: white
} 

/* a {
    color: black
}

a:hover {
    color: black;
    text-decoration: none
}  */

#code {
    background-image: linear-gradient(to left, rgba(255, 255, 255, 0.253), rgba(255, 255, 255, 0.185)), url("https://img.icons8.com/small/16/000000/long-arrow-right.png");
    background-repeat: no-repeat;
    background-position-x: 95%;
    background-position-y: center
}

.vcenter {
    margin-top:25px;
}
</style>
<div class="container">
    <div class="bg-light shadow-lg rounded-3">
        {{ Breadcrumbs::render('cart') }}
    </div>
    <div style="margin-top:20px;"></div>
    <!-- <div class="bg-light shadow-lg "> -->
        <div class="card">
            <div class="row">
                <div class="col-md-8 cart rounded-3">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Troli</b></h4>
                            </div>
                            <div class="col align-self-center text-right text-muted">{{count($products)}} items</div>
                        </div>
                    </div>
                    @if(count($products))
                    <form method="post" action="{{ route('cartUpdate') }}">
                        <input type="hidden" name="_method" value="put">
                        @csrf
                        @foreach ($products as $key => $product)
                        <input type="hidden" name="id[{{$key}}]" value="{{ $product->cartId }}">
                        <div class="row border-top border-bottom">
                            <div class="row main align-items-center">
                                <div class="col-2"><img class="img-fluid" src="{{ asset('storage/' . $product->thumbnail) }}"></div>
                                <div class="col">
                                    <!-- <div class="row text-muted">Shirt</div> -->
                                    <div class="row text-muted">{{ $product->title }}</div>
                                </div>
                                <div class="col"><input class="form-control col-md-5 vcenter" type="number" id="quantity1" min="1" value="{{ $product->qty }}" name="qty[{{$key}}]"></div>
                                <div class="col text-right">Rp. {{number_format($product->price)}}</div>
                                <div class="col-sm-2"><a href="{{ route('cartProductDelete', [$product->cartId]) }}"><span class="close">&#10005;</span></a></div>
                            </div>
                        </div>
                        @endforeach
                        <button class="btn btn-primary" type="submit">Update Troli</button>
                    </form>
                    @else
                    <div class="col align-self-center text-center text-muted">
                        <h1 class="h6">Belum Ada Product</h1>
                    </div>
                    @endif
                    <div class="back-to-shop"><a href="{{route('home')}}">&leftarrow;</a><span class="text-muted">Back to shop</span></div>
                </div>
                <div class="col-md-4 summary rounded-3">
                    <div>
                        <h5><b>Summary</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:0;">ITEMS {{count($products)}}</div>
                        <!-- <div class="col text-right">&euro; 132.00</div> -->
                    </div>
                    <div class="row" style="padding: 2vh 0;">
                        <div class="col">TOTAL PRICE</div>
                        <div class="col text-right">Rp. {{number_format($total)}}</div>
                    </div>
                    <form>
                    <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                        <!-- <p>SHIPPING</p> <select>
                            <option class="text-muted">Standard-Delivery- &euro;5.00</option>
                        </select> -->
                        <p>GIVE CODE</p> <input id="code" placeholder="Enter your code">
                    </div>
                    </form>
                     <a class="btn btn-success {{count($products) ? '':'disabled'}}" href="{{ route('checkout') }}">Checkout</a>
                </div>
            </div>
        </div>
    <!-- </div> -->
</div>
@endsection