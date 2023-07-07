@extends('admin.layouts')
@section('title')
    ویرایش وبینار
@endsection

@section('content')
<div class="row">
    <div class="col my-3">
        <h4>ویرایش وبینار</h4>
    </div>
</div>
    <div class="row">
        <div class="col my-3">
            <form method="post" action="{{route('admin.webinars.update', $webinar->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">تصویر وبینار:</lable> &nbsp;
                            <img src="{{env('APP_URL').'/storage/images/'.$webinar->img}}" width="300px" height="200px" />
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">عنوان وبینار</lable>
                            <input type="text" class="form-control  @error('title') is-invalid @enderror" name="title" value="{{$webinar->title}}">
                            @error('title')
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
                            <lable for="">توضیحات</lable>
                            <textarea type="text" class="form-control  @error('description') is-invalid @enderror" name="description" >{{$webinar->description}}</textarea>
                            @error('description')
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
                            <lable for="">قیمت وبینار</lable>
                            <input type="text" class="form-control" name="price" value="{{$webinar->price}}" disabled>
                        </div>
                    </div>
                </div>

                <div class="form-group my-4">
                    <div class="row">
                        <div class="col">
                            <lable for="">دسته بندی</lable>
                            <select class="form-control @error('category_id') is-invalid @enderror" type="text" name="category_id">
                                @foreach(\App\Models\Category::all() as $category)
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
