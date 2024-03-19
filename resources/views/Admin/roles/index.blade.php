@extends('layouts.master', ['title' => 'Roles'])
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

                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.roles')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i>{{__('roles.new_role')}}</a>
                    <!-- Modal -->
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('roles.name')}}</th>
                                <th>{{__('roles.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>
                              @can('roles-delete')
                                            {{-- =============Delate Request========================= --}}
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModald{{ $loop->index }}">{{__('roles.delete')}}
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">{{__('roles.delete_role')}}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="row g-3" method="POST"
                                                                  action="{{ route('admin.roles.destroy', $row->id) }}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <p>{{__('roles.sure_delete')}}</p>
                                                                <div class="col-12">
                                                                    <label for="inputAddress2" class="form-label">{{__('roles.name')}}</label>
                                                                    <input type="text" class="form-control"
                                                                           id="inputAddress2" name="name" readonly
                                                                           value="{{ $row->name }}">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">{{__('roles.close')}}
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">{{__('roles.delete')}}</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endcan
                                        {{-- =============Upadate========================= --}}
                                        <a href="{{ route('admin.roles.edit', $row->id) }}"
                                            class="btn btn-success btn-sm">{{__('roles.update')}}</a>
                                        <a href="{{ route('admin.roles.show', $row->id) }}"
                                            class="btn btn-warning btn-sm text-white">
                                            {{__('roles.show')}}</a>
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
@endpush
