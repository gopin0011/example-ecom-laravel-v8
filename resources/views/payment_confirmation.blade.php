@extends('layouts.app')
@section('content')
<div class="container">
    <div class="col-md-2">
        <a class="btn btn-warning d-block w-100 mt-4" href="javascript:history.back()"><i class="ci-loading fs-base me-2"></i>Kembali</a>
    </div>
    <div style="margin-top:20px;"></div>
    <div class="bg-light shadow-lg rounded-3">
          <!-- Tabs-->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link py-4 px-sm-4 active" href="#general" data-bs-toggle="tab" role="tab" aria-selected="true">Menunggu Pembayaran</a></li>
            <li class="nav-item"><a class="nav-link py-4 px-sm-4" href="#listOrder" data-bs-toggle="tab" role="tab" aria-selected="false">Pemesanan Saya</a></li>
          </ul>
          <div class="px-4 pt-lg-3 pb-3 mb-5">
            <div class="tab-content px-lg-3">
              <!-- Menunggu pembayaran-->
              <div class="tab-pane fade active show" id="general" role="tabpanel">
                @if (count($pendingPayments))
                @foreach ($pendingPayments as $order)
                    <div style="margin-top:20px;">
                        <div class="row">
                            <div class="col-lg-5 pe-lg-0">
                                <!-- List Order -->
                                <div class="col-lg-7 pe-lg-0">
                                    <div class="py-2 px-xl-2">
                                        <div class="widget mb-3">
                                            <h1 class="widget-title"><b>Order Detail</b></h1>
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
                            </div>
                            <!-- detail shipping -->
                            <div class="col-lg-7 pt-4 pt-lg-0">
                            <div class="bg-white rounded-3 shadow-lg p-4 ms-lg-auto">
                            <h1 class="h6 pt-1 pb-3 mb-3 border-bottom"><b>Alamat Pengiriman</b></h1>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Penerima</label>
                                            <label class="form-control">{{$order->recipients_name}}</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label">No Handphone</label>
                                            <label class="form-control">{{$order->phone}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Lengkap</label>
                                            <label class="form-control">{{$order->address}}</label>
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
                                        <label class="form-label" for="checkout-ln">No Rek: 6755.224.077<br>An: Erfin Gustaman<br>BCA Cabang Jati Asih</label>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <a class="btn btn-primary d-block w-100 mt-4" href="{{ route('payment', ['order' => $order->id]) }}"><i class="ci-loading fs-base me-2"></i>Konfirmasi Pembayaran</a>
                            <div style="margin-top:20px;"></div>
                        </div>
                    </div>
                @endforeach
                @else
                <div class="container">
                    <p class="py-2">Tidak Ada Pemesanan Yang Menunggu Pembayaran</p>
                </div>
                @endif
              </div>
              
              <!-- Reviews tab-->
              <div class="tab-pane fade" id="listOrder" role="tabpanel">
                @if (count($orders))
                  @foreach ($orders as $order)
                  <div class="bg-white rounded-3 shadow-lg">
                    <div class="row g-0">
                      <div class="col-md-8 border-right p-5">
                          <div class="order-details">
                              <div class="d-flex mb-5 flex-column"><span class="font-weight-bold">Status Pemesanan</span> <small class="mt-2">{{ $order->status == '1' ? 'Sedang Di Proses':''}} </small> </div> 
                          </div>
                          <div class="py-2 px-xl-2">
                            @foreach ($order->orderDetail as $product)
                              <div class="widget mb-3">
                                <h1 class="widget-title"><b>Order Detail</b></h1>
                                <div class="d-flex align-items-center pb-2 border-bottom"><a class="d-block flex-shrink-0" href="#"><img src="{{ asset('storage/' . $product->product_thumbnail) }}" width="64" alt="Product"></a>
                                    <div class="ps-2">
                                        <h6 class="widget-product-title"><a href="#">{{$product->product_name}}</a></h6>
                                        <div class="widget-product-meta"><span class="text-accent me-2">Rp. {{number_format($product->product_price)}}</span><span class="text-muted">x {{$product->qty}}</span></div>
                                    </div>
                                </div>
                              </div>
                            @endforeach
                            <ul class="list-unstyled fs-sm pb-2 border-bottom">
                                <li class="d-flex justify-content-between align-items-center"><span class="me-2">Subtotal:</span><span class="text-end" id="subTotal">Rp. {{number_format($order->sub_total)}}</span></li>
                                <li class="d-flex justify-content-between align-items-center"><span class="me-2">Ongkos Kirim:</span><span class="text-end" id="ongkir">Rp. {{number_format($order->delivery_amount)}}</span></li>
                            </ul>
                            <h3 class="fw-normal text-center my-4" id="total">Rp. {{number_format($order->total)}}</h3>
                        </div>
                      </div>
                      <div class="col-md-4 background-muted">
                          <div class="p-3 border-bottom">
                              <div class="mt-3">
                                  <h6 class="mb-0">Tanggal Order: {{$order->created_at}}</h6>
                                  <div style="margin-top: 20px;"></div>
                                  <span class="d-block mb-0">Detail Pengiriman</span>
                              </div>
                          </div>
                          <div class="row g-0 border-bottom">
                              <div class="col-md-12 border-right">
                                  <div class="p-3 d-flexr"> <span>Nama Penerima: {{$order->recipients_name}}</span> </div>
                              </div>
                          </div>
                          <div class="row g-0 border-bottom">
                              <div class="col-md-12">
                                  <div class="p-3 d-flex"> <span>No Handphone: {{$order->phone}}</span> </div>
                              </div>
                          </div>
                          <div class="row g-0 border-bottom">
                              <div class="col-md-12">
                                  <div class="p-3 d-flex"> <span>Alamat Lengkap: {{$order->address}}</span> </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  @endforeach
                @else
                <div class="container">
                    <p class="py-2">Belum Ada Pemesanan</p>
                </div>
                @endif
                </div>
                <!-- Reviews-->
              </div>
            </div>
          </div>
        </div>
</div>
@endsection