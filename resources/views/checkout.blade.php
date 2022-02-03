@extends('layouts.app')

@section('content')
<div class="container">
    <div class="bg-light shadow-lg rounded-3">
    {{ Breadcrumbs::render('checkout') }}
    </div>
    <div style="margin-top:20px;"></div>
    <div class="row">
        <div class="col-md-4">
            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                <div class="py-2 px-xl-2">
                    <div class="widget mb-3">
                        <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Rincian Pemesanan</b></h1>
                        @foreach($carts as $cart)
                            @foreach($cart->cart_product as $cartProduct)
                            <div class="d-flex align-items-center pb-2 border-bottom px-1 py-3"><a class="d-block flex-shrink-0" href="{{ route('product', ['product' => $cartProduct->product->id]) }}"><img src="{{ asset('storage/' . $cartProduct->product->thumbnail) }}" width="64" alt="Product"></a>
                            <div class="ps-2">
                                <h1 class="h6 widget-product-title"><a href="{{ route('product', ['product' => $cartProduct->product->id]) }}">{{$cartProduct->product->name}}</a></h1>
                                <div class="widget-product-meta"><span class="text-accent me-2">Rp. {{number_format($cartProduct->product->price)}}</span><span class="text-muted">x {{$cartProduct->quantity}}</span></div>
                            </div>
                            </div>
                            @endforeach
                        @endforeach
                    </div>
                    <ul class="list-unstyled fs-sm pb-2 border-bottom">
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Subtotal:</span><span class="text-end" id="subTotal">Rp. {{number_format($subTotal)}}</span></li>
                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Ongkos Kirim:</span><span class="text-end" id="ongkir">Rp. 0</span></li>
                    </ul>
                    <h3 class="fw-normal text-center my-4" id="total">Rp. </h3>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <form method="POST" action="{{ route('checkoutCreate') }}">
            @csrf
            <input type="hidden" name="biaya_ongkir" id="biaya_ongkir" value="">
                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                    <div class="py-2 px-xl-2">
                        <div class="widget mb-3">
                            <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Alamat Pengiriman</b></h1>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label">Nama Penerima</label>
                                    <input class="form-control @error('recipients_name') is-invalid @enderror" type="text" name="recipients_name" value="{{ old('recipients_name', !$userAddress ? Auth::user()->name : $userAddress->recipients_name) }}">
                                    @error('recipients_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label">No Handphone</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone', !$userAddress ? '' : $userAddress->phone) }}">
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label" for="checkout-fn">Alamat Lengkap</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" name="address">{{ old('address', !$userAddress ? '' : $userAddress->address) }}</textarea>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label">Provinsi</label>
                                    <select class="form-select @error('prov') is-invalid @enderror" name="prov" id="prov">
                                        <option value="">--Pilih Provinsi--</option>
                                        @foreach($provinsi as $prov)
                                        <option value="{{$prov->id}}" {{ old('prov', !$userAddress ? '' : $userAddress->prov) == $prov->id ? 'selected' : '' }}>{{$prov->nama}}</option>
                                        @endforeach
                                    </select>
                                    @error('prov')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Pembayaran</b></h1>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label" for="checkout-ln">Manual Transfer </label>
                                    <img src="{{ asset('storage/icon-bca.png') }}" width="70" height="35">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                    <label class="form-label" for="checkout-ln">No Rek: 6755.224.077<br>An: Erfin Gustaman<br>BCA Cabang Jati Asih</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary d-block w-100 mt-4" type="submit"><i class="ci-loading fs-base me-2"></i>Buat Pemesanan</button>
            </form>
        </div>
    </div>
</div>
        
@endsection

@section('js')
<script>
    $(document).ready(function(){
        function getOngkir(prov)
        {
            var ongkir = 0;
            if (prov == '32' || prov == '31' || prov == '36')
            {
                ongkir = 20000;
            }
            else if (prov == '')
            {
                ongkir = 0;
            }
            else 
            {
                ongkir = 40000;
            }
            return ongkir;
        }

        function onload()
        {
            var subTotal = parseInt({{$subTotal}});
            var prov = $('#prov').find(":selected").attr('value');
            var ongkir = getOngkir(prov);

            total = (subTotal + ongkir);
            $('#total').html('Rp. '+addCommas(total));
            $('#ongkir').html('Rp. '+addCommas(ongkir));
        }
        
        onload();

        $('#prov').on('change', function(){
            onload();
        });

        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    });
</script>
@endsection