@extends('layouts.master')
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @php
                                    $classes=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->distinct()->pluck('class_id');
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.classes')}}</p>
                                <h4 class="my-1 text-info">{{count($classes)}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('teacher.classes.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-scooter text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @php
                                    $subjects_id=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->pluck('subject_id');
                                    $subjects=App\Models\Subject::whereIn('id',$subjects_id)->distinct()->paginate(20);
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.subjects')}}</p>
                                <h4 class="my-1 text-danger">{{count($subjects)}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('teacher.subjects.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @php
                                    $lessons=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->sum('number_lesson');
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.lessons')}}</p>
                                <h4 class="my-1 text-success">{{$lessons}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('teacher.timetable.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                    class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @php
                                    $subjects_id=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->pluck('subject_id');
                                    $classes=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->distinct()->pluck('class_id');
                                    $materials = App\Models\Material::whereIn('class_id',$classes)->whereIn('subject_id',$subjects_id)->get();
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.materials')}}</p>
                                <h4 class="my-1 text-warning">{{count($materials)}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('teacher.materials.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i
                                    class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div>
                        <h6 class="mb-0">{{__('sidbar.timetable')}}</h6>
                    </div>
                    <div class="dropdown ms-auto">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{__('classes.level')}} </th>
                            <th>{{__('classes.name')}} </th>
                            <th>{{__('classes.subject')}}</th>
                            <th>{{__('classes.day')}}</th>
                            <th>{{__('classes.number_lesson')}}</th>
                            <th>{{__('classes.start_at')}}</th>
                            <th>{{__('classes.end_at')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $data=App\Models\ClassTeacher::where('teacher_id',auth('teacher')->user()->id)->paginate(10);
                        @endphp
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->classe->level->level_name}}</td>
                                <td>{{$row->classe->class_name}}</td>
                                <td>{{$row->subject->name}}</td>
                                <td>{{$row->day}}</td>
                                <td>{{$row->number_lesson}}</td>
                                <td>{{$row->start_at}}</td>
                                <td>{{$row->end_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
