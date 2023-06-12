@extends('layouts')

@section('content')
    @include('site-title')

    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        @foreach($webinars as $webinar)
        <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm">
                <div class="card-header py-3">
                    <h4 class="my-0 fw-normal">{{$webinar->title}}</h4>
                </div>
                <div class="card-body">
                    <h1 class="card-title pricing-card-title">
                        @if($webinar->price == 0)
                            <h4 class="text-success">رایگان</h4>
                        @else
                            <h4 class="text-danger">{{$webinar->price}}تومان</h4>
                        @endif
                    </h1>
                    <img height="100px" width="100%" class="mb-3" src="/storage/images/{{$webinar->img}}">
                    <h6>ارائه دهنده: {{$webinar->user->name}} </h6>
                    <h6>تاریخ انتشار: {{jdate($webinar->created_at)->format('d-m-Y')}} </h6>
                    <a href="{{route('webinars.show',$webinar->id)}}" type="button" class="w-100 btn btn-lg
                    btn-outline-primary">مشاهده</a>
                </div>
            </div>
        </div>
            @endforeach
    </div>

    @endsection
