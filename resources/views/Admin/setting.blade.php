@extends('layouts.master')
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.settings')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-8">
                        <form method="POST" method="{{ route('admin.settings.update') }}" class="card"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" name="name" class="form-control"
                                               value="{{ $setting->name }}" />
                                        @error('name')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Number_seats</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="number" min="1" name="number_seats" class="form-control"
                                               value="{{ $setting->number_seats }}" />
                                        @error('number_seats')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Description</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <textarea name="description" id="" class="form-control" rows="3">{{ $setting->description }}</textarea>
                                        @error('description')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <h6 class="mb-0">FaceBook</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-9 text-secondary">--}}
{{--                                        <textarea name="face_link" id="" class="form-control" rows="3">{{ $setting->face_link }}</textarea>--}}
{{--                                        @error('face_link')--}}
{{--                                        <p class="text-danger">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <h6 class="mb-0">Instgram</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-9 text-secondary">--}}
{{--                                        <textarea name="ins_link" id="" class="form-control" rows="3">{{ $setting->ins_link }}</textarea>--}}
{{--                                        @error('ins_link')--}}
{{--                                        <p class="text-danger">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <h6 class="mb-0">Twitter</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-9 text-secondary">--}}
{{--                                        <textarea name="tw_link" id="" class="form-control" rows="3">{{ $setting->tw_link }}</textarea>--}}
{{--                                        @error('tw_link')--}}
{{--                                        <p class="text-danger">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="row mb-3">--}}
{{--                                    <div class="col-sm-3">--}}
{{--                                        <h6 class="mb-0">Youtube</h6>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-sm-9 text-secondary">--}}
{{--                                        <textarea name="you_link" id="" class="form-control" rows="3">{{ $setting->you_link }}</textarea>--}}
{{--                                        @error('you_link')--}}
{{--                                        <p class="text-danger">{{ $message }}</p>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Logo</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input name="logo" type="file" class="dropify" data-height="100"
                                               accept=".jpg, .png, image/jpeg, image/png" />
                                        @error('logo')
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0"></h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <img class="w-100" src=" {{ $setting->logo }}" alt="45" />
                                    </div>
                                </div>

                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="{{__('settings.save')}}" />
                                        </div>
                                    </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify();
    </script>
@endpush

