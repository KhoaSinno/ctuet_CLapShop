@extends('admin.main_layout')

@section('function_nav')
<div class="col-sm-2">
    <a class="btn btn-add btn-sm" title="Thêm" href="{{ route('admin.product.detail') }}">
        <i class="fas fa-plus"></i>
        Tạo mới sản phẩm
    </a>
</div>
<div class="col-sm-2">
    <a class="btn btn-warning text-black btn-sm" title="Thêm" href="{{ route('admin.product.listDelete') }}">
        <i class="fa fa-lock" aria-hidden="true"></i>
        Sản phẩm ngừng bán
    </a>
</div>
@endsection

@section('content')
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<table class="table table-hover table-bordered js-copytextarea" cellpadding="0" cellspacing="0" border="0"
    id="sampleTable">
    <thead>
        <tr>
            <th width="10">Mã SP</th>
            <th width="300">Tên SP</th>
            <th width="100">Ảnh SP</th>
            <th width="150">Thương hiệu</th>
            <th>Giá</th>
            <th width="50">Tồn kho</th>
            <th>Hoạt động</th>
            <th width="100">Tính năng</th>
        </tr>
    </thead>
    <tbody>

        @foreach($products as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->name }}</td>
            <td>
                @if($p->mainImage)
                <img src="{{ asset($p->mainImage->image_url) }}" alt="Product Image" weight="100" height="100">
                @else
                <!-- <img src="{{ asset('storage/images/default.jpg') }}" alt="No Image Available" weight="100" height="100"> -->
                @endif
            </td>
            <td class="d-flex justify-content-center align-items-center">{{ $p->category->name }}</td>
            <!-- 'cpu', 'ram', 'storage', 'screen_size', 'battery', 'warranty', 'os', 'description' -->
            <td class="text-center">{{ format_currencyVNĐ( $p->price) }}</td>
            <td class="d-flex justify-content-center align-items-center">{{ $p->stock }}</td>
            @if ($p->active)
            <td class="text-center">Còn bán</td>
            @else
            <td class="text-danger text-center">Ngừng bán</td>
            @endif
            <td class="table-td-center">

                <a class="btn btn-add btn-sm" title="Thêm" href="{{ route('admin.product.detail.edit', ['id' => $p->id]) }}">
                    <i class="fas fa-edit"></i>
                </a>
                <form class="d-inline delete-form" action="{{ route('admin.product.delete', ['id' => $p->id]) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="button" class="btn btn-warning btn-sm delete-btn" title="Xóa">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                    </button>
                </form>


            </td>
        </tr>
        @endforeach


    </tbody>
</table>
@endsection

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tất cả các nút xóa
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach((button) => {
            button.addEventListener('click', function(e) {
                const form = this.closest('.delete-form');

                // Sử dụng SweetAlert v1.x để xác nhận
                swal({
                    title: 'Bạn có chắc chắn?',
                    text: "Hành động này không thể hoàn tác!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }, function(isConfirm) {
                    if (isConfirm) {
                        form.submit(); // Gửi form nếu người dùng xác nhận
                    }
                });
            });
        });
    });
</script>

<!-- <script>
    $(document).ready(function() {
        // Khi click vào nút sửa, hiển thị modal với thông tin của khách hàng
        $(".edit").on("click", function() {
            var customerId = $(this).data('id'); // Lấy ID của khách hàng

            // Gọi AJAX để lấy dữ liệu khách hàng theo ID
            $.ajax({
                url: '/admin/customers/' + customerId + '/edit', // Route để lấy dữ liệu khách hàng
                type: 'GET',
                success: function(response) {
                    $('#customerId').val(response.id);
                    $('#fullname').val(response.fullname);
                    $('#address').val(response.address);
                    $('#phone').val(response.phone);
                    $('#email').val(response.email);


                    // Lấy ngày sinh và chuyển đổi sang định dạng yyyy-MM-dd
                    var dob = response.dateOfBirth; // lấy ngày từ server
                    var dateParts = dob.split(" ")[0].split("-"); // chia theo dấu cách để lấy phần ngày, sau đó chia theo "-"

                    // Kiểm tra độ dài mảng
                    if (dateParts.length === 3) {
                        var formattedDate = dateParts[0] + '-' + dateParts[1] + '-' + dateParts[2]; // định dạng lại thành yyyy-MM-dd
                        $('#dateOfBirth').val(formattedDate); // gán giá trị cho input
                    }

                    $('#gender').val(response.gender);
                    // $('#ModalUP').modal('show'); // Hiển thị modal
                },
                error: function(xhr) {
                    alert('Lỗi khi lấy thông tin khách hàng');
                    console.log(xhr.responseText); // Xem phản hồi từ server
                }
            });
        });

        $("#updateCustomerForm").on("submit", function(e) {
            e.preventDefault(); // Ngăn chặn việc gửi form mặc định
            var customerId = $('#customerId').val(); // Lấy ID từ hidden input
            var formData = $(this).serialize(); // Lấy dữ liệu từ form

            $.ajax({
                url: '/admin/customers/' + customerId, // Gọi đúng URL với ID
                type: 'PUT',
                data: formData, // Dữ liệu từ form
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function(response) {
                    // $('#ModalUP').modal('hide');
                    alert('Cập nhật thành công');
                    location.reload(); // Reload trang sau khi cập nhật thành công
                },
                error: function(xhr) {
                    alert('Cập nhật thất bại');
                }
            });
        });

    });
</script> -->