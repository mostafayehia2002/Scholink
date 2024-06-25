@extends('layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">{{ __('sidbar.teachers') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->


        <div class="card">


            <div class="card-body">

                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                        data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> {{ __('teachers.new_teacher') }}
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('teachers.new_teacher') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" method="POST" action="{{ route('admin.teachers.store') }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                class="form-label">{{ __('teachers.name_en') }}</label>
                                            <input type="text" class="form-control" name="name_en" value="">

                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                class="form-label">{{ __('teachers.name_ar') }}</label>

                                            <input type="text" class="form-control" name="name_ar" value="">
                                        </div>

                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">{{ __('teachers.email') }}</label>

                                            <input type="email" class="form-control" name="email" value="">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2" class="form-label">{{ __('teachers.mobil') }}</label>

                                            <input type="text" class="form-control" name="phone" value="">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputAddress2"
                                                class="form-label">{{ __('teachers.address') }}</label>
                                            <textarea class="form-control" id="inputAddress2" name="address" required
                                                placeholder="{{ __('teachers.enter_address') }}" rows="3"></textarea>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">{{ __('teachers.close') }}
                                    </button>
                                    <button type="submit" class="btn btn-primary">{{ __('teachers.send') }}</button>
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
                                <th>{{ __('teachers.name') }}</th>
                                <th>{{ __('teachers.email') }}</th>
                                <th>{{ __('teachers.mobil') }}</th>
                                <th>{{ __('teachers.address') }}</th>
                                <th>{{ __('teachers.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->phone }}</td>
                                    <td>{{ $row->address }}</td>
                                    <td>
                                        {{-- =============Delate Request========================= --}}
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{ $loop->index }}">{{ __('teachers.delete') }}
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('teachers.delete_teacher') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="POST"
                                                            action="{{ route('admin.teachers.destroy', $row->id) }}">
                                                            @method('DELETE')
                                                            @csrf
                                                            <p>{{ __('teachers.sure_delete') }}</p>
                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.name') }}</label>

                                                                <input type="text" class="form-control" name="name"
                                                                    value="{{ $row->name }}" readonly>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('teachers.close') }}
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ __('teachers.delete') }}</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{-- =============Upadate========================= --}}
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $loop->index }}">{{ __('teachers.update') }}
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                            {{ __('teachers.update_teacher') }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="row g-3" method="POST"
                                                            action="{{ route('admin.teachers.update', $row->id) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.name_en') }}</label>
                                                                <input type="text" class="form-control" name="name_en"
                                                                    value="{{ $row->getTranslation('name', 'en') }}">

                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.name_ar') }}</label>

                                                                <input type="text" class="form-control" name="name_ar"
                                                                    value="{{ $row->getTranslation('name', 'ar') }}">
                                                            </div>

                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.email') }}</label>

                                                                <input type="email" class="form-control" name="email"
                                                                    value="{{ $row->email }}">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.mobil') }}</label>

                                                                <input type="text" class="form-control" name="phone"
                                                                    value="{{ $row->phone }}">
                                                            </div>
                                                            <div class="col-12">
                                                                <label for="inputAddress2"
                                                                    class="form-label">{{ __('teachers.address') }}</label>

                                                                <textarea class="form-control" id="inputAddress2" name="address" required rows="3">{{ $row->address }}</textarea>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('teachers.close') }}
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ __('teachers.update') }}</button>
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
                    {{ $data->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

        });
    </script>



    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.ui.widget.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>
    {{--    <script> --}}
    {{--        $('#fancy-file-upload').FancyFileUpload({ --}}
    {{--            params: { --}}
    {{--                action: 'fileuploader' --}}
    {{--            }, --}}
    {{--            maxfilesize: 1000000 *5, --}}
    {{--        }); --}}
    {{--    </script> --}}

    <script>
        $(document).ready(function() {
            $('#image-uploadify').imageuploadify();
        })
    </script>
@endpush
