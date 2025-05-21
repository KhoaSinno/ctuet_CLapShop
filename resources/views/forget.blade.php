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
                    <form action="{{ route('forget.forget') }}" method="post">
                        @include('admin.alert')
                        <div class="wrap-input100 validate-input">
                            <input class="input100" type="text" placeholder="Nhập email bạn đăng ký" name="email"
                                id="username">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-user'></i>
                            </span>
                        </div>
                        <!-- <div class="wrap-input100 validate-input">
                            <input autocomplete="off" class="input100" type="password" placeholder="Mật khẩu"
                                name="password" id="password-field">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
                                <i class='bx bx-key'></i>
                            </span>
                        </div> -->
                        <!-- <div class="wrap-input100 form-check validate-input d-flex justify-center align-items-center">
                            <input class="form-check-input mt-2" type="checkbox" name="remember" id="remember"
                                style="width: 20px;">
                            <label class="form-check-label pl-3" for="remember">
                                Remember me
                            </label>
                        </div> -->
                        <div class="container-login100-form-btn">
                            <button type="submit" class="btn btn-info w-100 custom-btn-size">Gửi email</button>
                        </div>

                        <div class="container-login100-form-btn mt-2">
                            <a href="javascript:history.back()" class="btn btn-secondary w-100 custom-btn-size">Trở
                                lại</a>
                        </div>

                        <div class="text-right p-t-12">
                            <a class="txt2" href="{{route('forget')}}">
                                Bạn quên mật khẩu?
                            </a>
                        </div>
                        @csrf
                    </form>

                    <div class="text-center p-t-12">
                        Bạn chưa có tài khoản?
                        <a class="txt2" href="{{route('register')}}">
                            Đăng ký ngay!
                        </a>
                    </div>

                    <div class="text-center p-t-70 txt2 d-flex flex-col">
                        <span>Phần mềm quản lý bán hàng ClapShop</span>
                        <div>
                            <i class="far fa-copyright" aria-hidden="true"></i>
                            <script type="text/javascript">
                                document.write(new Date().getFullYear());
                            </script>
                            <a class="txt2" href="#"> Five Hero Team </a>
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