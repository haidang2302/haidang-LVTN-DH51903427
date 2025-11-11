<aside class="profile-sidebar">
    <div class="aside-task aside-panel">
        <ul class="uk-list uk-clearfix">
            <li><a href="{{ route('customer.profile') }}"><i class="fa fa-user"></i>Tài khoản của tôi</a></li>
            <li><a href="{{ route('customer.password.change') }}"><i class="fa fa-key"></i>Đổi mật khẩu</a></li>
            <li><a href="{{ route('my-order.index') }}"><i class="fa fa-shopping-cart"></i>Đơn hàng của tôi</a></li>
            <li><a href="{{ route('customer.logout') }}"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
        </ul>
    </div>
</aside>