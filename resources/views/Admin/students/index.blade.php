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
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.students')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-12">
                    <form method="GET" action="{{route('admin.students.index')}}" id="form_select">

                        <div class="row">
                            <label for="inputEmail" class="form-label">Filter By : </label>
                            <div class="col-12 col-md-5">
                                <select class="form-select mb-3" name="level_id" id="level_id"
                                        aria-label="Default select example">
                                    <option selected disabled>{{__('students.select_level')}}</option>
                                    @foreach($levels as $level)
                                        <option @selected($level->id==request('level_id')) value="{{$level->id}}">{{$level->level_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 col-md-5">
                                <select class="form-select mb-3" name="class_id" id="class_id"
                                        aria-label="Default select example">
                                    <option selected disabled>{{__('students.select_class')}}</option>
                                    @if(request('class_id'))
                                        <option selected value="{{$classe->id}}">{{$classe->class_name}}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <button class="btn btn-primary d-block" type="submit">{{__('students.search')}}</button>
                            </div>
                    </form>
                </div>
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
                            <th>{{__('students.actions')}}</th>
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
                                <td>

                                    {{-- =============Delate Request========================= --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{ $loop->index }}">{{__('students.delete')}}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabel">{{__('students.delete_student')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{ route('admin.students.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>{{__('students.sure_delete')}}</p>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{__('students.name')}}</label>
                                                            <input type="text" class="form-control"
                                                                   id="inputAddress2" name="name" readonly
                                                                   value="{{ $row->name }}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{__('students.close')}}
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{__('students.delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- =============Upadate========================= --}}
                                    <a href="{{ route('admin.students.edit', $row->id) }}"
                                       class="btn btn-success btn-sm">{{__('students.update')}}</a>
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

    <script>
        $('select[name="level_id"]').on('change', function () {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('admin.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >{{__('students.select_class')}}</option>"
                        );
                        $.each(data, function (key, value) {
                            $('select[name="class_id"]').append(
                                '<option value="' + value + '">' + key +
                                '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    </script>
    <script src="{{asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
    <script>

        $(document).ready(function () {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });
            // $('#select_status').on('change', function() {
            //     this.form.submit();
            // });
        });
    </script>
@endpush
