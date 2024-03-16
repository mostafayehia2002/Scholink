@extends('layouts.master', ['title' => 'Edit Admins'])
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i
                                    class="bx bx-home-alt"></i></a>
                            {{__('sidbar.home')}}
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.roles')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('roles.permission')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->



        <h6 class="mb-0 text-uppercase">{{__('roles.permissions')}}  ::  {{ $role->name }}</h6>
        <hr>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4">
            @foreach ($rolePermissions as $permission)
                <div class="col">
                    <div class="card text-center">
                        <div class="card-body">
                            @if(app()->getLocale()=='en')
                                <div class="text-primary rounded">{{ $permission->name }}</div>
                            @else
                                <div class="text-primary rounded">{{ $permission->name_ar }}</div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
@endpush
