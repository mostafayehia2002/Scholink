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
                        <li class="breadcrumb-item active" aria-current="page">{{ __('visions.visions') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-6 col-md-4">
                {{--                =====================Add================= --}}
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> {{ __('visions.new_vision') }}
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('visions.new_vision') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3" method="POST" action="{{ route('admin.visions.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">{{ __('visions.content') }}</label>
                                        <textarea class="form-control" id="inputAddress2" name="vision_content" required
                                            placeholder="{{ __('visions.enter_content') }}" rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">{{ __('visions.photos') }}</label>
                                        <input type="file" name="images[]" multiple accept="images/*">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('visions.close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ __('visions.send') }}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="posts">
            @forelse($data as $row)
                <div class="post-container">
                    <div class="top">
                        <div class="user_details">
                            <div class="profile_img">
                                <img src="{{ asset('uploads/students/profile.jpg') }}" alt="user" class="cover" />
                            </div>
                            <h3>
                                {{ $row->admin->name }}<br /><span class="role">admin</span>
                                <span class="date">{{ $row->created_at }}</span>
                                <span class="globDot">.</span>
                            </h3>
                        </div>
                        <div>
                            {{-- =============Delate Request========================= --}}
                            <button type="button" class="btn btn-danger btn-sm text-center" data-bs-toggle="modal"
                                data-bs-target="#exampleModald{{ $loop->index }}"><i class="bx bxs-trash"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModald{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ __('visions.delete_vision') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.visions.destroy', $row->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <p>{{ __('visions.sure_delete') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('visions.close') }}
                                            </button>
                                            <button type="submit"
                                                class="btn btn-danger">{{ __('visions.delete') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            {{-- =============Upadate========================= --}}
                            <button type="button" class="btn btn-primary btn-sm text-center" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $loop->index }}"><i class="bx bxs-edit"></i>
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $loop->index }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ __('visions.update_vision') }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.visions.update', $row->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-12">
                                                    <label for="inputAddress2"
                                                        class="form-label">{{ __('visions.contnet') }}</label>
                                                    <input type="hidden" value="{{ $row->id }}" name="id">
                                                    <textarea class="form-control" id="inputAddress2" name="vision_content" required
                                                        placeholder="{{ __('visions.enter_content') }}" rows="3">{{ $row->content }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress2"
                                                        class="form-label">{{ __('visions.photos') }}</label>
                                                    <input type="file" name="images[]" multiple accept="images/*">
                                                </div>
                                                <div class="col-12">
                                                    @foreach ($row->photos as $image)
                                                        <img style="width: 50px;height: 50px;border-radius: 50%"
                                                            src="{{ $image->name }}">
                                                    @endforeach
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('visions.close') }}
                                            </button>
                                            <button type="submit"
                                                class="btn btn-success">{{ __('visions.update') }}</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                    <p>{{ $row->content }}</p>
                    @if (count($row->photos))
                        <div class="images-container swiper">
                            <div class="imgage-content swiper-wrapper">
                                @foreach ($row->photos as $photo)
                                    <img src="{{ $photo->name }}" alt="" class="swiper-slide" />
                                @endforeach
                            </div>
                            <div class="swiper-button-prev prev"></div>
                            <div class="swiper-button-next next"></div>
                        </div>
                    @endif

                </div>

            @empty
                <h1 class="text-center text-danger">{{ __('visions.no_visions') }}</h1>
            @endforelse
            <div>
                {{ $data->links() }}
            </div>
        </div>


    </div>
@endsection



@push('js')
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
