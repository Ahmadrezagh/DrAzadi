
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
                                <h3>{{\App\Models\Content::count()}}</h3>

                                <p>کل آسیب پذیری های گزارش شده</p>
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
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','low')->count()}}</h3>
                                <p>آسیب پذیری های با شدت کم</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('pageType',1)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','medium')->count()}}</h3>
                                <p>آسیب پذیری های با شدت متوسط</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('pageType',2)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{\App\Models\Score::where('score_desc','=','high')->count()}}</h3>
                                <p>آسیب پذیری های با شدت بالا</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('pageType',3)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">داکیومنت ها</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body row">
                        <div class="col-md-12 mb-3">
                            <form action="{{url()->full()}}" class="col-md-12 row">
                                <div class="col-3">
                                    <input type="text" class="form-control mb-3" name="key" placeholder="جستجو" value="{{Request::query('key')}}">
                                </div>
                                <div class="col-1">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class=" col-12 row">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="1"  id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(1,request()->SearchOptions)) checked @endif >
                                        <label class="form-check-label" for="defaultCheck1">
                                            شناسه پایگاه داده
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="2" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(2,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            نام
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="3" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(3,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            سال
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="4" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(4,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            ماه
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="7" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(7,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            منبع
                                        </label>
                                    </div>
                                    @if(!Auth::user()->default)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="5" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(5,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            امتیاز پایه
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="6" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(6,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            درجه کیفی
                                        </label>
                                    </div>
                                        @endif
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <table id="Mytable" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    <th><a @if(request()->sortById && request()->sortById == 'asc' ) href="?sortById=desc" @else href="?sortById=asc" @endif >شناسه پایگاه داده</a></th>
                                    <th><a @if(request()->sortByName && request()->sortByName == 'asc' ) href="?sortByName=desc" @else href="?sortByName=asc" @endif >نام</a></th>
                                    <th><a @if(request()->sortByYear && request()->sortByYear == 'asc' ) href="?sortByYear=desc" @else href="?sortByYear=asc" @endif >سال</a></th>
                                    <th><a @if(request()->sortByMonth && request()->sortByMonth == 'asc' ) href="?sortByMonth=desc" @else href="?sortByMonth=asc" @endif >ماه</a></th>
                                    <th><a href="#">منبع</a></th>
                                    <th><a href="#">لینک منبع</a></th>
                                    <th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif>امتیاز پایه</a></th>
                                    <th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif  >درجه کیفی</a></th>
                                    @if ((Auth::user()->isAdmin() && Auth::user()->can('Documents')) || Auth::user()->isSuperAdmin() )
                                        <th><a href="#">عملیات</a></th>
                                    @endif
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
                                        <td>{{\Carbon\Carbon::create()->month($doc->month)->format('M')}}</td>
                                        <td><p>{{$doc->content->source}}</p></td>
                                        <td><a class="btn btn-primary" target="_blank" href="{{$doc->nvd_url ?? '#'}}"  >مشاهده</a></td>
                                        <td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score ?? 'N/A'}}</td>
                                        <td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score_desc ?? 'N/A'}}</td>
                                        @if ((Auth::user()->isAdmin() && Auth::user()->can('Documents')) || Auth::user()->isSuperAdmin() )
                                            <td><a href="{{route('translates.show',$doc->id)}}"> @if($doc->translate) ویرایش ترجمه @else ایجاد ترجمه @endif </a></td>
                                        @endif
                                    </tr>
                                @endforeach

                            </table>
                        </div>

                    </div>
                    @if((request()->paginate > 0 && count($documents) > 0) || !isset(request()->paginate))
                        <div class="d-flex justify-content-center text-center">
                            {{$documents->links()}}
                        </div>
                @endif
                <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
