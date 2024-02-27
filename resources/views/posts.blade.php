@extends('layouts.master')

@section('content')

    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                            Home
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Posts</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="posts">
            <div class="post-container">
                <div class="top">
                    <div class="user_details">
                        <div class="profile_img">
                            <img src="images/profile.jpg" alt="user" class="cover" />
                        </div>
                        <h3>
                            Mostafa Maher<br /><span class="role">admin</span>
                            <span class="date">2024-02-20</span>
                            <span class="globDot">.</span>
                        </h3>
                    </div>
                    <div class="dot">
                        <i class="fa-solid fa-ellipsis"></i>
                        <div class="operation">
                            <a href="#">Update</a>
                            <a href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <h4 class="caption-post">Captain Post</h4>
                <div class="images-container swiper">
                    <div class="imgage-content swiper-wrapper">
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                    </div>
                    <div class="swiper-button-prev prev"></div>
                    <div class="swiper-button-next next"></div>
                </div>
                <div class="btns">
                    <div class="left">
                        <h4>499 like</h4>
                    </div>
                    <div class="right">
                        <h4>919 comments</h4>
                    </div>
                </div>
            </div>
            <div class="post-container">
                <div class="top">
                    <div class="user_details">
                        <div class="profile_img">
                            <img src="images/profile.jpg" alt="user" class="cover" />
                        </div>
                        <h3>
                            Mostafa Maher<br /><span class="role">user</span>
                            <span class="date">2024-02-20</span>
                            <span class="globDot">.</span>
                        </h3>
                    </div>
                    <div class="dot">
                        <i class="fa-solid fa-ellipsis"></i>
                        <div class="operation">
                            <a href="#">Update</a>
                            <a href="#">Delete</a>
                        </div>
                    </div>
                </div>
                <h4 class="caption-post">Captain Post</h4>
                <div class="images-container swiper">
                    <div class="imgage-content swiper-wrapper">
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                        <img src="./images/gallery-02.png" alt="" class="swiper-slide" />
                    </div>
                    <div class="swiper-button-prev prev"></div>
                    <div class="swiper-button-next next"></div>
                </div>
                <div class="btns">
                    <div class="left">
                        <h4>499 like</h4>
                    </div>
                    <div class="right">
                        <h4>919 comments</h4>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('js')
    <script src="{{asset('js/swiper-bundle.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
@endpush
