@extends('layouts.master')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Announcements</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="row">
            <div class="col-6 col-md-4">
                {{-- =====================Add================= --}}
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> Add New Announcement
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add
                                    Announcement</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3" method="POST" action="{{ route('admin.announcements.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputEmail" class="form-label">Subcategory</label>
                                        <select class="form-select mb-3" name="subcategory_id" id="select_status" required
                                            aria-label="Default select example">
                                            <option selected disabled>Select Subcategory</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Price</label>
                                        <input type="number" step="any" min="0" name="price" value=""
                                            required class="form-control">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">Photo</label>
                                        <input type="file" name="photo" accept="images/*">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close
                                </button>
                                <button type="submit" class="btn btn-primary">Send</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="posts">
            @forelse($data as $ann)
                {{--              @foreach ($row->announcements as $ann) --}}
                <div class="post-container">
                    <div class="top">
                        <div class="user_details">
                            <div class="profile_img">
                                <img src="{{ asset('uploads/students/profile.jpg') }}" alt="user" class="cover" />
                            </div>
                            <h3>
                                {{ $ann->admin->name }}<br /><span class="role">{{ $ann->admin->name }}</span>
                                <span class="date">{{ $ann->created_at }}</span>
                                <br>
                                <span class="globDot">{{ $ann->price }}.</span>
                            </h3>
                        </div>
                        <div>
                            {{--                                =============Delate Request========================= --}}
                            <button type="button" class="btn btn-danger btn-sm text-center" data-bs-toggle="modal"
                                data-bs-target="#exampleModald{{ $loop->index }}"><i class="bx bxs-trash"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.announcements.destroy', $ann->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <p>Are You Sure Delete Announcement</p>

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

                            {{--                                =============Upadate========================= --}}
                            <button type="button" class="btn btn-primary btn-sm text-center" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $loop->index }}"><i class="bx bxs-edit"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.announcements.update', $ann->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="col-12">
                                                    <label for="inputEmail" class="form-label">Subcategory</label>
                                                    <select class="form-select mb-3" name="subcategory_id"
                                                        id="select_status" required aria-label="Default select example">
                                                        @foreach ($categories as $category)
                                                            <option @selected($category->id == $ann->subcategory_id)
                                                                value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress2" class="form-label">Price</label>
                                                    <input type="number" step="any" min="0" name="price"
                                                        value="{{ $ann->price }}" required class="form-control">
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress2" class="form-label">Photos</label>
                                                    <input type="file" name="photo" accept="images/*">
                                                </div>
                                                <div class="col-12">
                                                    <img style="width: 50px;height: 50px;border-radius: 50%"
                                                        src="{{ asset($ann->photo) }}">
                                                </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <p>{{ $ann->content }}</p>
                    <div class="images-container">
                        <div class="imgage-content ">
                            <img src="{{ asset($ann->photo) }}" alt="" class="swiper-slide" />
                        </div>
                    </div>
                </div>
                {{--              @endforeach --}}

            @empty
                <h1 class="text-center text-danger">No Announcements Found</h1>
            @endforelse


            {{--            <div> --}}
            {{--                {{$data->links()}} --}}
            {{--            </div> --}}
        </div>


    </div>
@endsection


@push('js')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
