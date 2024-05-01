@extends('layouts.master', ['title' => ''])
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

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.materials')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('materials.show_material')}}</li>
                    </ol>

                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="card border-top border-0 border-4 border-primary">
            </div>
        </div>
    </div>
@endsection



@push('js')
@endpush
