@extends('admin.layouts')
@section('title')
    لیست کاربران
    @endsection

@section('content')
<h3 class="my-3">لیست وبینارها</h3>
<div class="row">
    <div class="col mb-3">
        <form action="{{ route('admin.users.index') }}" method="get">
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
                        <th>عنوان</th>
                        <th>سازنده</th>
                        <th>قیمت</th>
                        <th>عکس</th>
                        <th>ویدئو</th>
                        <th>تاریخ انتشار</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($webinars as $webinar)
                        <tr>
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $webinar->title }}</td>
                            <td> {{ $webinar->user->name }}</td>
                            <td> {{ $webinar->price }}</td>
                            <td> {{ $webinar->img }}</td>
                            <td> {{ $webinar->video }}</td>
                            <td> {{ jdate($webinar->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <form id="form-{{$webinar->id}}-delete" action="{{route('admin.webinars.destroy', $webinar->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <a href="#" onclick="event.preventDefault();askForDelete({{$webinar->id}})" class="btn btn-sm btn-danger">حذف</a>
                                <a href="{{route('admin.webinars.edit',$webinar->id)}}" class="btn btn-sm btn-primary">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $webinars->appends(['search'=>request()->search]) }}
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
