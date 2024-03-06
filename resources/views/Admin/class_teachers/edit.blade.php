@extends('layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Class Teacher</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Class Teacher</li>
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
                        <h5 class="mb-0 text-primary">Class Teacher</h5>
                    </div>
                    <hr>
                    <form class="row g-3" action="{{route('admin.class_teachers.update',$data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="col-md-6 col-12">
                            <label for="inputTeacher" class="form-label">Teacher</label>
                            <select id="inputTeacher" class="form-select" name="teacher_id" required>
                                <option selected="" disabled>Choose...</option>
                                @foreach($teachers as $teacher)
                                    <option @selected($data->teacher_id==$teacher->id) value="{{$teacher->id}}">{{$teacher->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputSubject" class="form-label">Subject</label>
                            <select id="inputSubject" class="form-select" name="subject_id" required>

                                @foreach($subjects as $subject)
                                    <option @selected($data->subject_id==$subject->id) value="{{$subject->id}}">{{$subject->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputClass" class="form-label">Level</label>
                            <select id="inputClass" class="form-select" name="level_id" required>
                                @foreach($levels as $level)
                                    <option @selected($data->level_id==$level->id) value="{{$level->id}}">{{$level->level_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputClass" class="form-label">Class</label>
                            <select id="inputClass" class="form-select" name="class_id" required>
                                <option value="{{$data->class_id}}">{{$data->classe->class_name}}</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12">
                            <label for="inputDay" class="form-label">Day</label>
                            <select id="inputDay" class="form-select" name="day" required>

                                @foreach($days as $day)
                                    <option @selected($day==$data->$day) value="{{$day}}">{{App\Enums\WeekDay::getTranslatedDay($day,app()->getLocale())}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 col-12">
                            <label for="inputLastLesson" class="form-label">Number Lessons</label>
                            <input type="number" value="{{$data->number_lesson}}" name="number_lesson" class="form-control" id="inputLastLesson">
                        </div>


                        <div class="col-md-6 col-12">
                            <label class="form-label">Start At</label>
                            <input type="text" name="start_at" placeholder="Select ......"
                                   class="form-control timepicker" value="{{$data->start_at}}"/>
                        </div>
                        <div class="col-md-6 col-12">
                            <label class="form-label">End At</label>
                            <input type="text" name="end_at" placeholder="Select ......"
                                   class="form-control timepicker" value="{{$data->end_at}}"/>
                        </div>


                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        $('select[name="level_id"]').on('change', function() {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('admin.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >Select...</option>"
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
    <script>
        $(function () {
            $('#date-time').bootstrapMaterialDatePicker({
                format: 'YYYY-MM-DD HH:mm'
            });
            $('#date').bootstrapMaterialDatePicker({
                time: false
            });
            $('#time').bootstrapMaterialDatePicker({
                date: false,
                format: 'HH:mm'
            });
        });
    </script>
@endpush
