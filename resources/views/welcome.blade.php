@extends('layouts.front')
@section('content')
    <!--start header -->
    <header id="gtco-header" class="gtco-cover" role="banner" style="background-image:url(/front/pics/img_bg_1.jpg);">
        <div class="gtco-container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>{{setting('index_header')}}</h1>
                            {!! setting('index_header_text') !!}
                            @if(json_decode(setting('index_header_btn')[0]) != null && json_decode(setting('index_header_btn'))[1] != null)
                                <p><a href="{{json_decode(setting('index_header_btn'))[1]}}" class="btn btn-default">{{json_decode(setting('index_header_btn'))[0]}}</a></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--end header -->

    <!--start top 3 -->
    <div id="gtco-features">
        <div class="gtco-container">
            <div class="row">
                @foreach(\App\Models\Setting::where('name','like','s2_%')->get() as $item)
                    <div class="col-md-4 col-sm-4">
                        <div class="feature-center animate-box" data-animate-effect="fadeIn">
							<span class="icon">
								<i class="{{json_decode($item->value)[0]}}"></i>
							</span>
                            <h3>{{json_decode($item->value)[1]}}</h3>
                            {!! json_decode($item->value)[4] !!}
                            <p><a href="{{json_decode($item->value)[3]}}" class="btn btn-primary">{{json_decode($item->value)[2]}}</a></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end top 3 -->

    <!--start why us -->
    <div id="gtco-features-2">
        <div class="gtco-container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                    <h2>{{setting('why_us_title')}}</h2>
                    <p>{{setting('why_us_p')}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    @foreach(\App\Models\Setting::where('name','like','wu_%')->get() as $item)

                        <div class="feature-right animate-box" data-animate-effect="fadeInright">
							<span class="icon">
								<i class="{{json_decode($item->value)[0]}}"></i>
							</span>
                            <div class="feature-copy">
                                <h3>{{json_decode($item->value)[1]}}</h3>
                                <p>{!! json_decode($item->value)[2] !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--start video -->
                <div class="col-md-6">
                    <div class="gtco-video gtco-bg" style="background-image: url(/front/pics/img_1.jpg); ">
                        <a href="{{setting('why_us_video')}}" class="popup-vimeo"><i class="icon-video2"></i></a>
                        <div class="overlay"></div>
                    </div>
                </div>
                <!--end video -->
            </div>
        </div>
    </div>
    <!--end why us -->

    <!--start counter -->
    <div id="gtco-counter" class="gtco-bg gtco-counter" style="background-image:url(/front/pics/img_bg_2.jpg);">
        <div class="gtco-container">
            <div class="row">
                <div class="display-t">
                    <div class="display-tc">
                        @foreach(\App\Models\Setting::where('name','like','ccc_%')->get() as $item)
                                <div class="col-md-3 col-sm-6 animate-box">
                                    <div class="feature-center">
									<span class="icon">
										<i class="{{ json_decode($item->value)[0] }}"></i>
									</span>
                                        <span class="counter js-counter" data-from="0" data-to="22070" data-speed="5000" data-refresh-interval="50">1</span>
                                        <span class="counter-label">گرافیک</span>
                                    </div>
                                </div>
                       @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end counter -->

@endsection
