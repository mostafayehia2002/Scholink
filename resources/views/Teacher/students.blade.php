@extends('layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">

                        <li class="breadcrumb-item"><a href="{{route('teacher.dashboard')}}"><i
                                    class="bx bx-home-alt"></i></a>
                            {{__('sidbar.home')}}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.classes')}}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.students')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
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
                <div>
                    {{$data->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

