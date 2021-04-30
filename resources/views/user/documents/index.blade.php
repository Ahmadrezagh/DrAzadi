
@extends('layouts.panel')
@section('Documents')
    active
@endsection
@section('Document')
    active
@endsection
@section('title')
    @if(isset($pageName)) {{$pageName}} @else داکیومنت ها @endif
@endsection
@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"> @if(isset($pageName)) {{$pageName}} @else گزارش ها @endif </h1>
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
                                    @if(Auth::user()->can('doc_score_desc') && !isset($pageName))
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="SearchOptions[]" value="6" id="defaultCheck1" @if(isset(request()->SearchOptions) && in_array(6,request()->SearchOptions)) checked @endif>
                                        <label class="form-check-label" for="defaultCheck1">
                                            درجه کیفی
                                        </label>
                                    </div>
                                    @endif
                                </div>
                                <h5 class="mt-3 col-12">فیلتر</h5>
                                <div class=" col-12 row">
                                    @if(Auth::user()->can('doc_id'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="1"  id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(1,request()->filterOptions)) checked @endif >
                                            <label class="form-check-label" for="defaultCheck1">
                                                شناسه پایگاه داده
                                            </label>
                                        </div>
                                    @endif
                                    @if(Auth::user()->can('doc_name'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="2" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(2,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                نام
                                            </label>
                                        </div>
                                    @endif
                                    @if(Auth::user()->can('doc_year'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="3" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(3,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                سال
                                            </label>
                                        </div>
                                    @endif
                                    @if(Auth::user()->can('doc_month'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="4" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(4,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                ماه
                                            </label>
                                        </div>
                                    @endif
                                    @if(Auth::user()->can('doc_source'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="5" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(5,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                منبع
                                            </label>
                                        </div>
                                    @endif
                                        @if(Auth::user()->can('doc_source_link'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="filterOptions[]" value="6" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(6,request()->filterOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    لینک منبع
                                                </label>
                                            </div>
                                        @endif
                                    @if(Auth::user()->can('doc_score'))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="7" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(7,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                امتیاز پایه
                                            </label>
                                        </div>
                                    @endif
                                    @if(Auth::user()->can('doc_score_desc') && !isset($pageName))
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="filterOptions[]" value="8" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(8,request()->filterOptions)) checked @endif>
                                            <label class="form-check-label" for="defaultCheck1">
                                                درجه کیفی
                                            </label>
                                        </div>
                                    @endif
                                        @if(Auth::user()->can('doc_translate'))
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="filterOptions[]" value="9" id="defaultCheck1" @if(isset(request()->filterOptions) && in_array(9,request()->filterOptions)) checked @endif>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    ترجمه
                                                </label>
                                            </div>
                                        @endif
                                        <div class="col-12">
                                            <button class="btn btn-primary mt-3 ">
                                                اعمال فیلتر
                                            </button>
                                        </div>

                                </div>
                            </form>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <table id="Mytable" class="table table-bordered table-striped text-center">
                                <thead>
                                <tr>
                                    @if(Auth::user()->can('doc_id') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(1,request()->filterOptions)))<th><a @if(request()->sortById && request()->sortById == 'asc' ) href="?sortById=desc" @else href="?sortById=asc" @endif >شناسه پایگاه داده</a></th>@endif
                                    @if(Auth::user()->can('doc_name') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(2,request()->filterOptions)))<th><a @if(request()->sortByName && request()->sortByName == 'asc' ) href="?sortByName=desc" @else href="?sortByName=asc" @endif >نام</a></th>@endif
                                    @if(Auth::user()->can('doc_year') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(3,request()->filterOptions)))<th><a @if(request()->sortByYear && request()->sortByYear == 'asc' ) href="?sortByYear=desc" @else href="?sortByYear=asc" @endif >سال</a></th>@endif
                                    @if(Auth::user()->can('doc_month') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(4,request()->filterOptions)))<th><a @if(request()->sortByMonth && request()->sortByMonth == 'asc' ) href="?sortByMonth=desc" @else href="?sortByMonth=asc" @endif >ماه</a></th>@endif
                                    @if(Auth::user()->can('doc_source') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(5,request()->filterOptions)))<th><a href="#">منبع</a></th>@endif
                                    @if(Auth::user()->can('doc_source_link') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(6,request()->filterOptions)))<th><a href="#">لینک منبع</a></th>@endif
                                    @if(Auth::user()->can('doc_score') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(7,request()->filterOptions)))<th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif>امتیاز پایه</a></th>@endif
                                    @if(Auth::user()->can('doc_score_desc') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(8,request()->filterOptions)))<th><a @if(request()->sortByScore && request()->sortByScore == 'asc' ) href="?sortByScore=desc" @else href="?sortByScore=asc" @endif  >درجه کیفی</a></th>@endif
                                    @if(Auth::user()->can('doc_translate') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(9,request()->filterOptions))) <th><a href="#">ترجمه</a></th> @endif
                                </tr>
                                </thead>
                                <tbody >
                                @foreach ($documents as $doc)
                                    <tr>
                                        @if(Auth::user()->can('doc_id') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(1,request()->filterOptions)))<td>{{$doc->id}}</td>@endif
                                        @if(Auth::user()->can('doc_name') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(2,request()->filterOptions)))<td>
                                            <a href="{{route('documents.show',$doc->id)}}">{{$doc->slug}}</a>
                                        </td>
                                        @endif
                                        @if(Auth::user()->can('doc_year') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(3,request()->filterOptions)))<td>{{$doc->year}}</td>@endif
                                        @if(Auth::user()->can('doc_month') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(4,request()->filterOptions)))<td>{{\Carbon\Carbon::create()->month($doc->month)->format('M')}}</td>@endif
                                        @if(Auth::user()->can('doc_source') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(5,request()->filterOptions)))<td><p>{{$doc->content->source}}</p></td>@endif
                                        @if(Auth::user()->can('doc_source_link') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(6,request()->filterOptions)))<td><a class="btn btn-primary" target="_blank" href="{{$doc->nvd_url ?? '#'}}"  >مشاهده</a></td>@endif
                                        @if(Auth::user()->can('doc_score') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(7,request()->filterOptions)))<td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score ?? 'N/A'}}</td>@endif
                                        @if(Auth::user()->can('doc_score_desc') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(8,request()->filterOptions)))<td @if(!$doc->score()) style="color: red" @endif >{{$doc->score()->score_desc ?? 'N/A'}}</td>@endif
                                        @if(Auth::user()->can('doc_translate') && (!isset(request()->filterOptions) || isset(request()->filterOptions) && in_array(9,request()->filterOptions))) <td> @if($doc->translate) <a
                                                    href="{{route('user.translate.show',$doc->id)}}" class="btn btn-primary">مشاهده ترجمه</a> @else - @endif </td> @endif
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
                <!-- /.card -->

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
