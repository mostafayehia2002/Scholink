<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />

{{--    @vite('resources/js/app.js')--}}

    <!--plugins-->
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />

    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datetimepicker/css/classic.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datetimepicker/css/classic.time.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datetimepicker/css/classic.date.css') }}" rel="stylesheet" />
    <link
        href="{{ asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.min.css') }}"
        rel="stylesheet" />

    <link href="{{ asset('css/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />


    <script src="{{ asset('assets/js/pace.min.js') }}"></script>
    @if (app()->getLocale() == 'ar')
        {{-- Arabic style  --}}
        <!-- loader-->
        <link href="{{ asset('assets/css/pace.min-rtl.css') }} rel=" stylesheet" />
        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap.min-rtl.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/bootstrap-extended-rtl.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <link href="{{ asset('assets/css/app-rtl.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/icons-rtl.css') }}" rel="stylesheet" />
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/dark-theme-rtl.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/semi-dark-rtl.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/header-colors-rtl.css') }}" />
    @else
        {{-- English style  --}}
        <!-- loader-->
        <link href="{{ asset('assets/css/pace.min-ltr.css') }}" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="{{ asset('assets/css/bootstrap.min-ltr.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/bootstrap-extended-ltr.css') }}" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet" />
        <link href="{{ asset('assets/css/app-ltr.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/icons-ltr.css') }}" rel="stylesheet" />
        <!-- Theme Style CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/dark-theme-ltr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/semi-dark-ltr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/css/header-colors-ltr.css') }}" />
    @endif
    {{-- Toster --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
    <title>Smart School System</title>
</head>
