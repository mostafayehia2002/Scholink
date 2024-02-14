<!DOCTYPE html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()=='ar'?'rtl':''}}">
@include('layouts.head-css')

<body>
    <!--wrapper-->
    <div class="wrapper">
        @include('layouts.sidbar')
        @include('layouts.header')
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('content')
        </div>
        <!--end page wrapper -->
        @include('layouts.footer')
    </div>
    @include('layouts.footer-js')
</body>

</html>
