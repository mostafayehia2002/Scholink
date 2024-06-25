@extends('layouts.master', ['title' => 'Add Role'])
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('sidbar.materials') }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('materials.update_material') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="card border-top border-0 border-4 border-primary">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                        </div>
                        <h5 class="mb-0 text-primary">{{ __('materials.update_material') }}</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('teacher.materials.update', $material->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="level_id" id="level_id"
                                aria-label="Default select example">
                                <option selected disabled>{{ __('materials.select_level') }}</option>
                                @foreach ($levels as $level)
                                    <option @selected($level->id == $material->class->level_id) value="{{ $level->id }}">
                                        {{ $level->level_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="class_id" id="class_id"
                                aria-label="Default select example">
                                <option selected disabled>{{ __('materials.select_class') }}</option>
                                <option value="{{ $material->class_id }}" selected>
                                    {{ $material->class->class_name }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="subject_id" id="subject_id"
                                aria-label="Default select example">
                                <option selected disabled>{{ __('materials.select_subject') }}</option>
                                <option value="{{ $material->subject_id }}" selected>
                                    {{ $material->subject->name }}</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="type" id="type"
                                aria-label="Default select example">
                                <option selected disabled>{{ __('materials.select_type') }}</option>
                                <option @selected($material->type == 'lesson') value="lesson">{{ __('materials.lesson') }}</option>
                                <option @selected($material->type == 'exam') value="exam">{{ __('materials.exam') }}</option>
                                <option @selected($material->type == 'video') value="video">{{ __('materials.video') }}</option>
                            </select>
                        </div>

                        <div class="col-12 pb-3">
                            <label for="inputName" class="form-label">{{ __('materials.title') }}</label>
                            <input type="text" name="title" value="{{ $material->title }}" class="form-control"
                                required id="inputName">
                            @error('title')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 pb-3">
                            <label for="inputName" class="form-label">{{ __('materials.descriptions') }}</label>
                            <textarea name="descriptions" class="form-control">{{ $material->descriptions }}</textarea>
                            @error('descriptions')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <label for="inputName" class="form-label">{{ __('materials.materials') }}</label>
                            <input name="material[]" multiple type="file" class="dropify" data-height="100" />
                            @error('material')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="row">
                            @foreach ($material->attachments as $material)
                                <div class="col-6 col-m-12">
                                    @if (pathinfo($material->url, PATHINFO_EXTENSION) == 'pdf')
                                        <a target="_blank" href="{{ $material->url }}">
                                            {{ explode('materials/', $material->url)[1] }}
                                        </a>
                                    @else
                                        <a target="_blank" href="{{ $material->url }}">
                                            <img src="{{ $material->url }}" alt=".................">
                                        </a>
                                    @endif
                                </div>
                            @endforeach

                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">{{ __('materials.save') }}</button>
                        </div>
                    </form>
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
    <script>
        $('select[name="level_id"]').on('change', function() {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('teacher.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >{{ __('materials.select_class') }}</option>"
                        );
                        $.each(data, function(key, value) {
                            $('select[name="class_id"]').append(
                                '<option value="' + value + '">' + key +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });

        $('select[name="class_id"]').on('change', function() {
            var class_id = $(this).val();
            if (class_id) {
                $.ajax({
                    url: "{{ route('teacher.getSubject', '') }}/" + class_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="subject_id"]').empty();
                        $('select[name="subject_id"]').append(
                            "<option selected disabled >{{ __('materials.select_subject') }}</option>"
                        );
                        $.each(data, function(key, value) {
                            var jsonString = key;
                            var jsonObject = JSON.parse(jsonString);
                            var language = "{{ app()->getLocale() }}"
                            var arValue = jsonObject[language];

                            $('select[name="subject_id"]').append(
                                '<option value="' + value + '">' + arValue +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>
@endpush
