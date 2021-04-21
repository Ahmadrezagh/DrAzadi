
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
                    @if(Auth::user()->can('doc_count'))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{\App\Models\Content::count()}}</h3>

                                <p>محتوای دریافت شده</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{route('user.documents.index')}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->can('doc_count_low'))
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','low')->count()}}</h3>

                                <p>موارد با درجه خطر کم</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.documents.index')}}?key=low&SearchOptions%5B%5D=6" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->can('doc_count_medium'))
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','medium')->count()}}</h3>
                                <p>موارد با درجه خطر متوسط</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.documents.index')}}?key=medium&SearchOptions%5B%5D=6" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    @endif
                    @if(Auth::user()->can('doc_count_high'))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','high')->count()}}</h3>

                                <p>موارد با درجه خطر بالا</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.documents.index')}}?key=high&SearchOptions%5B%5D=6" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                </div>
                <!-- /.row -->


            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
