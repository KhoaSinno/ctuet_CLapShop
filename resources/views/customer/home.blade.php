@extends('customer.main_layout')

@section('title', $title)

@section('background_home')
<div class="hero__item set-bg" data-setbg="/e_customerSN/img/hero/banner2.png">
    <div class="hero__text">
        <span>LAPTOP SALE</span>
        <h2>Hiệu năng đỉnh cao <br />Giá cả hợp lý</h2>
        <p>Giao hàng miễn phí toàn quốc</p>
        <a href="{{route('customer.products')}}" class="primary-btn">SHOP NOW</a>
    </div>
</div>
@endsection

@section('content')

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">
                @foreach($categories as $category)
                    <a href="{{ route('customer.products.by_slug', $category->slug) }}">
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ $category->mainImage() }}">

                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Mới nhất</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">Tất cả</li>
                        @foreach($categories as $category)
                            <li data-filter=".{{ strtolower($category->name) }}">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            @foreach($latestProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix {{ strtolower($product->category->name) }}">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg"
                            data-setbg="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset('storage/images/default.jpg') }}">
                            <ul class="featured__item__pic__hover">
                                <!-- <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li> -->
                                <li><a href="#" class="add-to-cart" data-id="{{ $product->id }}"><i
                                            class=" fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{route('customer.product.detail', $product->id) }}">{{ $product->name }}</a></h6>
                            <h5>{{ format_currencyVNĐ($product->price)}}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="latest-product__text">
                    <h4>Laptop bán chạy nhất</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach($bestSellingProducts->chunk(2) as $chunk)
                            <div class="latest-prdouct__slider__item">
                                @foreach($chunk as $product)
                                    <a href="{{route('customer.product.detail', $product->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset('storage/images/default.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <span>{{ format_currencyVNĐ($product->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="latest-product__text">
                    <h4>Xem thêm</h4>
                    <div class="latest-product__slider owl-carousel">
                        @foreach($latestProducts->chunk(3) as $chunk)
                            <div class="latest-prdouct__slider__item">
                                @foreach($chunk as $product)
                                    <a href="{{route('customer.product.detail', $product->id) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img src="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset('storage/images/default.jpg') }}"
                                                alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{ $product->name }}</h6>
                                            <span>{{ format_currencyVNĐ($product->price) }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('footer')
@endsection