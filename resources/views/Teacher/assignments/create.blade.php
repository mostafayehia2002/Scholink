@extends('layouts.master', ['title' => 'Add Role'])
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}"><i
                                        class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">{{ __('sidbar.assignments') }}</li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('assignments.new_assignment') }}</li>
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
                        <h5 class="mb-0 text-primary">{{ __('assignments.new_assignment') }}</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('teacher.assignments.store') }}" method="POST"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="level_id" id="level_id"
                                    aria-label="Default select example">
                                <option selected disabled>{{ __('assignments.select_level') }}</option>
                                @foreach ($levels as $level)
                                    <option @selected($level->id == request('level_id')) value="{{ $level->id }}">
                                        {{ $level->level_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <select class="form-select mb-3" name="class_id" id="class_id"
                                    aria-label="Default select example">
                                <option selected disabled>{{ __('assignments.select_class') }}</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <select class="form-select mb-3" name="subject_id" id="subject_id"
                                    aria-label="Default select example">
                                <option selected disabled>{{ __('assignments.select_subject') }}</option>

                            </select>
                        </div>
                        <div class="col-12 col-md-6 pb-3">
                            <label for="inputName" class="form-label">{{ __('assignments.grade') }}</label>
                            <input type="number" name="grade" value="{{ old('grade') }}" class="form-control" required
                                   id="inputName">
                            @error('grade')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 pb-3">
                            <label for="inputName" class="form-label">{{ __('assignments.title') }}</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control" required
                                   id="inputName">
                            @error('title')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6 pb-3">
                            <label for="inputName" class="form-label">{{ __('assignments.deadline') }}</label>
                            <input type="date" name="deadline" value="{{ old('deadline') }}" class="form-control" required
                                   id="inputName">
                            @error('deadline')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 pb-3">
                            <label for="inputName" class="form-label">{{ __('assignments.task') }}</label>
                            <textarea name="task" class="form-control"></textarea>
                            @error('task')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">{{ __('assignments.save') }}</button>
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
        $('select[name="level_id"]').on('change', function () {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('teacher.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >{{ __('materials.select_class') }}</option>"
                        );
                        $.each(data, function (key, value) {
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

        $('select[name="class_id"]').on('change', function () {
            var class_id = $(this).val();
            if (class_id) {
                $.ajax({
                    url: "{{ route('teacher.getSubject', '') }}/" + class_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="subject_id"]').empty();
                        $('select[name="subject_id"]').append(
                            "<option selected disabled >{{ __('assignments.select_subject') }}</option>"
                        );
                        $.each(data, function (key, value) {
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
