@extends('layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">Classes</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">


            <div class="card-body">

                <div class="col-6 col-md-4">
                    {{--=====================Add=================--}}
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> Add New Class
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModaladd" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                        Class</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST"
                                          action="{{route('admin.classes.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">Level</label>
                                            <select class="form-select" id="inputProductType" name="level_id">
                                                <option selected disabled>--select level--</option>
                                                @foreach($levels as $level)
                                                    <option value="{{$level->id}}">{{$level->level_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">Class Name</label>

                                            <input type="number" class="form-control" name="class_name"
                                                   value="">
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Send</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Level Name</th>
                            <th>Class Name</th>
                            <th>Number Seats</th>
                            <th>Available Seats</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->level->level_name}}</td>
                                <td>{{$row->class_name}}</td>
                                <td>{{$row->number_seats}}</td>
                                <td>{{$row->available_seats}}</td>


                                <td>
                                    {{--=============Delate Request=========================--}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{$loop->index}}">Delete
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{$loop->index}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Class</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.classes.destroy',$row->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>Are You Sure Delete Class ??</p>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Level</label>

                                                            <input type="text" class="form-control" name="name"
                                                                   value="{{$row->level->level_name}}" readonly>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Class Name</label>

                                                            <input type="text" class="form-control" name="name"
                                                                   value="{{$row->class_name}}" readonly>
                                                        </div>
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


                                    {{--=============Upadate=========================--}}
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{$loop->index}}">Update
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$loop->index}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update
                                                        Class</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.classes.update',$row->id)}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Level</label>
                                                            <select class="form-select" id="inputProductType" name="level_id">

                                                                @foreach($levels as $level)
                                                                    <option @selected($row->level_id==$level->id) value="{{$level->id}}">{{$level->level_name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Class Name</label>
                                                            <input type="number" class="form-control" name="class_name"
                                                                   value="{{$row->class_name}}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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



    <script src="{{asset('assets/plugins/fancy-file-uploader/jquery.ui.widget.js')}}"></script>
    <script src="{{asset('assets/plugins/fancy-file-uploader/jquery.fileupload.js')}}"></script>
    <script src="{{asset('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js')}}"></script>
    <script src="{{asset('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js')}}"></script>
    <script src="{{asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js')}}"></script>
    {{--    <script>--}}
    {{--        $('#fancy-file-upload').FancyFileUpload({--}}
    {{--            params: {--}}
    {{--                action: 'fileuploader'--}}
    {{--            },--}}
    {{--            maxfilesize: 1000000 *5,--}}
    {{--        });--}}
    {{--    </script>--}}

    <script>
        $(document).ready(function () {
            $('#image-uploadify').imageuploadify();
        })
    </script>
@endpush
