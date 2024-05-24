@extends('layouts.master')

@section('content')
    <style>
        .post-container .btns {
            margin: 20px 2px 0px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .right h4,
        .left h4 {
            cursor: pointer;
            font-size: 17px;
            color: #777;
            text-align: center;
            font-weight: 500;
            position: relative;
        }

        .left .like-container,
        .right .comment-container {
            position: absolute;
            top: 150px;
            left: 310px;
            z-index: 1000;
            background-color: #fcfcfc;
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.15), -5px -5px 5px rgba(0, 0, 0, 0.15);
            border-radius: 3px;
            width: 400px;
            max-height: 400px;
            overflow-y: auto;
            padding: 20px;
            display: none;
        }

        .left .like-container.active,
        .right .comment-container.active {
            display: block;
        }

        .left .like-container .likes-content,
        .right .comment-container .comments-content {
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .left .like-container span,
        .right .comment-container span {
            position: absolute;
            top: -50px;
            right: -20px;
            z-index: 1001;
            width: 40px;
            height: 40px;
            background-color: #ccc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .left .like-container span,
        .right .comment-container span {
            color: #000;
            font-size: 15px;
        }

        .left .like-container h3,
        .right .comment-container h3 {
            text-align: center;
            font-size: 27px;
            font-style: italic;
            color: blue;
        }

        .left .like-container .content {
            display: flex;
            align-items: center;
            justify-content: space-around;
            padding: 20px 0px;
        }

        .right .comment-container .content {
            display: flex;
            align-items: center;
            padding: 20px 0px;
        }

        .left .like-container .content h3,
        .right .comment-container .content h3 {
            font-size: 20px;
            color: #000;
        }

        .right .comment-container .content .single-comment {
            margin-left: 10px;
            padding: 10px;
            background-color: #ccc;
            display: flex;
            flex-direction: column;
            align-items: start;
            border-radius: 5px;
        }

        .left .like-container .content a {
            font-size: 15px;
            color: #000;
            text-decoration: none;
        }

        @media (max-width: 650px) {
            .post-container {
                width: 300px;
            }

            .left .like-container,
            .right .comment-container {
                left: 50px;
                width: 300px;
            }
        }
    </style>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bx bx-home-alt"></i></a>
                            {{ __('sidbar.home') }}
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('posts.posts') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-6 col-md-4">
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                    data-bs-target="#exampleModaladd"><i class="bx bx-plus"></i> {{ __('posts.new_post') }}
                </button>
                <!-- Modal -->
                <div class="modal fade" id="exampleModaladd" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('posts.new_post') }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form class="row g-3" method="POST" action="{{ route('admin.posts.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">{{ __('posts.content') }}</label>
                                        <textarea class="form-control" id="inputAddress2" name="post_content" required placeholder="Enter Message"
                                            rows="3"></textarea>
                                    </div>
                                    <div class="col-12">
                                        <label for="inputAddress2" class="form-label">{{ __('posts.photos') }}</label>
                                        <input type="file" name="images[]" multiple accept="images/*">
                                    </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">{{ __('posts.close') }}
                                </button>
                                <button type="submit" class="btn btn-primary">{{ __('posts.send') }}</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('posts.delete_post') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.posts.destroy', $row->id) }}">
                                                @method('DELETE')
                                                @csrf
                                                <p>{{ __('posts.sure_delete') }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">{{ __('posts.close') }}
                                            </button>
                                            <button type="submit" class="btn btn-danger">{{ __('posts.delete') }}</button>
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
                                            <h5 class="modal-title" id="exampleModalLabel">{{ __('posts.update_post') }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="row g-3" method="POST"
                                                action="{{ route('admin.posts.update', $row->id) }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="col-12">
                                                    <label for="inputAddress2"
                                                        class="form-label">{{ __('posts.content') }}</label>
                                                    <input type="hidden" value="{{ $row->id }}" name="id">
                                                    <textarea class="form-control" id="inputAddress2" name="post_content" required placeholder="Enter Message"
                                                        rows="3">{{ $row->content }}</textarea>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress2"
                                                        class="form-label">{{ __('posts.photos') }}</label>
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
                                                data-bs-dismiss="modal">{{ __('posts.close') }}
                                            </button>
                                            <button type="submit"
                                                class="btn btn-success">{{ __('posts.update') }}</button>
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
                    <div class="btns">
                        <div class="left">
                            <h4>{{ count($row->reactions) }} React</h4>
                            <div class="like-container">
                                <h3>{{ count($row->reactions) }} React</h3>
                                <div class="likes-content">
                                    <span><i class="lni lni-close"></i></span>
                                    @foreach ($row->reactions as $react)
                                        <div class="content">
                                            <div class="profile_img">
                                                <img src="{{ asset($react->reactable->photo) }}" alt="user"
                                                    class="cover">
                                            </div>
                                            <h3>{{ $react->reactable->name }}</h3>
                                            <a href="#">View Profile</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="right">
                            <h4>{{ count($row->comments) }} comments</h4>
                            <div class="comment-container">
                                <h3>{{ count($row->comments) }} comments</h3>
                                <div class="comments-content">
                                    <span><i class="lni lni-close"></i></span>
                                </div>
                                @foreach ($row->comments as $comment)
                                    <div class="content">
                                        <div class="profile_img">
                                            <img src="{{ asset($comment->commentable->photo) }}" alt="user"
                                                class="cover">
                                        </div>
                                        <div class="single-comment">
                                            <h3>{{ $comment->commentable->name }}</h3>
                                            <p>{{ $comment->comment }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{--                    <div class="btns"> --}}
                    {{--                        <div class="left"> --}}
                    {{--                            <h4>{{count($row->reactions)}} like</h4> --}}
                    {{--                        </div> --}}
                    {{--                        <div class="right"> --}}
                    {{--                            <h4>{{count($row->comments)}} comments</h4> --}}
                    {{--                        </div> --}}
                    {{--                    </div> --}}
                </div>
            @empty
                <h1 class="text-center text-danger">{{ __('posts.no_posts') }}</h1>
            @endforelse
            <div>
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection



@push('js')
    <script>
        // likes & comment
        const like = document.querySelector('.left h4');
        const likesContainer = document.querySelector('.left .like-container');
        const comment = document.querySelector('.right h4');
        const commentsContainer = document.querySelector('.right .comment-container');
        const removeLike = document.querySelector('.likes-content span');
        const removeComment = document.querySelector('.comments-content span');

        like.addEventListener('click', () => {
            likesContainer.classList.toggle('active');
            commentsContainer.classList.remove('active');
        });

        removeLike.addEventListener('click', () => {
            likesContainer.classList.remove('active');
        });

        comment.addEventListener('click', () => {
            commentsContainer.classList.toggle('active');
            likesContainer.classList.remove('active');
        });

        removeComment.addEventListener('click', () => {
            commentsContainer.classList.remove('active');
        });
    </script>
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
@endpush
