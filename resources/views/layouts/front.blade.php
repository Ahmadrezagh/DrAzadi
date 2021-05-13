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

    <!-- Content -->
    @yield('content')
    <!-- /Content -->

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
