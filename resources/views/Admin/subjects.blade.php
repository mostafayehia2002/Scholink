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

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.subjects')}}</li>
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
                            data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> {{__('subjects.new_subject')}}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModaladd" tabindex="-1"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('subjects.new_subject')}}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST"
                                          action="{{route('admin.subjects.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">{{__('subjects.name_en')}}</label>
                                            <input type="text" class="form-control" name="name_en"
                                                   value="">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                   class="form-label">{{__('subjects.name_ar')}}</label>
                                            <input type="text" class="form-control" name="name_ar"
                                                   value="">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">{{__('subjects.close')}}
                                    </button>
                                    <button type="submit" class="btn btn-primary">{{__('subjects.send')}}</button>
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
                            <th>{{__('subjects.name')}}</th>
                            <th>{{__('subjects.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    {{--=============Delate Request=========================--}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{$loop->index}}">{{__('subjects.delete')}}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{$loop->index}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{__('subjects.delete_subject')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.subjects.destroy',$row->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>{{__('subjects.sure_delete')}}</p>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{__('subjects.name')}}</label>

                                                            <input type="text" class="form-control" name="name"
                                                                   value="{{$row->name}}" readonly>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{__('subjects.close')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">{{__('subjects.delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{--=============Upadate=========================--}}
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{$loop->index}}">{{__('subjects.update')}}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$loop->index}}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{__('subjects.update_subject')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{route('admin.subjects.update',$row->id)}}"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{__('subjects.name_en')}}</label>
                                                            <input type="hidden" value="{{$row->id}}" name="id">
                                                            <input type="text" class="form-control" name="name_en"
                                                                   value="{{$row->getTranslation('name','en')}}">

                                                        </div>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{__('subjects.name_ar')}}</label>

                                                            <input type="text" class="form-control" name="name_ar"
                                                                   value="{{$row->getTranslation('name','ar')}}">
                                                        </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{__('subjects.close')}}
                                                    </button>
                                                    <button type="submit" class="btn btn-success">{{__('subjects.update')}}</button>
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

@endpush
