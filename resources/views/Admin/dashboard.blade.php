@extends('layouts.master')
@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            @php
                                $students=App\Models\Student::count();
                            @endphp
                            <div>
                                <p class="mb-0 text-secondary">{{__('home.students')}}</p>
                                <h4 class="my-1 text-warning">{{$students}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('admin.students.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blooker text-white ms-auto"><i class='bx bxs-group'></i>
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
                                    $levels=App\Models\Level::count();
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.levels')}}</p>
                                <h4 class="my-1 text-danger">{{$levels}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('admin.levels.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                @php
                                    $classes=App\Models\Classe::count();
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.classes')}}</p>
                                <h4 class="my-1 text-info">{{$classes}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('admin.classes.index')}}">{{__('home.show_more')}}</a></p>
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

                                    $subjects=App\Models\Subject::count();
                                @endphp
                                <p class="mb-0 text-secondary">{{__('home.subjects')}}</p>
                                <h4 class="my-1 text-danger">{{$subjects}}</h4>
                                <p class="mb-0 font-13"><a
                                        href="{{route('admin.subjects.index')}}">{{__('home.show_more')}}</a></p>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-bloody text-white ms-auto"><i
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
                        <h6 class="mb-0">{{__('sidbar.students')}}</h6>
                    </div>
                    <div class="dropdown ms-auto">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{__('students.name')}}</th>
                            <th>{{__('students.email')}}</th>
                            <th>{{__('students.parent_name')}}</th>
                            <th>{{__('students.level')}}</th>
                            <th>{{__('students.class')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $data=App\Models\Student::latest()->paginate(10);
                        @endphp
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->parent->name}}</td>
                                <td>{{$row->classe->level->level_name}}</td>
                                <td>{{$row->classe->class_name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
         <script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
         <script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
@endpush
