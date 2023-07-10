@extends('layouts')
@section('content')
    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
        <div class="col-12">
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session('error')}}</div>
                @endif
            <h4 class="my-3 fw-normal">{{$webinar->title}}</h4>
            <img height="300px" width="100%" class="mb-3" src="/storage/images/{{$webinar->img}}">
                
            @if($webinar->price == 0)
                <h4 class="text-success">رایگان</h4>
            @else
                <h4 class="text-danger">{{$webinar->price}} تومان</h4>
            @endif
            <h6>ارائه دهنده: {{$webinar->user->name}} </h6>
                <h6>دسته بندی: {{$webinar->category->name}} </h6>
            <h6>تاریخ انتشار: {{jdate($webinar->created_at)->format('d-m-Y')}} </h6>
            <h6 style="text-align: justify">{{$webinar->description}}</h6>
            @if($webinar->members->contains(auth()->user()) || $webinar->creator_id==auth()->id())

                    <a href="{{URL::temporarySignedRoute(
    'webinars.download', now()->addMinutes(30), ['user'=>auth()->id(),'path'=>"/videos/{$webinar->video}"]
)}}" class="btn btn-success btn-sm">لینک دانلود</a>
            @else
                @if($webinar->price ==0 )
                    <a href="{{route('webinar.free.register',$webinar->id)}}" class="btn btn-sm btn-danger">ثبت نام
                        رایگان</a>
                @else
                    <a href="{{route('payment.pay',['for'=>'membership','webinar'=>$webinar])}}" class="btn btn-sm
                    btn-danger">ثبت نام</a>
                @endif
            @endif
        </div>
    </div>
    @endsection
