@extends('admin.layouts')
@section('title')
    افزودن دسته بندی جدید
@endsection

@section('content')
<div class="row">
    <div class="col my-3">
        <h4>    افزودن دسته بندی جدید</h4>
    </div>
</div>
    <div class="row">
        <div class="col">
            <form method="post" action="{{route('admin.categories.store')}}">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col my-3">
                            <lable for="">نام</lable>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
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
                                @foreach(\App\Models\Category::where('parent_id',null)->get() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
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
                            <button type="submit" class="btn btn-sm btn-primary">افزودن دسته بندی جدید</button>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    @endsection
