@extends('customer.main_layout')

@section('content')

<div class="container">
    <h2 class="text-center mb-4">Thông tin tài khoản</h2>
    <form class="mb-4" action="{{ route('customer.profile.update') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Tên tài khoản -->
            <div class="form-group col-3">
                <label for="username">Tên tài khoản:</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="{{ auth()->user()->username }}" readonly>
            </div>

            <!-- Họ tên -->
            <div class="form-group col-5">
                <label for="name">Họ và tên:</label>
                <input type="text" class="form-control" id="fullname" name="fullname"
                    value="{{  auth()->user()->fullname }}">
            </div>

            <!-- Email -->
            <div class="form-group col-4">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
            </div>

            <!-- Số điện thoại -->
            <div class="form-group col-3">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
            </div>

            <!-- Địa chỉ -->
            <div class="form-group col-5">
                <label for="address">Địa chỉ:</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="{{ auth()->user()->address }}">
            </div>

            <!-- Giới tính -->
            <div class="form-group d-flex align-items-start flex-column col-2">
                <label for="gender" class="mr-2">Giới tính:</label>
                <select class="form-control form-select-sm text-center w-100" id="gender" name="gender">
                    <option value="Nam" {{ auth()->user()->gender == 'Nam' ? 'selected' : '' }}>Nam</option>
                    <option value="Nữ" {{ auth()->user()->gender == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                </select>
            </div>

            <!-- Ngày sinh -->
            <div class="form-group col-2">
                <label for="dateOfBirth">Ngày sinh:</label>
                <input type="date" class="form-control" id="dateOfBirth" name="dateOfBirth"
                    value="{{ auth()->user()->dateOfBirth }}">
            </div>

            <div class="form-group col-6">
                <label for="password">Mật khẩu mới:</label>
                <input type="password" class="form-control" id="newPassword" name="password"
                    placeholder="Nhập mật khẩu mới" oninput="validatePasswords()">
                <span id="newPasswordError" class="text-danger"></span>
            </div>
            <div class="form-group col-6">
                <label for="password_confirmation">Xác nhận mật khẩu:</label>
                <input type="password" class="form-control" id="confirmNewPassword" name="password_confirmation"
                    placeholder="Xác nhận mật khẩu mới" oninput="validatePasswords()">
                <span id="confirmPasswordError" class="text-danger"></span>
            </div>

        </div>
        <!-- Nút cập nhật -->
        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <!-- doi mat khau -->
    </form>
</div>
<script>
    function validatePasswords() {
        const newPassword = document.getElementById('newPassword').value;
        const confirmNewPassword = document.getElementById('confirmNewPassword').value;

        const newPasswordError = document.getElementById('newPasswordError');
        const confirmPasswordError = document.getElementById('confirmPasswordError');

        // Kiểm tra nếu mật khẩu xác nhận không khớp
        if (newPassword !== confirmNewPassword) {
            confirmPasswordError.textContent = 'Mật khẩu mới và xác nhận mật khẩu không khớp!';
        } else {
            confirmPasswordError.textContent = ''; // Xóa thông báo lỗi nếu khớp
        }

        // (Optional) Bạn có thể kiểm tra thêm các điều kiện khác, ví dụ độ dài mật khẩu
        if (newPassword.length < 6) {
            newPasswordError.textContent = 'Mật khẩu phải có ít nhất 6 ký tự!';
        } else {
            newPasswordError.textContent = '';
        }
    }
</script>


@endsection