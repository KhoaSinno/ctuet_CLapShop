<!DOCTYPE html>
<html lang="vi">

<head>
    @include('admin.head')
    <link rel="stylesheet" type="text/css" href="/e_adminSN/css/style.css">
    <link rel="stylesheet" type="text/css" href="/e_adminSN/css/util.css">
    <link rel="stylesheet" type="text/css" href="/e_adminSN/css/index.css">
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="/e_adminSN/assets/images/team.jpg" alt="IMG">
                </div>
                <div class="login100-form validate-form">
                    <span class="login100-form-title">
                        <b>{{$title}}</b>
                    </span>

                    <form action="{{ route('register.store') }}" method="post">
                        <div class="wrap-input100 validate-input">
                            <label for="username" class="lable-input100">Tên đăng nhập:</label>
                            <input class="input100" type="text" placeholder="Nhập tên tài khoản" name="username"
                                id="username">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input">
                            <label for="password">Mật khẩu:</label>
                            <input autocomplete="off" class="input100" type="password" placeholder="Nhập mật khẩu"
                                name="password" id="password-field">
                            <span class="focus-input100"></span>
                        </div>

                        <div class="wrap-input100 validate-input">
                            <label for="fullname">Họ tên:</label>
                            <input autocomplete="off" class="input100" type="text" placeholder="Nhập họ tên"
                                name="fullname" id="fullname-field">
                            <span class="focus-input100"></span>
                        </div>
                        <!--
                        <div class="wrap-input100 validate-input">
                            <label for="email">Gmail:</label>
                            <input autocomplete="off" class="input100" type="email" placeholder="Nhập gmail"
                                name="email" id="email-field">
                            <span class="focus-input100"></span>
                        </div> -->

                        <div class="wrap-input100 validate-input">
                            <label for="phone">Số điện thoại:</label>
                            <input autocomplete="off" class="input100" type="phone" placeholder="Nhập số điện thoại"
                                name="phone" id="phone-field">
                            <span class="focus-input100"></span>
                        </div>

                        <!-- <div class="wrap-input100 validate-input">
                            <label for="address">Địa chỉ:</label>
                            <input autocomplete="off" class="input100" type="text" placeholder="Nhập địa chỉ"
                                name="address" id="address-field" required>
                            <span class="focus-input100"></span>
                        </div>

                        <label for="gender">Giới tính</label>
                        <select class="input100" name="gender" id="gender-field" required style="opacity: 0.6;">
                            <option value="" disabled selected>Chọn giới tính</option>
                            <option value="Nam">Nam</option>
                            <option value="Nữ">Nữ</option>
                        </select>

                        <div class="wrap-input100 validate-input">
                            <label for="dateOfBirth">Ngày sinh:</label>
                            <input autocomplete="off" class="input100" type="date" style="opacity: 0.6;"
                                placeholder="Chọn ngày sinh" name="dateOfBirth" id="dateOfBirth">
                            <span class="focus-input100"></span>
                        </div> -->

                        <!-- Hiển thị lỗi nếu có -->
                        @if ($errors->any())
                            <div class="alert"
                                style="background-color: red; color: black; padding: 10px; border-radius: 5px; margin-top: 15px;">
                                <strong>Errors:</strong>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <style>
                            .input100::placeholder {
                                color: rgba(0, 0, 0, 0.5);
                            }
                        </style>
                        <div class="container-login100-form-btn">
                            <button type="submit" class="btn btn-info w-100 custom-btn-size">Đăng kí</button>
                        </div>

                        <div class="container-login100-form-btn" style="margin-top: 10px;">
                            <a href="javascript:history.back()" class="btn btn-secondary w-100 custom-btn-size">Trở
                                lại</a>
                        </div>
                        @csrf
                    </form>

                    <div class="text-center p-t-70 txt2 d-flex flex-col">
                        <span>Phần mềm quản lý bán hàng ClapShop</span>
                        <div>
                            <i class="far fa-copyright" aria-hidden="true"></i>
                            <script type="text/javascript">
                                document.write(new Date().getFullYear());
                            </script>
                            <a class="txt2" href="#"> ClapShop Team </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.footer')
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>