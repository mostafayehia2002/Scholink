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

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.timetable')}}</li>
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
