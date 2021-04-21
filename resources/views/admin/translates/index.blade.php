
@extends('layouts.panel')
@section('Documents')
    active
@endsection
@section('Translate')
    active
@endsection
@section('title')
    ترجمه ها
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">ترجمه ها</h1>
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
                        <h3 class="card-title" style="float: right">داکیومنت های ترجمه شده</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <a href="{{route('translates.create')}}" class="btn btn-primary" >ایجاد ترجمه جدید</a>

                        <table id="table" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>نام داکیومنت</th>
                                <th>عملیات</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach ($translates as $translate)
                                <tr>
                                    <td>
                                        {{$translate->document->slug}}
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-sliders-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            <button type="button" class="btn btn-success dropdown-item" data-toggle="modal" data-target="#modal-edit{{$translate->id}}" >ویرایش</button>
                                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#modal-delete{{$translate->id}}" >حذف</button>
                                        </div>
                                    </td>

                                </tr>
                                <!-- Delete Modal -->
                                <div class="modal fade" id="modal-delete{{$translate->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">حذف ترجمه</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h5>Are you sure to delete `{{$translate->name}}` ?</h5>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                                                <form action="{{route('translates.destroy',$translate->id)}}" method="POST">
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
