@include('clients.theme-default.layouts.header')
@include('clients.theme-default.layouts.navbar')
<div class="wrapper-content">
    <div class="wrapper-content__header">
    </div>
    <div class="wrapper-content__body">
        @yield('content')
    </div>
</div>
@include('clients.theme-default.layouts.footer')
