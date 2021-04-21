
@extends('layouts.panel')
@section('Documents')
    active
@endsection
@section('Translate')
    active
@endsection
@section('title')
    @if(isset($translate)) ویرایش ترجمه @else ایجاد ترجمه @endif
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> @if(isset($translate)) ویرایش ترجمه @else ایجاد ترجمه @endif</h1>
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
                        <h3 class="card-title" style="float: right"> {{$doc->slug}} </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="{{route('translates.update',$doc->id)}}" method="POST">
                            @csrf
                            @method('PATCH')
                            <textarea name="text" id="" cols="30" rows="10">
                                {{$doc->translate->content ?? ''}}
                            </textarea>
                            <div class="mt-3">
                                <button class="btn btn-primary mb-3">
                                    @if(isset($translate)) ویرایش @else ثبت @endif
                                </button>
                            </div>
                        </form>
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
