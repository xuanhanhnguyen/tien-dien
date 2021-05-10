<form action="{{route('login.post')}}" id="loginForm" method="post">
    {{csrf_field()}}
    <div class="form-group">
        <input type="email" class="form-control mt-0" name="email" placeholder="Nhập email">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu">
    </div>

    <div class="other-actions row">
        <div class="col-6">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe" name="remember">
                <label class="form-check-label" for="rememberMe">Ghi nhớ mật khẩu</label>
            </div>
        </div>
        <div class="col-6 text-right">
            <a href="{{route('forgot-password.index')}}" class="forgot-link">Quên mật khẩu?</a>
        </div>
    </div>
    <button class="btn btn-theme btn-full">Đăng nhập</button>
</form>