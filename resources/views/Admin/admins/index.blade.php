@extends('layouts.master', ['title' => 'Admins'])
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
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.admins')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <a href="{{ route('admin.admins.create') }}" class="btn btn-primary"><i
                            class="bx bx-plus"></i> {{__('admins.new_admin')}}</a>
                    <!-- Modal -->

                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('admins.name')}}</th>
                            <th>{{__('admins.email')}}</th>
                            <th>{{__('admins.roles')}}</th>
                            <th>{{__('admins.actions')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>
                                    @foreach ($row->getRoleNames() as $v)
                                        <span class="badge bg-success">{{ $v }}</span>
                                    @endforeach
                                </td>
                                <td>

                                    {{-- =============Delate Request========================= --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{ $loop->index }}">{{__('admins.delete')}}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="exampleModalLabel">{{__('admins.delete_admin')}}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{ route('admin.admins.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>{{__('admins.sure_delete')}}</p>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{__('admins.name')}}</label>
                                                            <input type="text" class="form-control"
                                                                   id="inputAddress2" name="name" readonly
                                                                   value="{{ $row->name }}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{__('admins.close')}}
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{__('admins.delete')}}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- =============Upadate========================= --}}
                                    <a href="{{ route('admin.admins.edit', $row->id) }}"
                                       class="btn btn-success btn-sm">{{__('admins.update')}}</a>
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
        $(document).ready(function () {
            var table = $('#example2').DataTable({
                "paging": false,
                "ordering": false,
                "info": false
            });

        });
    </script>
@endpush
