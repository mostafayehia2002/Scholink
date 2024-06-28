@extends('layouts.master', ['title' => 'Assignments'])
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>

                        <li class="breadcrumb-item active" aria-current="page">{{ __('sidbar.assignments') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body">
                <div class="col-6 col-md-4">
                    {{-- =====================Add================= --}}
                    <a href="{{ route('teacher.assignments.create') }}" class="btn btn-primary"><i
                            class="bx bx-plus"></i>{{ __('assignments.new_assignment') }}</a>
                    <!-- Modal -->
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{ __('assignments.level') }}</th>
                            <th>{{ __('assignments.class') }}</th>
                            <th>{{ __('assignments.subject') }}</th>
                            <th>{{ __('assignments.title') }}</th>
                            <th>{{ __('assignments.task') }}</th>
                            <th>{{ __('assignments.grade') }}</th>
                            <th>{{ __('assignments.deadline') }}</th>
                            <th>{{ __('assignments.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $row)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $row->class->level->level_name }}</td>
                                <td>{{ $row->class->class_name }}</td>
                                <td>{{ $row->subject->name }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->task }}</td>
                                <td>{{ $row->grade }}</td>
                                <td>{{ $row->deadline }}</td>
                                <td>
                                    {{-- =============Delate Request========================= --}}
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#exampleModald{{ $loop->index }}">{{ __('assignments.delete') }}
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        {{ __('assignments.delete_assignment') }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="row g-3" method="POST"
                                                          action="{{ route('teacher.assignments.destroy', $row->id) }}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <p>{{ __('materials.sure_delete') }}</p>
                                                        <div class="col-12">
                                                            <label for="inputAddress2"
                                                                   class="form-label">{{ __('materials.title') }}</label>
                                                            <input type="text" class="form-control"
                                                                   id="inputAddress2" name="title" readonly
                                                                   value="{{ $row->title }}">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">{{ __('assignments.close') }}
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-danger">{{ __('assignments.delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- =============Upadate========================= --}}
                                    <a href="{{ route('teacher.assignments.edit', $row->id) }}"
                                       class="btn btn-success btn-sm">{{ __('assignments.update') }}</a>
                                    <a href="{{ route('teacher.assignments.show', $row->id) }}"
                                       class="btn btn-warning btn-sm text-white">
                                        {{ __('assignments.show') }}</a>
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
