
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
                                <h3>{{number_format(\App\Models\Content::count())}}</h3>

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
                                <h3>{{number_format(\App\Models\Score::where('score_desc','=','low')->count())}}</h3>

                                <p>موارد با درجه خطر کم</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.pageType',1)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    @if(Auth::user()->can('doc_count_medium'))
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{number_format(\App\Models\Score::where('score_desc','=','medium')->count())}}</h3>
                                <p>موارد با درجه خطر متوسط</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.pageType',2)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    @endif
                    @if(Auth::user()->can('doc_count_high'))
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{number_format(\App\Models\Score::where('score_desc','=','high')->count())}}</h3>

                                <p>موارد با درجه خطر بالا</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="{{route('user.pageType',3)}}" class="small-box-footer">اطلاعات بیشتر <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                    <!-- ./col -->
                </div>
                <!-- /.row -->


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title" style="float: right">داکیومنت ها</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body row">
                        @if(Auth::user()->can('doc_search'))
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
                                        @if(Auth::user()->can('doc_id'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="1"  id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(1,request()->SearchOptions)) checked @endif >
                                                <label class="form-check-label" for="defaultCheck1">
                                                    شناسه پایگاه داده
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_name'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="2" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(2,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    نام
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_year'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="3" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(3,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    سال
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_month'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="4" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(4,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    ماه
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_source'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="7" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(7,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    منبع
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_score'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="5" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(5,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    امتیاز پایه
                                                </label>
                                            </div>
                                        @endif
                                        @if(Auth::user()->can('doc_score_desc'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="6" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(6,request()->SearchOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    درجه کیفی
                                                </label>
                                            </div>
                                        @endif
                                            @if(Auth::user()->can('doc_brand'))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="8" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(8,request()->SearchOptions)) checked @endif>
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        محصول
                                                    </label>
                                                </div>
                                            @endif
                                    </div>
                                </form>
                            </div>
                        @endif
                        <div class="col-md-12">
                            <table id="Mytable" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    @if(Auth::user()->can('doc_id'))<th><a @if(request()->sortById && request()->sortById == 'asc' ) href="?sortById=desc" @else href="?sortById=asc" @endif >شناسه پایگاه داده</a></th>@endif
                                    @if(Auth::user()->can('doc_name'))<th><a @if(request()->sortByName && request()->sortByName == 'asc' ) href="?sortByName=desc" @else href="?sortByName=asc" @endif >نام</a></th>@endif
                                    @if(Auth::user()->can('doc_year'))<th><a @if(request()->sortByYear && request()->sortByYear == 'asc' ) href="?sortByYear=desc" @else href="?sortByYear=asc" @endif >سال</a></th>@endif
                                    @if(Auth::user()->can('doc_month'))<th><a @if(request()->sortByMonth && request()->sortByMonth == 'asc' ) href="?sortByMonth=desc" @else href="?sortByMonth=asc" @endif >ماه</a></th>@endif
                                    @if(Auth::user()->can('doc_source'))<th><a href="#">منبع</a></th>@endif
                                    @if(Auth::user()->can('doc_source_link'))<th><a href="#">لینک منبع</a></th>@endif
                                    @if(Auth::user()->can('doc_score'))<th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif>امتیاز پایه</a></th>@endif
                                    @if(Auth::user()->can('doc_score_desc'))<th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif  >درجه کیفی</a></th>@endif
                                    @if(Auth::user()->can('doc_translate')) <th><a href="#">ترجمه</a></th> @endif
                                        @if(Auth::user()->can('doc_brand')) <th><a href="#">محصول</a></th> @endif
                                </tr>
                                </thead>
                                <tbody >
                                @foreach ($documents as $doc)
                                    <tr>
                                        @if(Auth::user()->can('doc_id'))<td>{{$doc->id}}</td>@endif
                                        @if(Auth::user()->can('doc_name'))<td>
                                            <a href="{{route('user.documents.show',$doc->id)}}">{{$doc->slug}}</a>
                                        </td>
                                        @endif
                                        @if(Auth::user()->can('doc_year'))<td>{{$doc->year}}</td>@endif
                                        @if(Auth::user()->can('doc_month'))<td>{{\Carbon\Carbon::create()->month($doc->month)->format('M')}}</td>@endif
                                        @if(Auth::user()->can('doc_source'))<td><p>{{$doc->content->source}}</p></td>@endif
                                        @if(Auth::user()->can('doc_source_link'))<td><a class="btn btn-primary" target="_blank" href="{{$doc->nvd_url ?? '#'}}"  >مشاهده</a></td>@endif
                                        @if(Auth::user()->can('doc_score'))<td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score ?? 'N/A'}}</td>@endif
                                        @if(Auth::user()->can('doc_score_desc'))<td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score_desc ?? 'N/A'}}</td>@endif
                                        @if(Auth::user()->can('doc_translate')) <td> @if($doc->translate) <a
                                                href="{{route('user.translate.show',$doc->id)}}" class="btn btn-primary">مشاهده ترجمه</a> @else - @endif </td> @endif
                                            @if(Auth::user()->can('doc_brand'))
                                            <th>{{$doc->content->brands->first()->name ?? '-'}}</th>
                                            @endif
                                    </tr>
                                @endforeach

                            </table>
                        </div>

                    </div>
                    @if(Auth::user()->can('doc'))
                        @if((request()->paginate > 0 && count($documents) > 0) || !isset(request()->paginate))
                            <div class="d-flex justify-content-center text-center">
                                {{$documents->links()}}
                            </div>
                    @endif
                @endif
                <!-- /.card-body -->
                </div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
