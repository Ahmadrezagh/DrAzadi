@extends('layouts.panel')
@section('Documents')
    active
@endsection
@section('Document')
    active
@endsection
@section('title')
    {{$content->doc->slug}}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{$content->doc->slug}}</h1>
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
                        <h3 class="card-title" style="float: right" >
                            تاریخ گزارش آگهی : {{\Morilog\Jalali\Jalalian::forge($content->published_date)->format('%A, %d %B %Y')}} - تاریخ اصلاح : @if($content->modified_date) {{\Morilog\Jalali\Jalalian::forge($content->modified_date)->format('%A, %d %B %Y')}} @else - @endif
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="container">
                            <h5>وضعیت کنونی:</h5>
                            <p style="float: left">{{$content->current_description}}</p>
                            <br>
                            <hr>
                            <h5>شرح تجزیه و تحلیل:</h5>
                            <p style="float: left">{{$content->analysis_description}}</p>
                            <br>
                            <hr>
                            <div class="text-left" dir="ltr">
                                <p style="text-align: left">
                                    {{$content->hyperlink}}
                                </p>
                                <div class="table-responsive text-left" dir="ltr" style="direction: ltr !important;">
                                    {!! $content->hyperlink_table !!}
                                </div>
                                <div class="table-responsive text-left" dir="ltr" style="direction: ltr !important;">
                                    {!! $content->technical_table !!}
                                </div>
                                <div class="container" style="background-color: slategrey">
                                    <h5>تغییرات</h5>
                                        {!! $content->change_history !!}
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5>امتیازات گزارش</h5>
                                    </div>
                                    <div class="card-body">

                                        <div class="table-responsive " >

                                            <table id="table" class="table table-bordered table-striped text-center">
                                                <thead>
                                                <tr>
                                                    <th>عنوان</th>
                                                    <th>منبع</th>
                                                    <th>امتیاز</th>
                                                    <th>عنوان امتیاز</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                                                @foreach($content->score as $score)
                                                    <tr>
                                                        <td>{{$score->title}}</td>
                                                        <td>{{$score->source}}</td>
                                                        <td>{{$score->score ?? '-'}}</td>
                                                        <td>{{$score->score_desc ?? '-'}}</td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
