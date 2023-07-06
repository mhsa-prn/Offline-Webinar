@extends('admin.layouts')
@section('title')
    افزودن وبینار جدید
@endsection

@section('content')

    <h3 class="my-3">افزودن وبینار جدید</h3>
    <form action="{{route('admin.webinars.store')}}" enctype="multipart/form-data" method="post">
        @csrf
        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">عنوان</lable>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{old('title')}}">
                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">توضیحات</lable>
                    <textarea class="form-control @error('description') is-invalid @enderror" type="text" name="description">{{old('description')}}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">قیمت</lable>
                    <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{old('price')}}">
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">عکس</lable>
                    <input class="form-control @error('img') is-invalid @enderror" type="file" name="img">
                    @error('img')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">ویدئو</lable>
                    <input class="form-control @error('video') is-invalid @enderror" type="file" name="video">
                    @error('video')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                    <lable for="">دسته بندی</lable>
                    <select class="form-control @error('category_id') is-invalid @enderror" type="text" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group my-4">
            <div class="row">
                <div class="col">
                   <button class="btn btn-sm btn-primary">ثبت</button>
                </div>
            </div>
        </div>
    </form>



    @endsection
