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
                            <td> {{ $user->email_verified_at }}</td>
                            <td> {{ $user->created_at }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-danger">حذف</a>
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
