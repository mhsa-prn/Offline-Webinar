@extends('layouts.app')
@section('title')
    وبینارهای من
    @endsection

@section('content')

<div class="row">
    <div class="col mb-3">
        <h3 class="my-3">لیست وبینارهای ایجاد شده توسط من</h3>

        @if ($wallet == null)
            <h6> مبلغ کیف پول من: 0 تومان</h6>
        @else
            <h6>مبلغ کیف پول من: {{$wallet}}
                تومان</h6>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>

        @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
        @endif

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
                        <th>وضعیت پرداخت</th>
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
                            <td>
                                @if($webinar->confirmed)
                                    <span class="text-success">پرداخت شده</span>
                                @else
                                    <a href="{{route('payment.pay',$webinar->id)}}" class="btn btn-warning btn-sm">لینک پرداخت</a>
                                @endif
                            </td>
                            <td> {{ $webinar->price }}</td>
                            <td style="text-align: center"> <img src="{{env('APP_URL').'/storage/images/'.$webinar->img}}" width="200px" height="100px" /></td>
                            <td> <a href="{{URL::temporarySignedRoute(
    'webinars.download', now()->addMinutes(30), ['user'=>auth()->id(),'path'=>"/videos/{$webinar->video}"]
)}}"
                                    class="btn btn-sm btn-primary">لینک دانلود</a></td>
                            <td> {{ jdate($webinar->created_at)->format('Y-m-d') }}</td>
                            <td>
                                <form id="form-{{$webinar->id}}-delete" action="{{route('webinars.destroy', $webinar->id)}}" method="post">
                                    @csrf
                                    @method('delete')
                                </form>
                                <a href="#" onclick="event.preventDefault();askForDelete({{$webinar->id}})" class="btn btn-sm btn-danger">حذف</a>
                                <a href="{{route('webinars.edit',$webinar->id)}}" class="btn btn-sm btn-primary">ویرایش</a>
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
                text: "آیا از حذف وبینار اطمینان دارید؟",
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



