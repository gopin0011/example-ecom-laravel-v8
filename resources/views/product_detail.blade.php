@extends('layouts.app')
@section('content')
<style>
.carousel {
  position: relative;
}
.carousel-item img {
  object-fit: cover;
}
#carousel-thumbs {
  background: rgba(255,255,255,.3);
  bottom: 0;
  left: 0;
  padding: 0 50px;
  right: 0;
}
#carousel-thumbs img {
  border: 5px solid transparent;
  cursor: pointer;
}
#carousel-thumbs img:hover {
  border-color: rgba(255,255,255,.3);
}
#carousel-thumbs .selected img {
  border-color: #fff;
}
.carousel-control-prev,
.carousel-control-next {
  width: 50px;
}
@media all and (max-width: 767px) {
  .carousel-container #carousel-thumbs img {
    border-width: 3px;
  }
}
@media all and (min-width: 576px) {
  .carousel-container #carousel-thumbs {
    position: absolute;
  }
}
@media all and (max-width: 576px) {
  .carousel-container #carousel-thumbs {
    background: #ccccce;
  }
}
</style>
<div class="container">
    <div class="bg-light shadow-lg rounded-3">
    {{ Breadcrumbs::render('product', $product) }}
    </div>
        <div style="margin-top:20px;"></div>
        <div class="bg-light shadow-lg rounded-3">
          <!-- Tabs-->
          <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item"><a class="nav-link py-4 px-sm-4 active" href="#general" data-bs-toggle="tab" role="tab" aria-selected="true">Detail Produk</a></li>
            <!-- <li class="nav-item"><a class="nav-link py-4 px-sm-4" href="#reviews" data-bs-toggle="tab" role="tab" aria-selected="false">Diskusi <span class="fs-sm opacity-60">(74)</span></a></li> -->
          </ul>
          <div class="px-4 pt-lg-3 pb-3 mb-5">
            <div class="tab-content px-lg-3">
              <!-- General info tab-->
              <div class="tab-pane fade active show" id="general" role="tabpanel">
                <div class="row">
                  <div class="col-sm-8">
                    <div class="row">
                      <div class="container">
                        <div class="carousel-container position-relative row">
                          
                        <!-- Sorry! Lightbox doesn't work - yet. -->
                          
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                          @foreach($images as $key => $slider)
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}" data-slide-number="{{$key}}">
                              <img src="{{ asset('storage/' . $slider->url) }}" class="d-block w-100" alt="..." data-type="image" data-toggle="lightbox" data-gallery="example-gallery">
                            </div>
                          @endforeach
                          </div>
                        </div>

                        <!-- Carousel Navigation -->
                        <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <div class="row mx-0">
                              @foreach($images as $key => $slider)
                                <div id="carousel-selector-{{$key}}" class="thumb col-4 col-sm-3 px-1 py-3 {{$key == 0 ? 'selected' : '' }}" data-target="#myCarousel" data-slide-to="{{$key}}">
                                  <img src="{{ asset('storage/' . $slider->url) }}" class="img-fluid" alt="...">
                                </div>
                              @endforeach
                              </div>
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>

                        </div> <!-- /row -->
                      </div> <!-- /container -->
                    </div>
                    <div class="row">
                      <!-- product desc -->
                      <div class="pt-lg-3 pb-4 pb-sm-5">
                          <h2 class="h3 pb-2">{{ $product->name }}</h2>
                          {!! $product->description !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <!-- product price -->
                    <div class="product-details ms-auto pb-3">
                      <div class="h5 fw-normal text-accent mb-3 me-1">{{$product->name}}</div>
                      <div class="h3 fw-normal text-accent mb-3 me-1">Rp. {{number_format($product->price)}}</div>
                      <div class="position-relative me-n4 mb-3">
                        <div class="product-badge product-available mt-n1"><i class="ci-security-check"></i>{{$product->is_available == 1 ? 'Produk Tersedia' : 'Produk Tidak Tersedia'}}</div>
                      </div>
                      <div class="d-flex align-items-center pt-2 pb-4">
                        <form method="POST" action="{{ route('productAdd', ['id' => $product->id]) }}">
                        @csrf
                            <div class="d-flex align-items-center pt-2 pb-4">
                                <select class="form-select me-3" style="width: 5rem;" name="qty">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <button class="btn btn-primary d-block w-100 float-end" type="submit" {{$product->is_available == 1 ? '':'disabled'}}>+ Troli</button>
                            </div>
                        </form>
                      </div>
                      
                      <!-- <div class="d-flex mb-4">
                        <div class="w-100">
                          <button class="btn btn-secondary d-block w-100" type="button"><i class="ci-heart fs-lg me-2"></i><span class="d-none d-sm-inline">Simpan ke </span>Wishlist</button>
                        </div>
                      </div> -->
                      <!-- Product panels-->
                      <div class="accordion mb-4" id="productPanels">
                        <div class="accordion-item">
                          <h3 class="accordion-header"><a class="accordion-button" href="#shippingOptions" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="shippingOptions"><i class="ci-delivery text-muted lead align-middle mt-n1 me-2"></i>Biaya Ongkos Kirim</a></h3>
                          <div class="accordion-collapse collapse show" id="shippingOptions" data-bs-parent="#productPanels">
                            <div class="accordion-body fs-sm">
                              <div class="d-flex justify-content-between border-bottom pb-2">
                                <div>
                                  <div class="fw-semibold text-dark">Jawa Barat</div>
                                  <div class="fs-sm text-muted">2 - 6 hari</div>
                                </div>
                                <div>Rp. {{number_format('20000')}}</div>
                              </div>
                              <div class="d-flex justify-content-between border-bottom py-2">
                                <div>
                                  <div class="fw-semibold text-dark">Selain Jawa Barat</div>
                                  <div class="fs-sm text-muted">> 7 hari</div>
                                </div>
                                <div>Rp. {{number_format('40000')}}</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- <div class="accordion-item">
                          <h3 class="accordion-header"><a class="accordion-button collapsed" href="#localStore" role="button" data-bs-toggle="collapse" aria-expanded="true" aria-controls="localStore"><i class="ci-location text-muted fs-lg align-middle mt-n1 me-2"></i>Find in local store</a></h3>
                          <div class="accordion-collapse collapse" id="localStore" data-bs-parent="#productPanels">
                            <div class="accordion-body">
                              <select class="form-select">
                                <option value="">Select your country</option>
                                <option value="Argentina">Argentina</option>
                                <option value="Belgium">Belgium</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="Spain">Spain</option>
                                <option value="UK">United Kingdom</option>
                                <option value="USA">USA</option>
                              </select>
                            </div>
                          </div>
                        </div> -->
                      </div>
                      <!-- Sharing-->
                      <!-- <label class="form-label d-inline-block align-middle my-2 me-3">Share:</label><a class="btn-share btn-twitter me-2 my-2" href="#"><i class="ci-twitter"></i>Twitter</a><a class="btn-share btn-instagram me-2 my-2" href="#"><i class="ci-instagram"></i>Instagram</a><a class="btn-share btn-facebook my-2" href="#"><i class="ci-facebook"></i>Facebook</a> -->
                    </div>
                  </div>
                </div>
              </div>
              
              <!-- Reviews tab-->
              <div class="tab-pane fade" id="reviews" role="tabpanel">
                <div class="d-md-flex justify-content-between align-items-start pb-4 mb-4 border-bottom">
                  <div class="d-flex align-items-center me-md-3"><img src="{{ asset('storage/' . $product->thumbnail) }}" width="90" alt="Product thumb">
                    <div class="ps-3">
                      <h6 class="fs-base mb-2">{{ $product->name }}</h6>
                      <div class="h4 fw-normal text-accent">Rp. {{number_format($product->price)}}</div>
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
                <div class="row py-4">
                  <!-- Reviews list-->
                  <div class="col-md-7">
                    <div class="d-flex justify-content-end pb-4">
                      <div class="d-flex flex-nowrap align-items-center">
                        <label class="fs-sm text-muted text-nowrap me-2 d-none d-sm-block" for="sort-reviews">Sort by:</label>
                        <select class="form-select form-select-sm" id="sort-reviews">
                          <option>Newest</option>
                          <option>Oldest</option>
                          <option>Popular</option>
                          <option>High rating</option>
                          <option>Low rating</option>
                        </select>
                      </div>
                    </div>
                    <!-- Review-->
                    <div class="product-review pb-4 mb-4 border-bottom">
                      <div class="d-flex mb-3">
                        <div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/01.jpg" width="50" alt="Rafael Marquez">
                          <div class="ps-3">
                            <h6 class="fs-sm mb-0">Rafael Marquez</h6><span class="fs-ms text-muted">June 28, 2019</span>
                          </div>
                        </div>
                        <div>
                          <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i>
                          </div>
                          <div class="fs-ms text-muted">83% of users found this review helpful</div>
                        </div>
                      </div>
                      <p class="fs-md mb-2">Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est...</p>
                      <ul class="list-unstyled fs-ms pt-1">
                        <li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
                        <li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
                      </ul>
                      <div class="text-nowrap">
                        <button class="btn-like" type="button">15</button>
                        <button class="btn-dislike" type="button">3</button>
                      </div>
                    </div>
                    <!-- Review-->
                    <div class="product-review pb-4 mb-4 border-bottom">
                      <div class="d-flex mb-3">
                        <div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/02.jpg" width="50" alt="Barbara Palson">
                          <div class="ps-3">
                            <h6 class="fs-sm mb-0">Barbara Palson</h6><span class="fs-ms text-muted">May 17, 2019</span>
                          </div>
                        </div>
                        <div>
                          <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i>
                          </div>
                          <div class="fs-ms text-muted">99% of users found this review helpful</div>
                        </div>
                      </div>
                      <p class="fs-md mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                      <ul class="list-unstyled fs-ms pt-1">
                        <li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi, tempora</li>
                        <li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae, quis autem</li>
                      </ul>
                      <div class="text-nowrap">
                        <button class="btn-like" type="button">34</button>
                        <button class="btn-dislike" type="button">1</button>
                      </div>
                    </div>
                    <!-- Review-->
                    <div class="product-review pb-4 mb-4 border-bottom">
                      <div class="d-flex mb-3">
                        <div class="d-flex align-items-center me-4 pe-2"><img class="rounded-circle" src="img/shop/reviews/03.jpg" width="50" alt="Daniel Adams">
                          <div class="ps-3">
                            <h6 class="fs-sm mb-0">Daniel Adams</h6><span class="fs-ms text-muted">May 8, 2019</span>
                          </div>
                        </div>
                        <div>
                          <div class="star-rating"><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star-filled active"></i><i class="star-rating-icon ci-star"></i><i class="star-rating-icon ci-star"></i>
                          </div>
                          <div class="fs-ms text-muted">75% of users found this review helpful</div>
                        </div>
                      </div>
                      <p class="fs-md mb-2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.</p>
                      <ul class="list-unstyled fs-ms pt-1">
                        <li class="mb-1"><span class="fw-medium">Pros:&nbsp;</span>Consequuntur magni, voluptatem sequi</li>
                        <li class="mb-1"><span class="fw-medium">Cons:&nbsp;</span>Architecto beatae,  quis autem, voluptatem sequ</li>
                      </ul>
                      <div class="text-nowrap">
                        <button class="btn-like" type="button">26</button>
                        <button class="btn-dislike" type="button">9</button>
                      </div>
                    </div>
                    <div class="text-center">
                      <button class="btn btn-outline-accent" type="button"><i class="ci-reload me-2"></i>Load more reviews</button>
                    </div>
                  </div>
                  <!-- Leave review form-->
                  <div class="col-md-5 mt-2 pt-4 mt-md-0 pt-md-0">
                    <div class="bg-secondary py-grid-gutter px-grid-gutter rounded-3">
                      <h3 class="h4 pb-2">Write a review</h3>
                      <form class="needs-validation" method="post" novalidate="">
                        <div class="mb-3">
                          <label class="form-label" for="review-name">Your name<span class="text-danger">*</span></label>
                          <input class="form-control" type="text" required="" id="review-name">
                          <div class="invalid-feedback">Please enter your name!</div><small class="form-text text-muted">Will be displayed on the comment.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-email">Your email<span class="text-danger">*</span></label>
                          <input class="form-control" type="email" required="" id="review-email">
                          <div class="invalid-feedback">Please provide valid email address!</div><small class="form-text text-muted">Authentication only - we won't spam you.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-rating">Rating<span class="text-danger">*</span></label>
                          <select class="form-select" required="" id="review-rating">
                            <option value="">Choose rating</option>
                            <option value="5">5 stars</option>
                            <option value="4">4 stars</option>
                            <option value="3">3 stars</option>
                            <option value="2">2 stars</option>
                            <option value="1">1 star</option>
                          </select>
                          <div class="invalid-feedback">Please choose rating!</div>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-text">Review<span class="text-danger">*</span></label>
                          <textarea class="form-control" rows="6" required="" id="review-text"></textarea>
                          <div class="invalid-feedback">Please write a review!</div><small class="form-text text-muted">Your review must be at least 50 characters.</small>
                        </div>
                        <div class="mb-3">
                          <label class="form-label" for="review-pros">Pros</label>
                          <textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-pros"></textarea>
                        </div>
                        <div class="mb-4">
                          <label class="form-label" for="review-cons">Cons</label>
                          <textarea class="form-control" rows="2" placeholder="Separated by commas" id="review-cons"></textarea>
                        </div>
                        <button class="btn btn-primary btn-shadow d-block w-100" type="submit">Submit a Review</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('js')
<script>
$('#myCarousel').carousel({
  interval: false
});
$('#carousel-thumbs').carousel({
  interval: false
});

// handles the carousel thumbnails
// https://stackoverflow.com/questions/25752187/bootstrap-carousel-with-thumbnails-multiple-carousel
$('[id^=carousel-selector-]').click(function() {
  var id_selector = $(this).attr('id');
  var id = parseInt( id_selector.substr(id_selector.lastIndexOf('-') + 1) );
  $('#myCarousel').carousel(id);
});
// Only display 3 items in nav on mobile.
if ($(window).width() < 575) {
  $('#carousel-thumbs .row div:nth-child(4)').each(function() {
    var rowBoundary = $(this);
    $('<div class="row mx-0">').insertAfter(rowBoundary.parent()).append(rowBoundary.nextAll().addBack());
  });
  $('#carousel-thumbs .carousel-item .row:nth-child(even)').each(function() {
    var boundary = $(this);
    $('<div class="carousel-item">').insertAfter(boundary.parent()).append(boundary.nextAll().addBack());
  });
}
// Hide slide arrows if too few items.
if ($('#carousel-thumbs .carousel-item').length < 2) {
  $('#carousel-thumbs [class^=carousel-control-]').remove();
  $('.machine-carousel-container #carousel-thumbs').css('padding','0 5px');
}
// when the carousel slides, auto update
$('#myCarousel').on('slide.bs.carousel', function(e) {
  var id = parseInt( $(e.relatedTarget).attr('data-slide-number') );
  $('[id^=carousel-selector-]').removeClass('selected');
  $('[id=carousel-selector-'+id+']').addClass('selected');
});
// when user swipes, go next or previous
$('#myCarousel').swipe({
  fallbackToMouseEvents: true,
  swipeLeft: function(e) {
    $('#myCarousel').carousel('next');
  },
  swipeRight: function(e) {
    $('#myCarousel').carousel('prev');
  },
  allowPageScroll: 'vertical',
  preventDefaultEvents: false,
  threshold: 75
});
/*
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
*/

$('#myCarousel .carousel-item img').on('click', function(e) {
  var src = $(e.target).attr('data-remote');
  if (src) $(this).ekkoLightbox();
});
</script>
@endsection