@extends('layouts.panel')
@section('upgradeRequest')
    active
@endsection
@section('title')
    درخواست ارتقا
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">درخواست ارتقا</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @if(!Auth::user()->details)
                <div class="alert alert-warning" role="alert">
                    کاربر گرامی لطفا نسبت به تکمیل اطلاعات تکمیلی خود اقدام فرمایید
                    <a href="{{route('user.profile.index')}}" class="btn btn-primary">تکمیل اطلاعات</a>
                </div>
            @elseif(Auth::user()->details)
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header ">
                            <div dir="rtl" class="text-right">
                                <h3 style="float: right" class="card-title ">لیست درخواست های شما</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            @if(!Auth::user()->activeUpgradeRequest)
                                <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create">ثبت
                                    درخواست ارتقا سطح کاربری
                                </button>
                                <!-- Create Modal -->
                                <div class="modal fade" id="modal-create">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">درخواست ارتقا سطح کاربری</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form method="POST" action="{{route('user.upgradeRequest.store')}}"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="card-body">
                                                        <div class="form-group col-12">
                                                            <label for="textarea">متن درخواست</label>
                                                            <textarea type="text"
                                                                      class="form-control @error('last_name') is-invalid @enderror"
                                                                      name="_request" id="textarea" required></textarea>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">ارسال</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                            @endif

                            <table id="table" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th>کد رهگیری</th>
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
                                                    <h4 class="modal-title">درخواست ارتقا</h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- form start -->
                                                    <form method="POST" action="{{route('user.upgradeRequest.update',$request->id)}}"
                                                          enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <!-- /.card-body -->
                                                        <div class="card-body">

                                                            <div class="form-group col-md-12 row">
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap">وضعیت درخواست:</p>
                                                                    @if($request->status == 0)
                                                                        <h5 class="text-warning mx-2">ایجاد شده</h5>
                                                                    @elseif($request->status == 2)
                                                                        <h5 class="text-danger mx-2">رد شده</h5>
                                                                    @elseif($request->status == 1)
                                                                        <h5 class="text-success mx-2">تایید شده</h5>
                                                                    @endif
                                                                </div>
                                                                <div class="col-6 d-flex">
                                                                    <p class="nowrap">تاریخ درخواست:</p>
                                                                    <p class="mx-2">{{\Morilog\Jalali\Jalalian::forge($request->created_at)->format('%A, %d %B %Y')}}</p>
                                                                </div>
                                                                @if($request->description)
                                                                <div class="col-12 d-flex">
                                                                    <p class="nowrap">توضیحات درخواست:</p>
                                                                    <p class="mx-2">{{ decrypt($request->description) }}</p>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label for="textarea">متن درخواست</label>
                                                                <textarea type="text"
                                                                          class="form-control @error('last_name') is-invalid @enderror"
                                                                          name="_request" id="textarea"
                                                                          required>{!! decrypt($request->request) !!}</textarea>
                                                            </div>
                                                        </div>
                                                        @if($request->status == 0)
                                                            <div class="card-footer">
                                                                <button type="submit" class="btn btn-primary">ویرایش
                                                                </button>
                                                            </div>
                                                        @endif
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
            @endif
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
