<!DOCTYPE html>
<html>

<head>
    @include('backend.dashboard.component.head')

</head>

    <body>
        <div id="wrapper">
            @include('backend.dashboard.component.sidebar')

            <div id="page-wrapper" class="gray-bg">
               @include('backend.dashboard.component.nav')
                @if(isset($template))
                    @include($template)
                @else
                    @yield('content')
                @endif

                @include('backend.dashboard.component.footer')
            </div>
        </div>
        @include('backend.dashboard.component.script')
    </body>
</html>
