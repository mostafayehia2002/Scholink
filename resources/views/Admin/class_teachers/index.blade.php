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
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">





            <div class="card-body">

                <div class="col-6 col-md-4">
                    {{--=====================Add=================--}}

                    <a href="{{route('admin.class_teachers.create')}}" class="btn btn-primary btn-sm"><i class="bx bx-plus"></i> Add New Class Teacher</a>
                    <!-- Modal -->

                </div>




                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Teacher</th>
                            <th>Subject</th>
                            <th>Class</th>
                            <th>Day</th>
                            <th>Number Lesson</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->teacher->name}}</td>
                                <td>{{$row->subject->name}}</td>
                                <td>{{$row->classe->class_name}}</td>
                                <td>{{$row->day}}</td>
                                <td>{{$row->number_lesson}}</td>
                                <td>{{$row->start_at}}</td>
                                <td>{{$row->end_at}}</td>
                                <td>
{{--                                    =============Delate Request=========================--}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{$loop->index}}">Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{$loop->index}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Class Teacher</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.class_teachers.destroy',$row->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>Are You Sure Delete Class Teacher  ????</p>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

{{--                                    =============Upadate=========================--}}
                                    <a href="{{route('admin.class_teachers.edit',$row->id)}}"  class="btn btn-success btn-sm">Update</a>
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
