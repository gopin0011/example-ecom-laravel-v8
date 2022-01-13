@extends('layouts.app')
@section('content')

<div class="container">
    <div class="col-md-2">
        <a class="btn btn-warning d-block w-100 mt-4" href="javascript:history.back()"><i class="ci-loading fs-base me-2"></i>Kembali</a>
    </div>
    <div style="margin-top:20px;"></div>
    <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
        <div class="container">
        <h1>Troli Saya</h1>
        <!-- item -->
        @if(count($products))
        <form method="post" action="{{ route('cartUpdate') }}">
        <input type="hidden" name="_method" value="put">
        @csrf
        @foreach ($products as $key => $product)
        <input type="hidden" name="id[{{$key}}]" value="{{ $product->cartId }}">
        <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
            <div class="d-block d-sm-flex align-items-center text-center text-sm-start"><a class="d-inline-block flex-shrink-0 mx-auto me-sm-4" href="{{ route('product', ['id' => $product->id]) }}"><img src="{{ asset('storage/' . $product->thumbnail) }}" width="160" alt="Product"></a>
            <div class="pt-2">
                <h3 class="product-title fs-base mb-2"><a href="{{ route('product', ['id' => $product->id]) }}">{{ $product->title }}</a></h3>
                <div class="fs-lg text-accent pt-2">Rp. {{number_format($product->price)}}</div>
            </div>
            </div>
            <div class="pt-2 pt-sm-0 ps-sm-3 mx-auto mx-sm-0 text-center text-sm-start" style="max-width: 9rem;">
            <label class="form-label" for="quantity1">Qty</label>
            <input class="form-control" type="number" id="quantity1" min="1" value="{{ $product->qty }}" name="qty[{{$key}}]">
            <a class="btn btn-link px-0 text-danger" type="button" href="{{ route('cartProductDelete', [$product->cartId]) }}"><i class="ci-close-circle me-2"></i><span class="fs-sm">Hapus Item</span></a>
            </div>
        </div>
        @endforeach
        <div class="row">
            <div class="col-md-10">
                <button class="btn btn-primary d-block w-100 mt-4" type="submit"><i class="ci-loading fs-base me-2"></i>Update Troli</button>
            </div>
            <div class="col-md-2">
                <button class="btn btn-success d-block w-100 mt-4" type="button" onclick="javascript:window.location.href='{{ route('checkout') }}'"><i class="ci-loading fs-base me-2"></i>Checkout</button>
            </div>
        </div>
        </form>
        @else
        <div class="d-sm-flex justify-content-between align-items-center my-2 pb-3 border-bottom">
            <p>Belum Ada Product Yang Ditambah</p>
        </div>
        @endif
    </div>
    </div>
</div>
@endsection