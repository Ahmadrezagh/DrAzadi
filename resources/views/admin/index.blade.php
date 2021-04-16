
@extends('layouts.panel')
@section('home','active')
@section('title')
    خانه
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">خانه</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{(\App\Models\Doc::count())}}</h3>

                                <p>داکیومنت</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{route('documents.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{count(\App\Models\Content::get())}}</h3>

                                <p>محتوای دریافت شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('documents.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\User::count()}}</h3>
                                <p>کاربران وبسایت</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{route('users.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{count(\App\Models\Score::where('score_desc','=','high')->get())}}</h3>

                                <p>موارد با درجه خطر بالا</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('documents.index')}}?sortByScore=desc" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                @if((Auth::user()->isAdmin() && Auth::user()->can('Documents')) || Auth::user()->isSuperAdmin())
                <div class="card">
                    <div class="card-header">
                        داکیومنت ها
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
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
                            </table>
                        </div>
                    </div>
                </div>
                @endif
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
