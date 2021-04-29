@extends('layouts.panel')
@section('upgradeRequest')
    active
@endsection
@section('title')
    درخواست های ارتقا
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">درخواست ها ارتقا</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header ">
                            <div dir="rtl" class="text-right">
                                <h3 style="float: right" class="card-title ">لیست درخواست های کاربران</h3>
                            </div>
                        </div>
                        <div class="card-body">

                            <table id="table" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>کد رهگیری</th>
                                    <th>نام کاربر</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    <th>عملیات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($requests as $request)
                                    <tr>
                                        <td>
                                            {{$request->id}}
                                        </td>
                                        <td>{{$request->user->name}}</td>
                                        <td>
                                            @if($request->status == 0)
                                                <button class="btn btn-warning">ایجاد شده</button>
                                            @elseif($request->status == 2)
                                                <button class="btn btn-danger">رد شده</button>
                                            @elseif($request->status == 1)
                                                <button class="btn btn-success">تایید شده</button>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top"
                                                    title="{{$request->created_at}}">
                                                {{\Morilog\Jalali\Jalalian::forge($request->created_at)->format('%A, %d %B %Y')}}
                                            </button>
                                        </td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modal-edit{{$request->id}}">نمایش
                                            </button>
                                        </td>

                                    </tr>

                                    <!-- /.modal -->
                                    <!-- Change Modal -->
                                    <div class="modal fade" id="modal-edit{{$request->id}}">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">{{$request->user->name}}</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form method="POST" action="{{route('upgradeRequest.update',$request->id)}}"
                                                          enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <!-- /.card-body -->
                                                        <div class="card-body">

                                                            <div class="form-group col-md-12 row">
                                                                @if($request->user->details)
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> کد ملی:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->national_code)}}</h5>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> شهر:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->city)}}</h5>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> ارگان:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->organization)}}</h5>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> سمت از سوی ارگان:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->position)}}</h5>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> شماره تماس:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->phone)}}</h5>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap"> ایمیل اعلانات:</p>
                                                                    <h5 class="mx-2">{{decrypt($request->user->details->mail)}}</h5>
                                                                </div>
                                                                @else
                                                                    <div class="col-6 d-flex">
                                                                        <p class="nowrap"> اطلاعات تکمیلی:</p>
                                                                        <h5 class="mx-2">تکمیل نشده است</h5>
                                                                    </div>
                                                                @endif
                                                                <div class="form-group col-6">
                                                                    <label for="exampleFormControlSelect1">وضعیت</label>
                                                                    <select class="form-control" name="status" id="exampleFormControlSelect1">
                                                                        <option value="0" @if($request->status == 0) selected @endif>ایجاد شده</option>
                                                                        <option value="1" @if($request->status == 1) selected @endif>تایید شده</option>
                                                                        <option value="2" @if($request->status == 2) selected @endif>رد شده</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap">تاریخ درخواست:</p>
                                                                    <p class="mx-2">{{\Morilog\Jalali\Jalalian::forge($request->created_at)->format('%A, %d %B %Y')}}</p>
                                                                </div>
                                                                    <div class="form-group col-12">
                                                                        <label for="exampleFormControlInput1">توضیحات تکمیلی</label>
                                                                        <input type="text" name="desc" class="form-control" value="{{decrypt($request->description)}}" id="exampleFormControlInput1" placeholder="توضیحات تکمیلی راجب وضعیت درخواست">
                                                                    </div>

                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label for="textarea">متن درخواست</label>
                                                                <textarea type="text"
                                                                          class="form-control @error('last_name') is-invalid @enderror"
                                                                          name="_request" id="textarea"
                                                                          required>{!! decrypt($request->request) !!}</textarea>
                                                            </div>
                                                        </div>
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary">ویرایش
                                                                </button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <!-- /.modal -->


                                @endforeach

                            </table>
                        </div>
                    </div>

                    <!-- /.row -->

                </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
