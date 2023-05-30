@extends('admin.layouts')
@section('title')
    لیست کاربران
@endsection

@section('content')
    <div class="row">
        <div class="col">
            <form action="{{route('admin.users.update', $user->id)}}" method="post">
                @csrf
                @method('patch')

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <label>نام</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
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
                        <div class="col">
                            <label>ایمیل</label>
                            <input type="text" class="form-control" disabled value="{{$user->email}}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-sm btn-primary" type="submit">بروزرسانی</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
