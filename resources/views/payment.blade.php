@extends('layouts.app')
@section('content')
<div class="container">
    <div class="bg-light shadow-lg rounded-3">
        {{ Breadcrumbs::render('paymentConfirmation', $pendingPayments) }}
    </div>
    <div style="margin-top:20px;"></div>
    <div class="bg-light shadow-lg rounded-3">
          <!-- Tabs-->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link py-4 px-sm-4 active" href="#general" data-bs-toggle="tab" role="tab" aria-selected="true">Konfirmasi Pembayaran</a></li>
            <!-- <li class="nav-item"><a class="nav-link py-4 px-sm-4" href="#reviews" data-bs-toggle="tab" role="tab" aria-selected="false">Diskusi <span class="fs-sm opacity-60">(74)</span></a></li> -->
          </ul>
          <div class="px-4 pt-lg-3 pb-3 mb-5">
            <div class="tab-content px-lg-3">
              <!-- Menunggu pembayaran-->
              <div class="tab-pane fade active show" id="general" role="tabpanel">
                @foreach ($pendingPayments as $order)
                <form method="post" action="{{ route('paymentCreate', ['order' => $order->id]) }}">
                @csrf
                    <div style="margin-top:20px;">
                        <div class="row">
                            <div class="col-lg-4 pe-lg-0">
                                <!-- List Order -->
                                <div class="py-2 px-xl-2">
                                    <div class="widget mb-3">
                                        <h1 class="h6 widget-title"><b>Order Detail</b></h1>
                                        @foreach ($order->orderDetail as $product)
                                        <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="{{ route('product', ['id' => $product->product_id]) }}"><img src="{{ asset('storage/' . $product->product_thumbnail) }}" width="64" alt="Product"></a>
                                            <div class="ps-2">
                                                <h6 class="widget-product-title"><a href="{{ route('product', ['id' => $product->product_id]) }}">{{$product->product_name}}</a></h6>
                                                <div class="widget-product-meta"><span class="text-accent me-2">Rp. {{number_format($product->product_price)}}</span><span class="text-muted">x {{$product->qty}}</span></div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Subtotal:</span><span class="text-end" id="subTotal">Rp. {{number_format($order->sub_total)}}</span></li>
                                        <li class="d-flex justify-content-between align-items-center"><span class="me-2">Ongkos Kirim:</span><span class="text-end" id="ongkir">Rp. {{number_format($order->delivery_amount)}}</span></li>
                                    </ul>
                                    <h3 class="fw-normal text-center my-4" id="total">Rp. {{number_format($order->total)}}</h3>
                                </div>
                            </div>
                            <!-- detail shipping -->
                            <div class="col-lg-4 pt-4 pt-lg-0">
                            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                            <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Alamat Pengiriman</b></h1>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"><small><b>Nama Penerima:</b></small> {{$order->recipients_name}}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"><small><b>Handphone:</b></small> {{$order->phone}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label"><small><b>Alamat Lengkap:</b></small> {{$order->address}}</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Pembayaran</b></h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label" for="checkout-ln">Manual Transfer </label>
                                        <img src="http://127.0.0.1:8000/storage/icon-bca.png" width="70" height="35">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                        <label class="form-label" for="checkout-ln"><small><b>No Rek: 6755.224.077<br>An: Erfin Gustaman<br>BCA Cabang Jati Asih</b></small></label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pt-4 pt-lg-0">
                                <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                                    <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Detail Pembayaran Anda</b></h1>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Pemilik Rekening (Anda)</label>
                                                <input type="text" class="form-control @error('senders_account') is-invalid @enderror" name="senders_account" value="{{ old('senders_account', $order->recipients_name)}}">
                                                @error('senders_account')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Transfer Dari Bank</label>
                                                <input type="text" class="form-control @error('bank_name') is-invalid @enderror" name="bank_name" value="{{old('bank_name')}}">
                                                @error('bank_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Jumlah Transfer (Rp)</label>
                                                <input type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{old('amount')}}">
                                                @error('amount')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary d-block w-100 mt-4" type="submit"><i class="ci-loading fs-base me-2"></i>Konfirmasi Pembayaran</button>
                        </div>
                    </div>
                </form>
                @endforeach
              </div>
              
              <!-- Reviews tab-->
              <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="d-md-flex justify-content-between align-items-start pb-4 mb-4 border-bottom">
                  <div class="d-flex align-items-center me-md-3"><img src="http://127.0.0.1:8000/storage/22.jpeg" width="90" alt="Product thumb">
                    <div class="ps-3">
                      <h6 class="fs-base mb-2">Sweater Wanita</h6>
                      <div class="h4 fw-normal text-accent">Rp. 1,900,000</div>
                    </div>
                  </div>
                  <div class="d-flex align-items-center pt-3">
                    <select class="form-select me-2" style="width: 5rem;">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                    <button class="btn btn-primary btn-shadow me-2" type="button"><i class="ci-cart fs-lg me-sm-2"></i><span class="d-none d-sm-inline">Tambah ke Troli</span></button>
                    <!-- <div class="me-2">
                      <button class="btn btn-secondary btn-icon" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Add to Wishlist" aria-label="Add to Wishlist"><i class="ci-heart fs-lg"></i></button>
                    </div>
                    <div>
                      <button class="btn btn-secondary btn-icon" type="button" data-bs-toggle="tooltip" title="" data-bs-original-title="Compare" aria-label="Compare"><i class="ci-compare fs-lg"></i></button>
                    </div> -->
                  </div>
                </div>
                <!-- Reviews-->
              </div>
            </div>
          </div>
        </div>
</div>
@endsection