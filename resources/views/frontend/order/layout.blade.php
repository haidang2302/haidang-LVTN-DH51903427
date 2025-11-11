<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PHWVB3KB');</script>
<!-- End Google Tag Manager -->
        @include('frontend.component.head')
        <style>
            body {
                background-color: #f5f5f5;
            }

            .profile-section {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
                margin-bottom: 20px;
            }

            .profile-section img {
                border-radius: 50%;
            }

            .profile-section .username {
                font-size: 18px;
                font-weight: bold;
            }

            .profile-section .edit-profile {
                font-size: 14px;
                color: #888;
            }

            .nav-link {
                color: #333;
                font-size: 16px;
            }

            .nav-link.active {
                color: #716DF2;
            }

            .order-section {
                background-color: #fff;
                padding: 20px;
                border-radius: 5px;
            }

            .order-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .order-header .shop-name {
                font-size: 18px;
                font-weight: bold;
            }

            .order-header .btn {
                font-size: 14px;
            }

            .order-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 20px;
            }

            .order-item img {
                width: 100px;
                height: 100px;
                object-fit: cover;
            }

            .order-item .item-details {
                flex-grow: 1;
                margin-left: 20px;
            }

            .order-item .item-details .item-name {
                font-size: 16px;
                font-weight: bold;
            }

            .order-item .item-details .item-category {
                font-size: 14px;
                color: #888;
            }

            .order-item .item-details .item-quantity {
                font-size: 14px;
                color: #888;
            }

            .order-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }

            .order-footer .total-price {
                font-size: 18px;
                font-weight: bold;
                color: #716DF2;
            }

            .order-footer .btn {
                font-size: 14px;
            }

            .status-badge {
                padding: 4px 12px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: bold;
                text-transform: uppercase;
            }

            .status-pending {
                background-color: #fff3cd;
                color: #856404;
            }

            .status-confirmed {
                background-color: #d4edda;
                color: #155724;
            }

            .status-shipping {
                background-color: #cce5ff;
                color: #004085;
            }

            .status-delivered {
                background-color: #d1ecf1;
                color: #0c5460;
            }

            .status-cancelled {
                background-color: #f8d7da;
                color: #721c24;
            }

            .empty-orders {
                text-align: center;
                padding: 50px 20px;
                color: #666;
            }

            .empty-orders i {
                font-size: 48px;
                margin-bottom: 15px;
                color: #ccc;
            }
        </style>
    </head>
    <body>

    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PHWVB3KB"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
        @include('frontend.component.header')

        @yield('content')

        @include('frontend.component.footer')
        @include('frontend.component.script')
    </body>
</html>