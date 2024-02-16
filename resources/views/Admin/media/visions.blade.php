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

                        <li class="breadcrumb-item active" aria-current="page">Visions</li>
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
                            data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> Add New Vision
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModaladd" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add
                                        Vision</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST"
                                          action="{{route('admin.visions.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">Content</label>
                                            <textarea class="form-control" id="inputAddress2"
                                                      name="content" required
                                                      placeholder="Enter Message"
                                                      rows="3"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">Photos</label>
                                            <input type="file" name="images[]" multiple accept="images/*">
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
                            <th>Category</th>
                            <th>content</th>
                            <th>Photo</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->category->name}}</td>
                                <td>{{$row->content}}</td>
                                <td>
                                    <img style="width: 50px;height: 50px;border-radius: 50%" src="{{$row->photos[0]->name}}">
                                </td>
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
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Vision</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.visions.destroy',$row->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>Are You Sure Delete Vision</p>

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
                                                        Vision</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.visions.update',$row->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Content</label>
                                                            <input type="hidden" value="{{$row->id}}" name="id">
                                                            <textarea class="form-control" id="inputAddress2"
                                                                      name="content" required
                                                                      placeholder="Enter Message"
                                                                      rows="3">{{$row->content}}</textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">Photos</label>
                                                            <input type="file" name="images[]" multiple accept="images/*">
                                                        </div>
                                                        <div class="col-12">
                                                            @foreach($row->photos as $image)
                                                                <img style="width: 50px;height: 50px;border-radius: 50%" src="{{$image->name}}">
                                                            @endforeach
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
