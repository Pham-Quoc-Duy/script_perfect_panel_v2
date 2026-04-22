@include('clients.theme-3.layouts.header')
@include('clients.theme-3.layouts.sidebar')
<div class="wrapper-content">
    <div class="wrapper-content__header">
    </div>
    <div class="wrapper-content__body">
        @yield('content')
    </div>
    @include('clients.theme-3.layouts.footer')
