
@extends('layouts.panel')
@section('Documents')
    active
@endsection
@section('Document')
    active
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">داکیومنت</h1>
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
                        <h3 class="card-title" style="float: right">داکیومنت ها</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-create">بروزرسانی لیست داکیومنت ها</button>

                        <!-- Create Modal -->
                        <div class="modal fade" id="modal-create">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">بروزرسانی لیست</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- form start -->
                                        بروزرسانی لیست داکیومنت ها بدلیل این که اسکریپ دیتا رخ می دهد ممکن است نظم دیتا های دیتابیستان را به هم بریزد
                                        عواقب این کار با شخص خودتان است
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{route('docs.update')}}" class="btn btn-primary">بروزرسانی</a>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->

                        <table id="Mytable" class="table table-bordered table-striped text-center">
                            <thead>
                            <tr>
                                <th>شناسه پایگاه داده</th>
                                <th>نام</th>
                                <th>سال</th>
                                <th>ماه</th>
                                <th>منبع</th>
                                <th>لینک منبع</th>
                                <th>امتیاز پایه</th>
                                <th>درجه کیفی</th>
                            </tr>
                            </thead>
                            <tbody >
                            @foreach ($documents as $doc)
                                <tr>
                                    <td>{{$doc->id}}</td>
                                    <td>
                                        <a href="{{route('documents.show',$doc->id)}}">{{$doc->slug}}</a>
                                    </td>
                                    <td>{{$doc->year}}</td>
                                    <td>{{\Carbon\Carbon::create()->month(2)->format('M')}}</td>
                                    <td><p>sadsaads</p></td>
                                    <td><a class="btn btn-primary" href="{{$doc->nvd_url ?? '#'}}">مشاهده</a></td>
                                </tr>
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
@section('js')
    <script>
        $(function () {
            $("#Mytable").DataTable({
                "responsive": true,
                "autoWidth": false,
                "rtl" : true,
                "language": {
                    "paginate": {
                        "previous": "قبلی",
                        "next" : "بعدی"
                    },
                    "sLengthMenu": "تعداد رکورد در صفحه _MENU_ ",
                    "sSearch" : "جستجو:",
                    "emptyTable":     "هیچ داده ای برای نمایش موجود نیست",
                    "info":           "نمایش _START_ تا _END_ از _TOTAL_ رکورد",
                    "infoEmpty":      "نمایش 0 تا 0 از 0 رکورد",

                    "infoFiltered":   "(نتیجه جستجو بین _MAX_ رکورد)",
                    "zeroRecords":    "اطلاعاتی مبنی بر جستجو شما موجود نیست...",
                },
                "processing": true,
                "serverSide": true,
                "ajax": "{{route('docs.api')}}",
                "columns": [
                    { "data": "id" },
                    { "data": "slug" },
                    { "data": "year" },
                    { "data": "month" },
                    { "data" : "source"},
                    { "data": "nvd_url" },
                    { "data" : "score" },
                    { "data" : "score_desc"}
                ]

            });
        });
    </script>
@endsection
