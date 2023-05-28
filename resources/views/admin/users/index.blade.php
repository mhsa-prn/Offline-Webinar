@extends('admin.layouts')
@section('title')
    لیست کاربران
    @endsection

@section('content')
<h3 class="my-3">لیست کاربران</h3>
    <div class="row">
        <div class="col">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ردیف</th>
                        <th>نام</th>
                        <th>ایمیل</th>
                        <th>وضعیت ایمیل</th>
                        <th>تاریخ ثبت نام</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td> {{ $loop->index + 1 }}</td>
                            <td> {{ $user->name }}</td>
                            <td> {{ $user->email }}</td>
                            <td>
                                @if ($user->email_verified_at)
                                    <i class="fa-solid fa-check text-success"></i>
                                    @else
                                        <i class="fa-solid fa-times-circle text-danger"></i>
                                @endif
                            </td>
                            <td> {{ jdate($user->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <form id="form-{{$user->id}}-delete" action="{{route('admin.users.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <a href="#" onclick="event.preventDefault();askForDelete({{$user->id}})" class="btn btn-sm btn-danger">حذف</a>
                                <a href="#" class="btn btn-sm btn-primary">ویرایش</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->render() }}
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
