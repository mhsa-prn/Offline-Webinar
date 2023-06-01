@extends('admin.layouts')
@section('title')
    ویرایش دسته بندی
@endsection

@section('content')
<div class="row">
    <div class="col my-3">
        <h4>ویرایش دسته بندی</h4>
    </div>
</div>
    <div class="row">
        <div class="col">
            <form method="post" action="{{route('admin.categories.update', $category->id)}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">نام</lable>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{$category->name}}">
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
                            <lable for="">والد</lable>
                            <select class="form-control @error('parent_id') is-invalid @enderror" name="parent_id">
                                <option value="{{null}}">بدون والد</option>
                                @foreach(\App\Models\Category::all() as $cat)
                                    <option {{$category->parent_id == $cat->id ? "selected" : ""}}
                                        value="{{$cat->id}}">{{$cat->name}}</option>
                                @endforeach
                            </select>
                            @error('parent_id')
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
