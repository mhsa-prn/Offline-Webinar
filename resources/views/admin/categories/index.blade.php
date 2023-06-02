@extends('admin.layouts')
@section('title')
    لیست دسته بندی ها
    @endsection

@section('content')
<h3 class="my-3">لیست دسته بندی ها</h3>
<a class="btn btn-primary btn-sm float-end" href="{{route('admin.categories.create')}}">افزودن دسته بندی</a>
<div class="row">
    <div class="col mb-3">
        <form action="{{ route('admin.categories.index') }}" method="get">
            <div class="form-group">
                <div class="row">
                    <div class="col-9">
                        <input type="text" class="form-control" name="search" placeholder="جستجو">
                    </div>
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary"> فیلتر</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>نام والد</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $categories as $category)
                        <tr>
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $category->name }}</td>
                            <td> {{ $category->parent() ?
                                        $category->parent()->name : null }}</td>

                            <td>
                                <form id="form-{{$category->id}}-delete" action="{{route('admin.categories.destroy', $category->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <a href="#" onclick="event.preventDefault();askForDelete({{$category->id}})" class="btn btn-sm btn-danger">حذف</a>
                                <a href="{{route('admin.categories.edit',$category->id)}}" class="btn btn-sm btn-primary">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $categories->appends(['search'=>request()->search]) }}
        </div>
    </div>
    @endsection

@section('script')
    <script>
        function askForDelete(id){
            Swal.fire({
                title: '',
                text: "آیا از حذف کاربر اطمینان دارید؟",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله',
                cancelButtonText: 'خیر' ,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`form-${id}-delete`).submit();

                }
            })
        }


    </script>
    @endsection
