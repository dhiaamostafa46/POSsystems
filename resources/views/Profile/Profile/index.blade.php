<!DOCTYPE html>
@php    try { @endphp
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <title> شركة ايفكس</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900&amp;subset=arabic" rel="stylesheet">

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.png">

    <!-- Template CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/magnific-popup.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/rtl.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/skins/green.css') }}" />

    <!-- Revolution Slider CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/js/plugins/revolution/css/settings.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/js/plugins/revolution/css/layers.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/js/plugins/revolution/css/navigation.css') }}" />

    <!-- Live Style Switcher - demo only -->
    <link rel="alternate stylesheet" type="text/css" title="blue" href="{{ asset('Profile/css/skins/blue.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="blueviolet"
        href="{{ asset('Profile/css/skins/blueviolet.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="goldenrod"
        href="{{ asset('Profile/css/skins/goldenrod.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="green"
        href="{{ asset('Profile/css/skins/green.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="magenta"
        href="{{ asset('Profile/css/skins/magenta.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="orange"
        href="{{ asset('Profile/css/skins/orange.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="purple"
        href="{{ asset('Profile/css/skins/purple.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="red" href="{{ asset('Profile/css/skins/red.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="yellow"
        href="{{ asset('Profile/css/skins/yellow.css') }}" />
    <link rel="alternate stylesheet" type="text/css" title="yellowgreen"
        href="{{ asset('Profile/css/skins/yellowgreen.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('Profile/css/styleswitcher.css') }}" />

    <!-- Template JS Files -->
    <script type="text/javascript" src="{{ asset('Profile/js/modernizr.js') }}"></script>

</head>

<body class="rtl-version">
    <!-- Preloader Starts -->
    {{-- <div class="preloader" id="preloader">
        <div class="logopreloader">
            <img src="{{asset('Profile/img/logo.Png')}}" alt="logo-black">

        </div>
        <div class="loader" id="loader"></div>
    </div> --}}
    <!-- Preloader Ends -->
    <!-- Live Style Switcher Starts - demo only -->
    <div id="switcher" class="">
        <div class="content-switcher">
            <h4> اختار اللون</h4>
            <ul>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('blue'); document.getElementById('logo-light').src='img/styleswitcher/logos/blue.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/blue.png';"
                        title="blue" class="color"> <img src="{{ asset('Profile/img/styleswitcher/blue.png') }}"
                            alt="" width="30" height="30" /> </a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('blueviolet'); document.getElementById('logo-light').src='img/styleswitcher/logos/blueviolet.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/blueviolet.png';"
                        title="blueviolet" class="color"><img
                            src="{{ asset('Profile/img/styleswitcher/blueviolet.png') }}" alt="" width="30"
                            height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('goldenrod'); document.getElementById('logo-light').src='img/styleswitcher/logos/goldenrod.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/goldenrod.png';"
                        title="goldenrod" class="color"><img
                            src="{{ asset('Profile/img/styleswitcher/goldenrod.png') }} "
                            alt="" width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('green'); document.getElementById('logo-light').src='img/styleswitcher/logos/green.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/green.png';"
                        title="green" class="color"><img src=" {{ asset('Profile/img/styleswitcher/green.png') }} " alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('magenta'); document.getElementById('logo-light').src='img/styleswitcher/logos/magenta.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/magenta.png';"
                        title="magenta" class="color"><img src=" {{ asset('Profile/img/styleswitcher/magenta.png') }}" alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('orange'); document.getElementById('logo-light').src='img/styleswitcher/logos/orange.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/orange.png';"
                        title="orange" class="color"><img src=" {{ asset('Profile/img/styleswitcher/orange.png') }}" alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('purple'); document.getElementById('logo-light').src='img/styleswitcher/logos/purple.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/purple.png';"
                        title="purple" class="color"><img src="{{ asset('Profile/img/styleswitcher/purple.png') }} " alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('red'); document.getElementById('logo-light').src='img/styleswitcher/logos/red.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/red.png';"
                        title="red" class="color"><img src=" {{ asset('Profile/img/styleswitcher/red.png') }} " alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('yellow'); document.getElementById('logo-light').src='img/styleswitcher/logos/yellow.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/yellow.png';"
                        title="yellow" class="color"><img src=" {{ asset('Profile/img/styleswitcher/yellow.png') }} " alt=""
                            width="30" height="30" /></a>
                </li>
                <li>
                    <a href="#"
                        onclick="setActiveStyleSheet('yellowgreen'); document.getElementById('logo-light').src='img/styleswitcher/logos/yellowgreen.png'; document.getElementById('logo-dark').src='img/styleswitcher/logos/logos-dark/yellowgreen.png';"
                        title="yellowgreen" class="color"><img src=" {{ asset('Profile/img/styleswitcher/yellowgreen.png') }} "
                            alt="" width="30" height="30" /></a>
                </li>
            </ul>

            <p> اختار الاخلفية</p>

            <label><input class="dark_switch" type="radio" name="color_style" id="is_light" value="light"
                    checked="checked" /> Light</label>
            <label><input class="dark_switch" type="radio" name="color_style" id="is_dark" value="dark" />
                Dark</label>

            <hr />

            <p> اختار الاستايل </p>
            <label><input class="boxed_switch" type="radio" name="layout_style" id="is_wide" value="wide"
                    checked="checked" /> Wide</label>
            <label><input class="boxed_switch" type="radio" name="layout_style" id="is_boxed" value="boxed" />
                Boxed</label>

            <hr />


            <span class="info"> اختار الشكل </span>
            <label><input class="separator_switch" type="radio" name="separator_style" id="is_normal"
                    value="normal" checked="checked" /> <img alt="separator" width="20" height="20"
                    src=" {{ asset('Profile/img/styleswitcher/separators/1.jpg') }} " /></label>
            <label><input class="separator_switch" type="radio" name="separator_style" id="is_skew"
                    value="skew" /> <img alt="separator" width="20" height="20"
                    src=" {{ asset('Profile/img/styleswitcher/separators/2.jpg') }}" /></label>
            <label><input class="separator_switch" type="radio" name="separator_style" id="is_reversed_skew"
                    value="reversed-skew" /> <img alt="separator" width="20" height="20"
                    src=" {{ asset('Profile/img/styleswitcher/separators/3.jpg') }}" /></label>
            <label><input class="separator_switch" type="radio" name="separator_style" id="is_double_diagonal"
                    value="double-diagonal" /> <img alt="separator" width="20" height="20"
                    src="{{ asset('Profile/img/styleswitcher/separators/4.jpg') }}" /></label>
            <label><input class="separator_switch" type="radio" name="separator_style" id="is_big_triangle"
                    value="big-triangle" /> <img alt="separator" width="20" height="20"
                    src=" {{ asset('Profile/img/styleswitcher/separators/5.jpg') }}" /></label>

            <hr />


            <div id="hideSwitcher">&times;</div>

        </div>
    </div>























    <div id="showSwitcher" class="styleSecondColor"><i class="fa fa-cog fa-spin"></i></div>
    <!-- Live Style Switcher Ends - demo only -->
    <!-- Page Wrapper Starts -->
    <div class="wrapper">
        <!-- Header Starts -->
        <header id="header" class="header">
            <div class="header-inner">
                <!-- Navbar Starts -->
                <nav class="navbar navbar-expand-lg p-0" id="singlepage-nav">
                    <!-- Logo Starts -->
                    <div class="logo">
                        <a data-toggle="collapse" data-target=".navbar-collapse.show"
                            class="navbar-brand link-menu scroll-to-target" href="#mainslider">

                            <img src="{{ asset('dist/img/Profile/' . $profCompany->Logo) }}"
                                style="width: 100px; height: 40px;" alt="">

                        </a>
                    </div>
                    <!-- Logo Ends -->
                    <!-- Hamburger Icon Starts -->
                    <button class="navbar-toggler p-0" id="navberToggeler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span id="icon-toggler">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                    </button>
                    <!-- Hamburger Icon Ends -->
                    <!-- Navigation Menu Starts -->
                    <div class="collapse navbar-collapse nav-menu" id="navbarSupportedContent">
                        <ul class="nav-menu-inner mr-auto">
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#mainslider"><i class="fa fa-home"></i> الرئيسية</a></li>
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#about"><i class="fa fa-user"></i> من نحن</a></li>
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#gools"><i class="fa fa-cog"></i> اهدافنا</a></li>
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#message"><i class="fa fa-image"></i> رؤيتنا ورسالتنا </a></li>
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#service"><i class="fa fa-user"></i> خدمتنا</a></li>
                            <li><a data-toggle="collapse" data-target=".navbar-collapse.show" class="link-menu"
                                    href="#contact"><i class="fa fa-envelope"></i> إتصل بنا</a></li>
                        </ul>
                    </div>
                    <!-- Navigation Menu Ends -->
                </nav>
                <!-- Navbar Ends -->
            </div>
        </header>










        <!-- Main Slider Section Starts -->
        @if ($profCompany != null)
            <section class="mainslider" id="mainslider">
                <!-- Slider Hero Starts -->
                <div class="rev_slider_wrapper fullwidthbanner-container dark-slider">
                    <!-- START REVOLUTION SLIDER 5.0.7 fullwidth mode -->

                    <img class="img-fluid imgsilder" src="{{ asset('dist/img/Profile/' . $profCompany->Img) }}"
                        style="width: 100%; height:950px" alt="">
                    {{-- <div id="rev_slider" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.0.7">
                        <ul>
                            <!-- SLIDE  -->
                            <li data-index="rs-18" data-transition="zoomin" data-slotamount="7" data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000" data-thumb="{{asset('Profile/img/revolution-slider/kenburns/thumb1.jpg')}}" data-rotate="0" data-saveperformance="off" data-title="Ken Burns" data-description="">
                                <!-- MAIN IMAGE -->
                                <img src="{{asset('Profile/img/revolution-slider/kenburns/kenburns1.jpg')}}" data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="180" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>
                                <!-- LAYERS -->

                                <!-- LAYER NR. 1 -->
                                <div class="tp-caption NotGeneric-Title   tp-resizeme rs-parallaxlevel-0" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']" data-fontsize="['70','70','70','45']" data-lineheight="['70','70','70','50']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="x:[105%];z:0;rX:45deg;rY:0deg;rZ:90deg;sX:1;sY:1;skX:0;skY:0;s:2000;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitout="none" data-responsive_offset="on" data-elementdelay="0.05" style="z-index: 5; white-space: nowrap;font-weight:600;">شركة افكس  لانظمة المحاسبية
                                </div>

                                <!-- LAYER NR. 2 -->
                                <div class="tp-caption NotGeneric-SubTitle   tp-resizeme rs-parallaxlevel-0 nowrap-normal text-center px-15" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['70','70','70','70']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power4.easeInOut;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1500" data-responsive_offset="on" style="z-index: 6; white-space: nowrap;">شركة تقنية رائدة تأسست في المملكة العربية السعودية متخصصة في إنتاج وتطوير الأنظمة  المحاسبيةوالإدارية بمقاييس ومعاير عالمية .
                                </div>

                                <!-- LAYER NR. 3 -->
                                <div class="tp-caption NotGeneric-Icon   tp-resizeme rs-parallaxlevel-0" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['-68','-68','-68','-68']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-style_hover="cursor:default;" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:1500;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:[100%];s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="2000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 7; white-space: nowrap;"><i class="pe-7s-refresh"></i>
                                </div>
                                <!-- LAYER NR. 4 -->
                                <div class="tp-caption" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['150','210','210','180']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:300;e:Power1.easeInOut;" data-style_hover="c:rgba(255, 255, 255, 1.00);bc:rgba(255, 255, 255, 1.00);" data-transform_in="y:100px;sX:1;sY:1;opacity:0;s:2000;e:Power3.easeInOut;" data-transform_out="y:50px;opacity:0;s:1000;e:Power2.easeInOut;" data-start="750" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 11; white-space: nowrap;text-transform:left;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;"><a href="#about" class="custom-button slider-button scroll-to-target">إقرأ المزيد عنّا</a></div>
                            </li>


                        </ul>


                    </div> --}}
                </div>
                <!-- END REVOLUTION SLIDER -->
                <!-- Slider Hero Ends -->
            </section>
        @endif
        <!-- Main Slider Section Ends -->













        <!-- About Section Starts -->
        @if ($profCompany != null)
            <section id="about" class="about">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span> من نحن ؟</span> </h1>
                    </div>
                    <!-- Main Heading Ends -->
                    <!-- Divider Starts -->
                    <div class="divider text-center">
                        <span class="outer-line"></span>
                        <span class="fa fa-user" aria-hidden="true"></span>
                        <span class="outer-line"></span>
                    </div>
                    <!-- Divider Ends -->
                    <!-- About Content Starts -->
                    <div class="row about-content">
                        <div class="col-md-12 col-lg-6 about-right">
                            <div class="about-right-side">
                                {{-- <img class="img-fluid" src="{{asset('Profile/img/about.jpg')}}" alt=""> --}}
                                <img class="img-fluid" src="{{ asset('dist/img/Profile/' . $profCompany->imgAbout) }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6 about-left-side">
                            <h3 class="title-about"> من نحن </h3>
                            <hr>
                            <p>{{ $profCompany->About }} </p>

                        </div>
                    </div>
                    <!-- About Content Ends -->
                </div>
                <!-- Container Ends -->
            </section>
            <section id="gools" class="newsletter">
                <div class="section-overlay">
                    <!-- Container Starts -->
                    <div class="container">
                        <!-- Main Heading Starts -->
                        <div class="text-center top-text">
                            <h1><span>هدفنا </span> </h1>

                        </div>
                        <!-- Main Heading Ends -->
                        <div class="newsletter-content text-center">
                            <p style="font-size: 30px"> {{ $profCompany->gools }}</p>
                        </div>
                    </div>
                    <!-- Container Ends -->
                </div>
            </section>
            <section class="blog" id="message">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span>رؤيتنا </span> ورسالتنا </h1>

                    </div>
                    <!-- Main Heading Starts -->
                    <!-- Divider Starts -->
                    <div class="divider text-center">
                        <span class="outer-line"></span>
                        <span class="fa fa-comments" aria-hidden="true"></span>
                        <span class="outer-line"></span>
                    </div>
                    <!-- Divider Ends -->
                    <div class="row latest-posts-content text-center">
                        <!-- Article Starts -->
                        <div class="col-sm-12 col-md-6 col-xs-12">
                            <div class="latest-post">
                                <!-- Featured Image Starts -->
                                <h1> <span> <i class="fa fa-eye fa-2xl" aria-hidden="true"
                                            style="font-size: 100px"></i></span></h1>
                                <!-- Featured Image Ends -->
                                <!-- Article Content Starts -->
                                <div class="post-body">
                                    <h4 class="post-title">
                                        <a href="#">رؤيتنا</a>
                                    </h4>
                                    <div class="post-text">
                                        <p> {{ $profCompany->Vision }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Article Ends -->
                        <!-- Article Starts -->
                        <div class="col-sm-12 col-md-6 col-xs-12">
                            <div class="latest-post">
                                <!-- Featured Image Starts -->
                                <h1> <span> <i class="fa fa-comment fa-2xl" aria-hidden="true"
                                            style="font-size: 100px"></i></span></h1>
                                <!-- Featured Image Ends -->
                                <!-- Article Content Starts -->
                                <div class="post-body">
                                    <h4 class="post-title">
                                        <a href="#">رسالتنا </a>
                                    </h4>
                                    <div class="post-text">
                                        <p> {{ $profCompany->message }}</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <!-- Latest Blog Posts Ends -->
                </div>
            </section>
        @endif

        @if (count($profServices) > 0)
            <section class="blog" id="service">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span> خدمتنا </span> </h1>

                    </div>
                    <!-- Main Heading Starts -->
                    <!-- Divider Starts -->
                    <div class="divider text-center">
                        <span class="outer-line"></span>
                        <span class="fa fa-comments" aria-hidden="true"></span>
                        <span class="outer-line"></span>
                    </div>
                    <!-- Divider Ends -->
                    <div class="row latest-posts-content">
                        @foreach ($profServices as $item)
                            <div class="col-sm-12 col-md-4 col-xs-12">
                                <div class="latest-post">
                                    <img class="img-fluid" src="{{ asset('dist/img/Profile/' . $item->img) }}"
                                        alt="">
                                    <div class="post-body">
                                        <h4 class="post-title">
                                            <a href="blog-post.html">{{ $item->name }}</a>
                                        </h4>
                                        <div class="post-text">
                                            <p>{{ $item->disc }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach




                    </div>
                    <!-- Latest Blog Posts Ends -->
                </div>
            </section>
        @endif


        @if ($profContact != null)
            <section id="contact" class="contact">
                <!-- Container Starts -->
                <div class="container">
                    <!-- Main Heading Starts -->
                    <div class="text-center top-text">
                        <h1><span>إتصل</span> بنا</h1>
                    </div>
                    <!-- Main Heading Starts -->
                    <!-- Divider Starts -->
                    <div class="divider text-center">
                        <span class="outer-line"></span>
                        <span class="fa fa-envelope" aria-hidden="true"></span>
                        <span class="outer-line"></span>
                    </div>
                    <!-- Divider Ends -->
                </div>

                <!-- Info Map Boxes Starts -->
                <div class="container">
                    <div class="row info-map-boxes">
                        <!-- Left Info Map Box Starts -->
                        <div class="col-md-4 col-sm-12">
                            <div class="info-map-boxes-item">
                                <h1> العنوان </h1>
                                <p> {{ $profContact->Address }} </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="info-map-boxes-item">
                                <h1> إيميل </h1>
                                <p> {{ $profContact->email }} </p>
                            </div>
                        </div>
                        <!-- Left Info Map Box Ends -->
                        <!-- Right Info Map Box Starts -->
                        <div class="col-md-4 col-sm-12">
                            <div class="info-map-boxes-item ">
                                <h1>الهاتف</h1>
                                <p> {{ $profContact->Phone }} </a></p>
                            </div>
                        </div>
                        <!-- Right Info Map Box Ends -->
                    </div>
                </div>
                <!-- Info Map Boxes Ends -->
            </section>
        @endif













































        <!-- Back To Top Ends -->
    </div>
    <!-- Wrapper Ends -->

    <!-- Template JS Files -->
    <script type="text/javascript" src="{{ asset('Profile/js/jquery-2.2.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/jquery.easing.1.3.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAFnEvJfyoQ8unR5hK1u87h73EdYP46-hE"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/jquery.bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/jquery.filterizr.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/jquery.singlePageNav.min.js') }}"></script>

    <!-- Revolution Slider Main JS Files -->
    <script type="text/javascript" src="{{ asset('Profile/js/plugins/revolution/js/jquery.themepunch.tools.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/jquery.themepunch.revolution.min.js') }}"></script>

    <!-- Revolution Slider Extensions -->

    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.actions.min.j') }}s"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.carousel.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.kenburn.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.layeranimation.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.migration.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.navigation.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.parallax.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.slideanims.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('Profile/js/plugins/revolution/js/extensions/revolution.extension.video.min.js') }}"></script>

    <!-- Live Style Switcher JS File - only demo -->
    <script type="text/javascript" src="{{ asset('Profile/js/styleswitcher.js') }}"></script>

    <!-- Main JS Initialization File -->
    <script type="text/javascript" src="{{ asset('Profile/js/custom.js') }}"></script>

    <!-- Revolution Slider Initialization Starts -->
    <script>
        window.addEventListener("beforeprint", (event) => {
            $('#showSwitcher').hide();
            $('#navberToggeler').hide();
            $('#switcher').hide();


        });


        window.addEventListener("afterprint", (event) => {
            $('#showSwitcher').show();
            $('#navberToggeler').show();
            $('#switcher').hide();
        });
    </script>

    <!-- Revolution Slider Initialization Ends -->
</body>

</html>
@php       } catch (Exception $e) {
        // Code to handle the exception
        echo "An error occurred: " . $e->getMessage();
    }
 @endphp