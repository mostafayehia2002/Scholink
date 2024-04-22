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
                        <li class="breadcrumb-item active" aria-current="page">{{__('sidbar.attendance')}}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

       <form method="POST" action="{{route('teacher.attendance.absence',$class_id)}}">
           @csrf
           <div class="card p-5">
               @foreach ($data as $row)
                   <div class="col-3">
                       <div class="form-check">
                           <input class="form-check-input checkSingle font-22" type="checkbox" name="students_id[]"
                                  value="{{ $row->id }}" id="flexCheckDefault{{ $row->id }}">
                           <label class="form-check-label font-22" for="flexCheckDefault{{ $row->id }}">
                               {{$row->name}}
                           </label>
                       </div>
                   </div>
               @endforeach

               <div class="col-12 mt-3">
                   <button type="submit" class="btn btn-primary px-5">{{__('attendance.save')}}</button>
               </div>
           </div>
       </form>
    </div>
@endsection

