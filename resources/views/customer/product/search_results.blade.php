@extends('customer.main_layout')

@section('content')
<!-- Product Section Begin -->
<section class="product spad p-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Danh mục</h4>
                        <ul>
                            <li><a href="{{route('customer.products')}}">Tất cả sản phẩm</a></li>
                            @foreach ($categories as $category)
                            <li>
                                <a
                                    href="{{ route('customer.products.by_slug', $category->slug) }}"
                                    class="{{ request()->is('customer/products/' . $category->slug) ? 'text-primary text-bold' : '' }}">{{$category->name}}</a>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Giá</h4>
                        <form id="priceFilterForm" action="{{ route('customer.product.filter') }}" method="get">
                            <div class="list-group">
                                <label class="border-0 list-group-item d-flex justify-content-between align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="price_range" value="lower_15"
                                        onclick="submitPriceFilter()"
                                        {{ request('price_range') == 'lower_15' ? 'checked' : '' }}>
                                    Nhỏ hơn 15 Triệu
                                </label>

                                <label class="border-0 list-group-item d-flex justify-content-between align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="price_range" value="greater_15"
                                        onclick="submitPriceFilter()"
                                        {{ request('price_range') == 'greater_15' ? 'checked' : '' }}>
                                    Lớn hơn 15 Triệu
                                </label>

                                <label class="border-0 list-group-item d-flex justify-content-between align-items-center">
                                    <input class="form-check-input me-2" type="radio" name="price_range" value="casual"
                                        onclick="submitPriceFilter()"
                                        {{ request('price_range') == 'casual' ? 'checked' : '' }}>
                                    Bất kì giá nào
                                </label>
                            </div>
                        </form>

                        <script>
                            function submitPriceFilter() {
                                document.getElementById('priceFilterForm').submit();
                            }
                        </script>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="filter__item">
                    <div class="row">
                        <div class="col-6">
                            <form action="{{ route('customer.products') }}" method="GET" class="filter__sort">
                                <span>Sắp xếp</span>
                                <select id="sort" name="sort" onchange="this.form.submit()">
                                    <option value="default" {{ $sort == 'default' ? 'selected' : '' }}>Mặc định</option>
                                    <option value="asc" {{ $sort == 'asc' ? 'selected' : '' }}>Giá tăng dần</option>
                                    <option value="desc" {{ $sort == 'desc' ? 'selected' : '' }}>Giá giảm dần</option>
                                </select>
                            </form>
                        </div>
                        <div class="col-6">
                            <div class="filter__found">
                                <h6><span>{{$count}}</span> sản phẩm</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6" @if ($product->price < 15000000)
                            id="lower_20"
                            @else
                            id="greater_20"
                            @endif>
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ $product->mainImage ? asset($product->mainImage->image_url) : asset('storage/images/default.jpg') }}">
                                    <ul class="product__item__pic__hover">
                                        <li>
                                            <a href="#" class="add-to-cart" data-id="{{ $product->id }}">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>
                                        <a href="{{route('customer.product.detail', $product->id) }}">{{$product->name}}</a>
                                    </h6>
                                    <h5>{{format_currencyVNĐ( $product->price)}}</h5>
                                </div>
                            </div>
                    </div>
                    @endforeach

                </div>
                <div class="d-flex justify-content-center align-items-center">
                    {{ $products->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->


@endsection


@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function showSelectedPrice() {
        const radios = document.getElementsByName('price_range');
        let products;
        for (let i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                // document.getElementById('result').textContent = radios[i].value;
                // console.log(radios[i].value);
                if (radios[i].value == "greater_15") {
                    console.log(10);
                    products = document.querySelectorAll('#greater_20');
                    products.forEach(product => {
                        product.style.display = 'inline';
                    });
                    products = document.querySelectorAll('#lower_20');
                    products.forEach(product => {
                        product.style.display = 'none';
                    });
                    break;
                } else if (radios[i].value == "lower_15") {
                    console.log(20);
                    products = document.querySelectorAll('#lower_20');
                    products.forEach(product => {
                        product.style.display = 'block';
                    });
                    products = document.querySelectorAll('#greater_20');
                    products.forEach(product => {
                        product.style.display = 'none';
                    });
                    break;
                } else {
                    products = document.querySelectorAll('#lower_20');
                    products.forEach(product => {
                        product.style.display = 'block';
                    });
                    products = document.querySelectorAll('#greater_20');
                    products.forEach(product => {
                        product.style.display = 'inline';
                    });
                }
                break;

            }
        }
    }

    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');

        $.ajax({
            url: `/customer/cart/add/${productId}`,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                // alert('Sản phẩm đã được thêm vào giỏ hàng!');
                swal({
                    title: "Sản phẩm đã được thêm vào giỏ hàng!",
                    icon: "success",
                    button: "OK",
                });
                // Cập nhật tổng tiền ngay lập tức
                $('.header__cart__price span').text('$' + response.total.toFixed(2));
                $('.span__quantity_cart').text(response.totalQuantity);
            },
            error: function(xhr) {
                // alert('Đã xảy ra lỗi. Vui lòng thử lại!');
            }
        });
    });
</script>

@endsection