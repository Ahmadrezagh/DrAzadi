
@extends('layouts.panel')
@section('admins')
    active
@endsection
@section('admins_list')
    active
@endsection
@section('title')
    مدیر ها
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">مدیر ها</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">مدیران وبسایت</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <a href="{{route('admin.create')}}" class="btn btn-primary mb-3" >ایجاد مدیر جدید</a>
                        <table id="table" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>پروفایل کاربری</th>
                                <th>نام</th>
                                <th>ایمیل</th>
                                <th>نقش</th>
                                <th>تاریخ ثبت نام</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach (\App\Models\User::where('id',Auth::user()->id)->get() as $user)
                                <tr>
                                    <td>
                                        <img class="rounded-circle" src="{{URL::to('/').$user->profile()}}" alt="" width="50" height="50">
                                    </td>

                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach ($user->role as $r)
                                            {{$r->name}}
                                        @endforeach
                                    </td>
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
                                            <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#modal-edit{{$user->id}}" ><i  class="fas fa-user-edit"></i> ویرایش</button>
                                        </div>
                                    </td>

                                </tr>
                                <!-- /.modal -->
                                <!-- /.modal -->
                                <!-- Change Modal -->
                                <div class="modal fade" id="modal-edit{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">ویرایش مدیر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form  method="POST" action="{{route('admin.update',$user->id)}}"  enctype="multipart/form-data">
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
                                                            <label for="exampleInputEmail1">ایمیل</label>
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
                                                            <label for="exampleFormControlSelect1">انتخاب نقش</label>
                                                            <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                                <option value="0"  selected disabled>انتخاب نقش</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role->name}}"
                                                                            @if($user->role)
                                                                            {{-- {{dd($user->role->pluck('name')->first())}} --}}
                                                                            @if($role->name == $user->role->pluck('name')->first())
                                                                            selected
                                                                        @endif
                                                                        @endif
                                                                    >{{$role->name}}</option>
                                                                @endforeach
                                                            </select>
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



                            @endforeach

                            @foreach ($admins as $user)
                                <tr>
                                    <td>
                                        <img class="rounded-circle" src="{{URL::to('/').$user->profile()}}" alt="" width="50" height="50">
                                    </td>

                                    <td>
                                        {{$user->name}}
                                    </td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach ($user->role as $r)
                                            {{$r->name}}
                                        @endforeach
                                    </td>
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

                                                <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#modal-edit{{$user->id}}" ><i  class="fas fa-user-edit"></i> ویرایش </button>
                                                <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{$user->id}}" ><i style="color:red" class="fas fa-user-minus"></i> حذف </button>
                                            </div>
                                    </td>

                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="modal-delete{{$user->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">حذف مدیر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>آیا در حذف مدیر  `{{$user->name}}` مطمین هستید؟ </h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <form action="{{route('admin.destroy',$user->id)}}" method="POST">
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
                                                <h4 class="modal-title">ویرایش مدیر</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form start -->
                                                <form  method="POST" action="{{route('admin.update',$user->id)}}"  enctype="multipart/form-data">
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
                                                            <label for="exampleInputEmail1">ایمیل</label>
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
                                                            <label for="exampleFormControlSelect1">انتخاب نقش</label>
                                                            <select class="form-control" name="role" id="exampleFormControlSelect1">
                                                                <option value="0"  selected disabled>انتخاب نقش</option>
                                                                @foreach($roles as $role)
                                                                    <option value="{{$role->name}}"
                                                                        @if($user->role)
                                                                        {{-- {{dd($user->role->pluck('name')->first())}} --}}
                                                                        @if($role->name == $user->role->pluck('name')->first())
                                                                        selected
                                                                        @endif
                                                                        @endif
                                                                        >{{$role->name}}</option>
                                                                @endforeach
                                                            </select>
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
