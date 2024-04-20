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
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.students')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('students.update_student')}}</li>
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
                        <h5 class="mb-0 text-primary">{{__('students.update_student')}}</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{ route('admin.students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 col-12">
                            <label for="inputName" class="form-label">{{__('students.name_en')}}</label>
                            <input type="name" name="name_en" value="{{ $student->getTranslation('name','en') }}"
                                   class="form-control" required
                                   id="inputName">
                            @error('name_en')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputName" class="form-label">{{__('students.name_ar')}}</label>
                            <input type="name" name="name_ar" value="{{ $student->getTranslation('name','ar') }}"
                                   class="form-control" required
                                   id="inputName">
                            @error('name_ar')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputName" class="form-label">{{__('students.email')}}</label>
                            <input type="email" name="email" value="{{ $student->email }}" class="form-control" required
                                   id="inputName">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="parent_id" class="form-label">{{__('students.parent_name')}}</label>
                            <select class="form-select mb-3" name="parent_id" id="parent_id"
                                    aria-label="Default select example">
                                @foreach($parents as $parent)
                                    <option
                                        @selected($parent->id==$student->parent_id) value="{{$parent->id}}">{{$parent->name}}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="level_id" class="form-label">{{__('students.level')}}</label>
                            <select class="form-select mb-3" name="level_id" id="level_id"
                                    aria-label="Default select example">
                                <option selected disabled>{{__('students.select_level')}}</option>
                                @foreach($levels as $level)
                                    <option
                                        @selected($level->id == $student->classe->level->id) value="{{$level->id}}">{{$level->level_name}}</option>
                                @endforeach
                            </select>
                            @error('level_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="class_id" class="form-label">{{__('students.class')}}</label>
                            <select class="form-select mb-3" name="class_id" id="class_id"
                                    aria-label="Default select example">
                                <option selected
                                        value="{{$student->classe->id}}">{{$student->classe->class_name}}</option>
                            </select>
                            @error('class_id')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="term" class="form-label">{{__('students.term')}}</label>
                            <select class="form-select mb-3" name="term" id="term"
                                    aria-label="Default select example">
                                <option @selected("first"==$student->term)  value="first">first</option>
                                <option @selected("second"==$student->term)   value="second">second</option>
                            </select>
                            @error('term')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="gender" class="form-label">{{__('students.gender')}}</label>
                            <select class="form-select mb-3" name="gender" id="gender"
                                    aria-label="Default select example">
                                <option @selected("male"==$student->gender)  value="male">male</option>
                                <option @selected("female"==$student->gender)   value="female">female</option>
                            </select>
                            @error('gender')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="date_birth" class="form-label">{{__('students.date_birth')}}</label>
                            <input type="text"   name="date_birth" class="form-control datepicker"
                                   value="{{$student->date_birth}}" />
                            @error('date_birth')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror

                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">{{__('students.update')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')

    <script>
        $('select[name="level_id"]').on('change', function () {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('admin.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >{{__('students.select_class')}}</option>"
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
    </script>

    <script src="{{asset('assets/plugins/datetimepicker/js/legacy.js')}}"></script>
    <script src="{{asset('assets/plugins/datetimepicker/js/picker.js')}}"></script>
    <script src="{{asset('assets/plugins/datetimepicker/js/picker.time.js')}}"></script>
    <script src="{{asset('assets/plugins/datetimepicker/js/picker.date.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/moment.min.js')}}"></script>
    <script
        src="{{asset('assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.min.js')}}"></script>


    <script>
        $('.datepicker').pickadate({
            selectMonths: true,
            selectYears: true
        }),
            $('.timepicker').pickatime()
    </script>

@endpush
