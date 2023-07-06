@extends('layouts.app')
@section('title')
    ویرایش اطلاعات کاربری
@endsection

@section('content')

<div class="row">
    <div class="col my-3">
        <h4>ویرایش اطلاعات کاربری</h4>
    </div>
</div>
    <div class="row">
        <div class="col my-3">
            <form method="post" action="{{route('users.update', auth()->id())}}">
                @csrf

                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">نام</lable>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                   name="name" value="{{$user->name}}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">ایمیل</lable>
                            <input type="text" class="form-control"
                                   name="title" value="{{$user->email}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <button type="submit" class="btn btn-sm btn-primary">ویرایش</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @endsection
