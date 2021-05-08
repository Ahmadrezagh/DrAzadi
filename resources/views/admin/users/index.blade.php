
@extends('layouts.panel')
@section('Users')
    active
@endsection
@section('User')
    active
@endsection
@section('title')
   کاربران
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">کاربران</h1>
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
                            <h3 style="float: right" class="card-title ">کاربران وبسایت</h3>
                        </div>
                    </div>


                    <!-- Change Modal -->
                    <div class="modal fade" id="modal-create">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ساخت کاربر جدید</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- form start -->
                                    <form  method="POST" action="{{route('users.store')}}"  enctype="multipart/form-data">
                                        @csrf
                                        <div class="card-body">
                                            <div class="row ">
                                                <div class="form-group col-6">
                                                    <label for="exampleInputEmail1">نام</label>
                                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" name="first_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام " required>
                                                </div>
                                                <div class="form-group col-6">
                                                    <label for="exampleInputEmail1">نام خانوادگی</label>
                                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}" name="last_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام خانوادگی" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">ایمیل</label>
                                                <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="ایمیل کاربر را وارد کنید" required >
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">رمز عبور</label>
                                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="رمز عبور" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                                <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="تکرار رمز عبور" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">تصویر پروفایل</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleFormControlSelect1">انتخاب نقش</label>
                                                <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                    <option value="0"  selected disabled>انتخاب نقش</option>
                                                    @foreach($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->

                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">ایجاد</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create">ساخت کاربر</button>

                        <table id="table" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>تصویر کاربر</th>
                                <th>نام</th>
                                <th>نقش</th>
                                <th>وضعیت</th>
                                <th>ایمیل</th>
                                <th>تاریخ عضویت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach ($users as $user)
                                <tr>
                                    <td>
                                        <img class="rounded-circle" src="{{URL::to('/').$user->profile()}}" alt="" width="50" height="50">
                                    </td>
                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->role()->first()->name ?? '-'}}</td>
                                    <td>
                                        @if($user->active == 1)
                                            <button data-toggle="modal" data-target="#modal-deactive{{$user->id}}" class="btn btn-success" >فعال</button>
                                        @else
                                            <button data-toggle="modal" data-target="#modal-active{{$user->id}}" class="btn btn-danger"> مسدود </button>
                                        @endif
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td >
                                        <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="{{$user->created_at}}">
                                            {{\Morilog\Jalali\Jalalian::forge($user->created_at)->format('%A, %d %B %Y')}}
                                        </button>
                                    </td>
                                    <td class="text-center">
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-sliders-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#modal-edit{{$user->id}}" ><i  class="fas fa-user-edit"></i>ویرایش</button>
                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{$user->id}}" ><i style="color:red" class="fas fa-user-minus"></i>حذف</button>
                                            </div>
                                    </td>

                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="modal-delete{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">حذف کاربر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>آیا در حذف کاربر  `{{$user->name}}` مطمین هستید؟ </h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                            <form action="{{route('users.destroy',$user->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                                <button type="submit" class="btn btn-danger">حذف</button>

                                            </form>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <!-- /.modal -->
                                <!-- Change Modal -->
                                <div class="modal fade" id="modal-edit{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ویرایش کاربر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form  method="POST" action="{{route('users.update',$user->id)}}"  enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="id" value="{{$user->id}}">
                                                    <div class="card-body">
                                                        <div class="row ">
                                                            <div class="form-group col-6">
                                                                <label for="exampleInputEmail1">نام</label>
                                                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{$user->first_name}}" name="first_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام " required>
                                                            </div>
                                                            <div class="form-group col-6">
                                                                <label for="exampleInputEmail1">نام خانوادگی</label>
                                                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{$user->last_name}}" name="last_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام خانوادگی" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">آدرس ایمیل</label>
                                                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" required value="{{$user->email}}" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">رمز عبور جدید</label>
                                                            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                                            <input type="password" name="re_password" class="form-control" id="exampleInputPassword1" placeholder="Password" >
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">تصویر پروفایل</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" name="img" class="custom-file-input" id="exampleInputFile">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleFormControlSelect1">انتخاب نقش</label>
                                                            <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                                <option value="0"  selected disabled>انتخاب نقش</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role->name}}"
                                                                                @if($role->name == $user->role->pluck('name')->first())
                                                                            selected
                                                                            @endif
                                                                    >{{$role->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->

                                                    <div class="card-footer">
                                                        <button type="submit" class="btn btn-primary">ویرایش</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->

                                <!-- Active Modal -->
                                <div class="modal fade" id="modal-active{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">فعال سازی کاربر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>آیا در فعال سازی کاربر  `{{$user->name}}` مطمین هستید؟ </h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                                                <form action="{{route('users.change.status',$user->id)}}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">فعال سازی</button>

                                                </form>

                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <!-- Active Modal -->
                                <div class="modal fade" id="modal-deactive{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">مسدود سازی کاربر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{route('users.change.status',$user->id)}}" method="POST">
                                            <div class="modal-body">
                                                <h5>آیا در مسدود سازی کاربر  `{{$user->name}}` مطمین هستید؟ </h5>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="message" placeholder="علت مسدود سازی">
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>

                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">مسدود سازی</button>

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
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
