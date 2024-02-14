<!doctype html>
<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale()=='ar'?'rtl':''}}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{asset('assets/images/favicon-32x32.png')}}" type="image/png" />
    <!--plugins-->
    <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
     @if(app()->getLocale()=='ar')
        <link href="{{asset('assets/css/pace.min-rtl.css')}}" rel="stylesheet" />
        <script src="{{asset('assets/js/pace.min.js')}}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{asset('assets/css/bootstrap.min-rtl.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/bootstrap-extended-rtl.css')}}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <link href="{{asset('assets/css/app-rtl.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/icons-rtl.css')}}" rel="stylesheet" />
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/dark-theme-rtl.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/semi-dark-rtl.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/header-colors-rtl.css')}}" />
    @else
        <!-- loader-->
         <link href="{{asset('assets/css/pace.min-ltr.css')}}" rel="stylesheet" />
        <script src="{{asset('assets/js/pace.min.js')}}"></script>
        <!-- Bootstrap CSS -->
        <link href="{{asset('assets/css/bootstrap.min-ltr.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/bootstrap-extended-ltr.css')}}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <link href="{{asset('assets/css/app-ltr.css')}}" rel="stylesheet" />
        <link href="{{asset('assets/css/icons-ltr.css')}}" rel="stylesheet" />
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/dark-theme-ltr.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/semi-dark-ltr.css')}}" />
        <link rel="stylesheet" href="{{asset('assets/css/header-colors-ltr.css')}}" />
    @endif
    {{-- Toster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
          integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{trans('login.login')}}</title>
</head>

<body class="bg-login" style="display: flex;
    align-items: center;
    height: 100vh;">
<!--wrapper-->
<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="mb-4 text-center">
                        <img src="{{asset('assets/images/logo-img.png')}}" width="180" alt="" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="form-body">
                                    <form class="row g-3" method="POST" action="{{route('login')}}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputEmailAddress" class="form-label">{{__('login.email')}}</label>
                                            <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="{{__('login.email')}}" value="{{old('email')}}">
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="col-12">
                                            <label for="inputChoosePassword" class="form-label">{{__('login.password')}}</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword"  placeholder="{{__('login.password')}}"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>

                                            </div>
                                            @error('password')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div  class="d-flex align-items-center justify-content-center gap-3" >

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type" value="admin" id="admin" checked>
                                                    <label class="form-check-label" for="flexRadioDefault1">{{__('login.admin')}}</label>
                                                </div>


                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="type" value="teacher" id="teacher">
                                                    <label class="form-check-label" for="flexRadioDefault1">{{__('login.teacher')}}</label>
                                                </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" name="remember" value="1" type="checkbox" id="flexSwitchCheckChecked" >
                                                <label class="form-check-label" for="flexSwitchCheckChecked">{{__('login.remember')}}</label>
                                            </div>
                                        </div>


                                        <div class="col-md-6 text-end">	<a href="authentication-forgot-password.html">{{__('login.forget_password')}} ?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i> {{__('login.login')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<!--Password show & hide js -->
<script>
    $(document).ready(function () {
        $("#show_hide_password a").on('click', function (event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });
    });
</script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>





{{-- Toster --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif
@if (session('error'))
    <script>
        toastr.error("{{ session('error') }}");
    </script>
@endif

</body>

</html>
