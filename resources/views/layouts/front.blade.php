<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{setting('name')}} @if (trim($__env->yieldContent('title'))) | @yield('title')@endif</title>
    <!-- Animate.css -->
    <link rel="stylesheet" href="/front/css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="/front/css/icomoon.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="/front/css/bootstrap-rtl.css">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="/front/css/magnific-popup.css">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="/front/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/front/css/owl.theme.default.min.css">
    <!-- Theme style  -->
    <link rel="stylesheet" href="/front/css/style.css"/>
</head>
<body>
<div class="gtco-loader"></div>
<div id="page">
    <!--start navbar and menu -->
    <nav class="gtco-nav" role="navigation">
        <div class="gtco-container">
            <div class="row">
                <div class="col-xs-2">
                    <div id="gtco-logo"><a href="{{url('/')}}">{{setting('short_name')}}</a></div>
                </div>
                <div class="col-xs-8 text-center menu-1">
                    <ul>
                        <li class="active"><a href="#">صفحه نخست</a></li>
                        <li><a href="#">درباره ما</a></li>
                        <li class="has-dropdown">
                            <a href="#">سرویس ها</a>
                            <ul class="dropdown">
                                <li><a href="#">طراحی سایت</a></li>
                                <li><a href="#">گرافیک</a></li>
                                <li><a href="#">برندسازی</a></li>
                                <li><a href="#">سئو</a></li>
                            </ul>
                        </li>
                        <li class="has-dropdown">
                            <a href="#">ابزارها</a>
                            <ul class="dropdown">
                                <li><a href="#">HTML5</a></li>
                                <li><a href="#">CSS3</a></li>
                                <li><a href="#">bootstrap</a></li>
                                <li><a href="#">jQuery</a></li>
                            </ul>
                        </li>
                        <li><a href="#">تماس با ما</a></li>
                    </ul>
                </div>
                <div class="col-xs-2 text-left hidden-xs menu-2">
                    <ul>
                        <li class="btn-cta"><a href="{{route('login')}}"><span>ورود</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!--end navbar and menu -->

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
                    <h2>چرا باید ما را انتخاب کنید؟</h2>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-right animate-box" data-animate-effect="fadeInright">
							<span class="icon">
								<i class="icon-check"></i>
							</span>
                        <div class="feature-copy">
                            <h3>قالب های دیدنی</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                        </div>
                    </div>
                    <div class="feature-right animate-box" data-animate-effect="fadeInright">
							<span class="icon">
								<i class="icon-check"></i>
							</span>
                        <div class="feature-copy">
                            <h3>کاملا واکنش گرا</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                        </div>
                    </div>
                    <div class="feature-right animate-box" data-animate-effect="fadeInright">
							<span class="icon">
								<i class="icon-check"></i>
							</span>
                        <div class="feature-copy">
                            <h3>آماده استفاده</h3>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                        </div>
                    </div>
                </div>
                <!--start video -->
                <div class="col-md-6">
                    <div class="gtco-video gtco-bg" style="background-image: url(/front/pics/img_1.jpg); ">
                        <a href="#" class="popup-vimeo"><i class="icon-video2"></i></a>
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
                        <div class="col-md-3 col-sm-6 animate-box">
                            <div class="feature-center">
									<span class="icon">
										<i class="icon-eye"></i>
									</span>
                                <span class="counter js-counter" data-from="0" data-to="22070" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">گرافیک</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box">
                            <div class="feature-center">
									<span class="icon">
										<i class="icon-anchor"></i>
									</span>
                                <span class="counter js-counter" data-from="0" data-to="97" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">مشتریان راضی</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box">
                            <div class="feature-center">
									<span class="icon">
										<i class="icon-briefcase"></i>
									</span>
                                <span class="counter js-counter" data-from="0" data-to="402" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">پروژه های انجام شده</span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 animate-box">
                            <div class="feature-center">
									<span class="icon">
										<i class="icon-clock"></i>
									</span>
                                <span class="counter js-counter" data-from="0" data-to="212023" data-speed="5000" data-refresh-interval="50">1</span>
                                <span class="counter-label">ساعات سپری شده</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end counter -->

    <!--start comment -->
    <div id="gtco-testimonial">
        <div class="gtco-container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                    <h2>نظر مشتریان</h2>
                </div>
            </div>
            <div class="row animate-box">
                <div class="owl-carousel owl-carousel-fullwidth ">
                    <div class="item">
                        <div class="testimony-slide active text-center">
                            <figure>
                                <img src="/front/pics/person_1.jpg" alt="user">
                            </figure>
                            <span><a href="#" class="twitter">Twitter</a> نام و نام خانوادگی, توسط </span>
                            <blockquote>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-slide active text-center">
                            <figure>
                                <img src="/front/pics/person_2.jpg" alt="user">
                            </figure>
                            <span><a href="#" class="twitter">Twitter</a> نام و نام خانوادگی, توسط </span>
                            <blockquote>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            </blockquote>
                        </div>
                    </div>
                    <div class="item">
                        <div class="testimony-slide active text-center">
                            <figure>
                                <img src="/front/pics/person_3.jpg" alt="user">
                            </figure>
                            <span><a href="#" class="twitter">Twitter</a> نام و نام خانوادگی, توسط </span>
                            <blockquote>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                            </blockquote>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end comment -->

    <!--start offer -->
    <div id="gtco-services">
        <div class="gtco-container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                    <h2>پیشنهاد ما به شما</h2>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                </div>
            </div>
            <div class="row animate-box">
                <div class="gtco-tabs">
                    <!-- start tab list -->
                    <ul class="gtco-tab-nav">
                        <li class="active"><a href="#" data-tab="1"><span class="icon visible-xs"><i class="icon-command"></i></span><span class="hidden-xs">طراحی سایت</span></a></li>
                        <li><a href="#" data-tab="2"><span class="icon visible-xs"><i class="icon-bar-graph"></i></span><span class="hidden-xs">بازاریابی آنلاین</span></a></li>
                        <li><a href="#" data-tab="3"><span class="icon visible-xs"><i class="icon-bag"></i></span><span class="hidden-xs">تجارت الکتریک</span></a></li>
                        <li><a href="#" data-tab="4"><span class="icon visible-xs"><i class="icon-box"></i></span><span class="hidden-xs">برند سازی</span></a></li>
                    </ul>
                    <!-- end tab list -->

                    <!-- Tabs -->
                    <div class="gtco-tab-content-wrap">
                        <!--tab 1 -->
                        <div class="gtco-tab-content tab-content active" data-tab-content="1">
                            <div class="col-md-6">
                                <div class="icon icon-xlg">
                                    <i class="icon-command"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>طراحی سایت</h2>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="uppercase">طراحی ساده</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="uppercase">مقرون به صرفه</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab 2 -->
                        <div class="gtco-tab-content tab-content" data-tab-content="2">
                            <div class="col-md-6">
                                <div class="icon icon-xlg">
                                    <i class="icon-bar-graph"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>بازاریابی آنلاین</h2>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="uppercase">آماده استفاده</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="uppercase">100% تضمینی</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab 3 -->
                        <div class="gtco-tab-content tab-content" data-tab-content="3">
                            <div class="col-md-6">
                                <div class="icon icon-xlg">
                                    <i class="icon-bag"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>تجارت الکتریک</h2>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="uppercase">آماده استفاده</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="uppercase">100% تضمینی</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--tab 4 -->
                        <div class="gtco-tab-content tab-content" data-tab-content="4">
                            <div class="col-md-6">
                                <div class="icon icon-xlg">
                                    <i class="icon-box"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>برند سازی</h2>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h2 class="uppercase">آماده استفاده</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="uppercase">100% تضمینی</h2>
                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end offer -->

    <!--start register -->
    <div id="gtco-started">
        <div class="gtco-container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center gtco-heading">
                    <h2>شروع کنید</h2>
                </div>
            </div>
            <div class="row animate-box">
                <div class="col-md-12">
                    <form class="form-inline">
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="email" class="sr-only">پست الکترونیک</label>
                                <input type="email" class="form-control" id="email" placeholder="پست الکترونیک">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="form-group">
                                <label for="password" class="sr-only">رمز عبور</label>
                                <input type="password" class="form-control" id="password" placeholder="رمز عبور">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <button type="submit" class="btn btn-default btn-block">ثبت نام</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end register -->

    <!-- start footer -->
    <footer id="gtco-footer" role="contentinfo">
        <div class="gtco-container">
            <div class="row row-pb-md">
                <div class="col-md-4 gtco-widget">
                    <h3>شرکت</h3>
                    <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                    <p><a href="#">بیشتر</a></p>
                </div>
                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <ul class="gtco-footer-links">
                        <li><a href="#">درباره ما</a></li>
                        <li><a href="#">تماس با ما</a></li>
                        <li><a href="#">قوانین</a></li>
                        <li><a href="#">سوالات متداول</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <ul class="gtco-footer-links">
                        <li><a href="#">فروشگاه</a></li>
                        <li><a href="#">شخصی</a></li>
                        <li><a href="#">شرکتی</a></li>
                        <li><a href="#">سایت ساز</a></li>
                    </ul>
                </div>

                <div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
                    <ul class="gtco-footer-links">
                        <li><a href="#">یافتن طراحان</a></li>
                        <li><a href="#">یافتن برنامه نویسان</a></li>
                        <li><a href="#">اعضای تیم</a></li>
                        <li><a href="#">خدمات</a></li>
                    </ul>
                </div>
            </div>

            <div class="row copyleft">
                <div class="col-md-12">
                    <p class="pull-right">
                        <small class="block">&copy; 2019 Free HTML5. All Right Reserved.</small>
                        <small class="block">translated by <a href="http://webrubik.com/" target="_blank">webrubik.com</a></small>
                    </p>
                    <p class="pull-left">
                    <ul class="gtco-social-icons pull-left">
                        <li><a href="#"><i class="icon-twitter"></i></a></li>
                        <li><a href="#"><i class="icon-facebook"></i></a></li>
                        <li><a href="#"><i class="icon-linkedin"></i></a></li>
                        <li><a href="#"><i class="icon-dribbble"></i></a></li>
                    </ul>
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- end footer -->
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="/front/js/jquery.min.js"></script>
<!-- Modernizr JS -->
<script src="/front/js/modernizr-2.6.2.min.js"></script>
<!-- jQuery Easing -->
<script src="/front/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="/front/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="/front/js/jquery.waypoints.min.js"></script>
<!-- Carousel -->
<script src="/front/js/owl.carousel.min.js"></script>
<!-- countTo -->
<script src="/front/js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="/front/js/jquery.magnific-popup.min.js"></script>
<script src="/front/js/magnific-popup-options.js"></script>
<!-- Main -->
<script  src="/front/js/scripts.js"></script>
</body><!-- This template has been downloaded from Webrubik.com -->
</html>
