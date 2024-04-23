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

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.attendance')}}</li>
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
                            <th>{{ __('attendance.date') }}</th>
                            <th>{{__('attendance.day')}}</th>
                            <th>{{__('attendance.level')}} </th>
                            <th>{{__('attendance.name')}} </th>
                            <th>{{__('attendance.subject')}}</th>
                            <th>{{__('attendance.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                                <td>{{$row->day}}</td>
                                <td>{{$row->classe}}</td>
                                <td>{{$row->classe}}</td>
                                <td>{{$row->subject->name}}</td>
                                <td>
                                    <a href="{{ route('teacher.attendance.showAbsence', $row->class_id) }}"
                                       class="btn btn-success btn-sm">{{__('attendance.absence')}}</a>
                                </td>
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



@push('js')
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

        });
    </script>
@endpush
