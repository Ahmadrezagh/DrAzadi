
@extends('layouts.panel')
@section('profile')
    active
@endsection
@section('title')
    پروفایل
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">پروفایل</h1>
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
                        <form action="{{route('profile.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="row ">
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1">نام</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" value="{{Auth::user()->first_name}}" name="first_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام " required>
                                </div>
                                <div class="form-group col-6">
                                    <label for="exampleInputEmail1">نام خانوادگی</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" value="{{Auth::user()->last_name}}" name="last_name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="نام خانوادگی" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ایمیل</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user()->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ایمیل" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">رمز عبور</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"  id="exampleInputPassword1" placeholder="رمز عبور" >
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">تکرار رمز عبور</label>
                                <input type="password" name="re_password" class="form-control @error('re_password') is-invalid @enderror"  id="exampleInputPassword1" placeholder="تکرار رمز عبور" >
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
                                <label for="inputState">درجه آسیب پذیری پیش فرض</label>
                                <select name="default" id="inputState" class="form-control">
                                    <option value="0" disabled selected>انتخاب</option>
                                    <option value="1" @if(Auth::user()->default && Auth::user()->default->type == 1 ) selected @endif >کم</option>
                                    <option value="2" @if(Auth::user()->default && Auth::user()->default->type == 2 ) selected @endif >متوسط</option>
                                    <option value="3" @if(Auth::user()->default && Auth::user()->default->type == 3 ) selected @endif >بالا</option>
                                    <option value="0">بدون دسته بندی</option>

                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">ویرایش</button>
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
