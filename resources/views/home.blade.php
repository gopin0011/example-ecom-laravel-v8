@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="row">
                    <div id="carouselExampleIndicators" class="carousel slide container" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                            <img src="{{ asset('storage/df39ac71-1b66-49b5-882e-3aab6eaf0dcf.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('storage/df39ac71-1b66-49b5-882e-3aab6eaf0dcf.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                            <img src="{{ asset('storage/df39ac71-1b66-49b5-882e-3aab6eaf0dcf.jpeg') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="card-header">
                    <form method="post" action="{{ route('search') }}">
                    @csrf
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <select class="form-select">
                                    <option>Semua Merk</option>
                                </select>
                            </div> -->

                            <div class="col-md-12">
                                <div class="input-group">
                                    <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" name="key" value="{{$key}}" placeholder="Cari">
                                    <div class="col-sm-4">
                                    <select class="form-select" name="order">
                                        <option value="desc" {{ $order == 'desc' ? 'selected' : '' }}>Harga Tertinggi - Terendah</option>
                                        <option value="asc" {{ $order == 'asc' ? 'selected' : '' }}>Harga Terendah - Tertinggi</option>
                                    </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Go !</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="row">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <!-- List group-->
                                <ul class="list-group shadow">
                                @if(count($products))
                                    @foreach ($products as $product)
                                    <!-- produk -->
                                    <!-- list group item-->
                                    <li class="list-group-item">
                                        <!-- Custom content-->
                                        <a href="{{ route('product', ['product' => $product->id]) }}" class="text-reset">
                                        <div class="media align-items-lg-center flex-column flex-lg-row p-3">
                                            <div class="media-body order-2 order-lg-1">
                                                <h5 class="mt-0 font-weight-bold mb-2">{{ $product->name }}</h5>
                                                <p class="font-italic text-muted mb-0 small">{!! \Illuminate\Support\Str::limit($product->description, 75, $end='...') !!}</p>
                                                <div class="d-flex align-items-center justify-content-between mt-1">
                                                    <h6 class="font-weight-bold my-2">Rp. {{number_format($product->price)}}</h6>
                                                    <ul class="list-inline small">
                                                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                                        <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                                                        <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
                                                    </ul>
                                                </div>
                                            </div><img src="{{ asset('storage/' . $product->thumbnail) }}" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2">
                                        </div> <!-- End -->
                                        </a>
                                    </li> <!-- End -->
                                    <!-- produk -->
                                    @endforeach
                                    @else
                                    <div class="col-md-12">
                                        <div class="container">
                                            <p class="py-2">Produk tidak ditemukan</p>
                                        </div>
                                    </div>
                                    @endif
                                </ul>
                            </div>
                        </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
