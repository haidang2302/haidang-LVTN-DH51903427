@if(session('error'))
    <div style="color:red">{{ session('error') }}</div>
@endif
@if(session('success'))
    <div style="color:green">{{ session('success') }}</div>
@endif
<form method="post" action="/login-demo" style="max-width:320px;margin:40px auto;">
    @csrf
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>
    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
</form>
