
@extends('layouts.panel')
@section('admins')
    active
@endsection
@section('new_admin')
    active
@endsection
@section('title')
    ساخت مدیر جدید
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">مدیر جدید</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6 jumbotron  ">
                        <form action="{{route('admin.store')}}" method="POST">
                            @csrf
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
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">رمز عبور</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  id="exampleInputPassword1" placeholder="رمز عبور" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                <input type="password" name="re_password" class="form-control @error('re_password') is-invalid @enderror"  id="exampleInputPassword1" placeholder="تکرار رمز عبور" required>
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
                            <button type="submit" class="btn btn-primary">ایجاد</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
