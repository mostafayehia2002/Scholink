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
                    <form  method="GET" action="{{route('admin.students.index')}}" id="form_select">

                      <div class="row">
                          <label for="inputEmail" class="form-label">Filter By : </label>
                          <div class="col-12 col-md-6">
                              <select class="form-select mb-3" name="level_id"  id="level_id" aria-label="Default select example">
                                  <option selected disabled>select Levels</option>
                                  @foreach($levels as $level)
                                      <option value="{{$level->id}}">{{$level->level_name}}</option>
                                  @endforeach
                              </select>
                          </div>
                          <div class="col-12 col-md-6">
                              <select class="form-select mb-3" name="class_id"  id="class_id" aria-label="Default select example">
                                  <option selected disabled>select Class</option>
                              </select>
                          </div>
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

                        @foreach($data[0]->students as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->parent->name}}</td>
                                <td>{{$row->classe->level->level_name}}</td>
                                <td>{{$row->classe->class_name}}</td>
{{--                                <td>--}}
{{--                                    @if($row->status=='reject')--}}
{{--                                        <span class="badge bg-danger">{{$row->status}}</span>--}}
{{--                                    @elseif($row->status=='pending')--}}
{{--                                        <span class="badge bg-info">{{$row->status}}</span>--}}
{{--                                    @elseif($row->status=='accept')--}}
{{--                                        <span class="badge bg-success">{{$row->status}}</span>--}}
{{--                                    @elseif($row->status=='confirmed')--}}
{{--                                        <span class="badge bg-warning">{{$row->status}}</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                                <td>


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
        $('select[name="level_id"]').on('change', function() {
            var level_id = $(this).val();
            if (level_id) {
                $.ajax({
                    url: "{{ route('admin.getclass', '') }}/" + level_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('select[name="class_id"]').empty();
                        $('select[name="class_id"]').append(
                            "<option selected disabled >Select...</option>"
                        );
                        $.each(data, function(key, value) {
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

        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false
            } );
            // $('#select_status').on('change', function() {
            //     this.form.submit();
            // });
        } );
    </script>
@endpush
