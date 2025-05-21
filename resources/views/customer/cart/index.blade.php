@extends('customer.main_layout')

<!-- Breadcrumb Section Begin -->
@section('breadcrumb')
<section class="breadcrumb-section set-bg" data-setbg="/e_customerSN/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="{{ route('customer.home') }}">Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
<!-- Breadcrumb Section End -->

@section('content')
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Ảnh</th>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tổng cộng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(session('cart'))
                            @foreach($cart as $id => $details)
                            <tr>
                                <td class="shoping__cart__item" style="width: 200px;">
                                    <img src="{{ $details['image'] ?? asset('storage/images/default.jpg') }}" alt="{{ $details['name'] }}" style="width: 100px; height: auto;">
                                </td>
                                <td class="shoping__cart__item" style="width: 300px;">
                                    <h5>{{ $details['name'] }}</h5>
                                </td>
                                <td class="shoping__cart__price" style="width: 135px;">
                                    {{ format_currencyVNĐ($details['price']) }}
                                </td>
                                <td class=" h-20">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input disabled type="number" class="quantity-input" data-id="{{ $id }}" value="{{ $details['quantity'] }}" min="1">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total" id="product-total-{{ $id }}" style="width: 135px;">
                                    {{ format_currencyVNĐ($details['price'] * $details['quantity']) }}
                                </td>
                                <td>
                                    <form action="{{ route('customer.cart.remove', ['id' => $id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Xóa</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="5">Giỏ hàng của bạn đang trống.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="{{route('customer.products')}}" class="primary-btn cart-btn">Tiếp tục mua sắm</a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Tổng giỏ hàng</h5>
                    <ul>
                        <li>Tổng giá (đã tính VAT): <span id="cart-total">{{ $cartTotal}}</span></li>
                    </ul>
                    @if(session()->has('cart') && count(session('cart')) > 0)
                    <a href="{{ route('customer.checkout') }}" class="primary-btn w-100">Tiến hành thanh toán</a>
                    @else
                    <button class="btn btn-block w-100" disabled>Không có sản phẩm trong giỏ hàng</button>
                    @endif

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section End -->


@endsection


@section('footer')
<script src="/e_customerSN/js/incQuantitySession.js"></script>



<script>
    $('.pro-qty input').on('change', function() {
        var id = $(this).data('id'); // Giả sử mỗi input có data-id để xác định sản phẩm
        var quantity = $(this).val();

        $.ajax({
            url: `{{ route('customer.cart.update') }}`, // Đường dẫn cập nhật giỏ hàng
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: id,
                quantity: quantity
            },
            success: function(response) {
                // Cập nhật tổng giá của sản phẩm và giỏ hàng
                $('#product-total-' + id).text(response.productTotal);
                $('#cart-total').text(response.cartTotal);
                $('.span__quantity_cart').text(response.totalQuantity);
                $('.header__cart__price').html("Tổng tiền: <span>" + response.total + "</span>");

            },
            error: function(xhr) {
                if (xhr.status === 400 && xhr.responseJSON && xhr.responseJSON.error) {
                    // Hiển thị thông báo lỗi nếu có lỗi từ server
                    swal({
                        title: xhr.responseJSON.error,
                        text: "Lỗi khi tăng số lượng sản phẩm",
                        icon: "error",
                        button: "OK",
                    });
                } else {
                    // Hiển thị thông báo lỗi chung
                    swal({
                        title: "Đã xảy ra lỗi!",
                        text: "Vui lòng thử lại.",
                        icon: "error",
                        button: "OK",
                    });
                }
            }
        });
    });
</script>

@endsection