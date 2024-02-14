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

                        <li class="breadcrumb-item active" aria-current="page">Requests</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">

            <div class="card-body">
                <div class="col-md-4">
                    <form method="GET" action="{{route('admin.registers.index')}}" id="form_select">
                        <label for="inputEmail" class="form-label">Filter By Status</label>
                        <select class="form-select mb-3" name="status"  id="select_status" aria-label="Default select example">
                            <option selected disabled>select status</option>
                            <option @selected(request('status')=='pending') value="pending">pending</option>
                            <option @selected(request('confirmed')=='confirmed') value="confirmed">confirmed</option>
                            <option @selected(request('accept')=='accept') value="accept">accept</option>
                            <option @selected(request('reject')=='reject') value="reject">reject</option>
                        </select>
                    </form>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Parent Name</th>
                            <th>Parent Email</th>
                            <th>Parent Mobil</th>
                            <th>Parent National Id</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($data as $row)
                            <tr>
                                <td>{{$loop->index+1}}</td>
                                <td>{{$row->parent_name}}</td>
                                <td>{{$row->parent_email}}</td>
                                <td>{{$row->parent_mobile}}</td>
                                <td>{{$row->parent_national_id}}</td>
                                <td>
                                   @if($row->status=='reject')
                                        <span class="badge bg-danger">{{$row->status}}</span>
                                    @elseif($row->status=='pending')
                                        <span class="badge bg-info">{{$row->status}}</span>
                                    @elseif($row->status=='accept')
                                        <span class="badge bg-success">{{$row->status}}</span>
                                    @elseif($row->status=='confirmed')
                                        <span class="badge bg-warning">{{$row->status}}</span>
                                    @endif
                                </td>
                                <td>
                                    {{--=============Delate Request=========================--}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModald{{$loop->index}}">Delete</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST" action="{{route('admin.registers.destroy',$row->id)}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <div class="col-12">
                                                            <label for="inputAddress2" class="form-label">Name</label>
                                                            <input type="text" class="form-control" id="inputFirstName" readonly value="{{$row->parent_name}}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    {{--=============Send Meesage=========================--}}
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->index}}">Send Message</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{$loop->index}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST" action="{{route('admin.registers.store')}}">
                                                        @csrf
                                                        <div class="col-12">
                                                            <label for="inputAddress2" class="form-label">Message</label>
                                                            <input type="hidden" value="{{$row->id}}" name="id">
                                                            <textarea class="form-control" id="inputAddress2" name="message" required placeholder="Enter Message" rows="3"></textarea>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Send</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                   {{--=============Show Data=========================--}}
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#exampleFullScreenModal{{$loop->index}}">Show</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleFullScreenModal{{$loop->index}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-fullscreen">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Modal title</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST" action="{{route('admin.registers.update',$row->id)}}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="col-md-4">
                                                            <label for="inputFirstName" class="form-label">Parent Name</label>
                                                            <input type="email" class="form-control" id="inputFirstName" readonly value="{{$row->parent_name}}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputLastName" class="form-label">Parent Email</label>
                                                            <input type="email" readonly class="form-control" value="{{$row->parent_email}}" id="inputLastName">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Parent Mobil</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->parent_mobile}}" id="inputEmail">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Parent National Id</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->parent_national_id}}" id="inputEmail">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Parent Address</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->parent_address}}" id="inputEmail">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Parent Job</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->parent_job}}" id="inputEmail">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Child Name</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->child_name}}" id="inputEmail">
                                                        </div>  <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Child Data Birth</label>
                                                            <input type="text" class="form-control" readonly value="{{$row->child_date_birth}}" id="inputEmail">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label for="inputEmail" class="form-label">Status</label>
                                                            <select class="form-select mb-3" name="status" aria-label="Default select example">
                                                                <option @selected($row->status=='pending') value="pending">pending</option>
                                                                <option @selected($row->status=='confirmed') value="confirmed">confirmed</option>
                                                                <option @selected($row->status=='accept') value="accept">accept</option>
                                                                <option @selected($row->status=='reject') value="reject">reject</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">parent_personal_identification</h5>
                                                                </div>
                                                                <a href="{{asset($row->parent_personal_identification)}}" ><img style="height: 200px" src="{{asset($row->parent_personal_identification)}}" class="card-img-bottom" alt="..."></a>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">child_birth_certificate</h5>
                                                                </div>
                                                                <a href="{{asset($row->child_birth_certificate)}}" target="_blank"><img style="height: 200px" src="{{asset($row->child_birth_certificate)}}" class="card-img-bottom" alt="..."></a>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
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

        $(document).ready(function() {
            var table = $('#example2').DataTable( {
                "paging":   false,
                "ordering": false,
                "info":     false
            } );
            $('#select_status').on('change', function() {
                this.form.submit();
            });
        } );
    </script>
@endpush
