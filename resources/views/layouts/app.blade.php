<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        .main-header {
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            padding: 18px 0 10px 0;
        }
        .main-header .logo {
            height: 60px;
            margin-right: 18px;
        }
        .main-header .search-box {
            max-width: 520px;
            margin: 0 24px;
            flex: 1;
        }
        .main-header .search-form {
            position: relative;
            width: 100%;
            display: flex;
        }
        .main-header .search-input {
            border: 2px solid #7c7cf7;
            border-radius: 30px;
            padding: 10px 18px;
            font-size: 1rem;
            outline: none;
            box-shadow: none;
            flex: 1;
        }
        .main-header .search-btn {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            background: #7c7cf7;
            color: #fff;
            border-radius: 20px;
            border: none;
            padding: 6px 24px;
            font-weight: 500;
            height: 36px;
            transition: background 0.2s;
        }
        .main-header .search-btn:hover {
            background: #5a5ad6;
        }
        .main-header .menu-link {
            color: #7c7cf7;
            font-weight: 500;
            margin: 0 12px;
            text-decoration: none;
        }
        .main-header .menu-link:hover {
            text-decoration: underline;
        }
        .main-header .cart-icon {
            font-size: 1.3rem;
            margin-right: 6px;
        }
        .main-header .user-link {
            color: #333;
            margin-left: 18px;
            text-decoration: none;
        }
        .main-header .user-link:hover {
            color: #7c7cf7;
        }
        .main-navbar {
            background: #7c7cf7;
            padding: 10px 0;
        }
        .main-navbar .nav-link {
            color: #fff;
            font-weight: 500;
            margin-right: 18px;
        }
        .main-navbar .nav-link.active {
            text-decoration: underline;
        }
    </style>
    @stack('styles')
</head>
<body>
    <header class="main-header d-flex align-items-center justify-content-between px-4">
        <div class="d-flex align-items-center w-100" style="justify-content: center;">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo">
            <form class="search-form search-box mx-auto" action="#" method="get" style="flex:1;max-width:520px;">
                <input class="search-input" type="search" placeholder="Nhập từ khóa" aria-label="Tìm kiếm">
                <button class="search-btn" type="submit">Tìm kiếm <span class="bi bi-search"></span></button>
            </form>
        </div>
        <div class="d-flex align-items-center position-absolute end-0 pe-4">
            <a href="{{ url('/login-demo') }}" class="menu-link user-link">Đăng nhập</a>
        </div>
    </header>
    <nav class="main-navbar px-4">
        <div class="d-flex align-items-center" style="gap: 32px;">
            <a href="/danh-muc-san-pham" class="nav-link active">Danh mục sản phẩm</a>
            <a href="/" class="nav-link">Trang chủ</a>
            <a href="#" class="nav-link">Sản phẩm</a>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</body>
</html>
