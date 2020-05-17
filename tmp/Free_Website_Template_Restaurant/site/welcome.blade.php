<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ $title ?? '' }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slider.css') }}">

    {{--Scripts--}}

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.1.1.js') }}"></script>
    <script src="{{ asset('js/superfish.js') }}"></script>
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/sForm.js') }}"></script>
    <script src="{{ asset('js/jquery.carouFredSel-6.1.0-packed.js') }}"></script>
    <script src="{{ asset('js/tms-0.4.1.js') }}"></script>

    {{--Slider Script--}}

    <script>
		$(window).load(function () {
			$('.slider')._TMS({
				show: 0,
				pauseOnHover: false,
				prevBu: '.prev',
				nextBu: '.next',
				playBu: false,
				duration: 800,
				preset: 'fade',
				pagination: true,//'.pagination',true,'<ul></ul>'
				pagNums: false,
				slideshow: 8000,
				numStatus: false,
				banners: false,
				waitBannerAnimation: false,
				progressBar: false
			})
		});
		$(window).load(
			function () {
				$('.carousel1').carouFredSel({
					auto: false,
					prev: '.prev',
					next: '.next',
					width: 960,
					items: {
						visible: {
							min: 1,
							max: 4
						},
						height: 'auto',
						width: 240,

					},
					responsive: false,
					scroll: 1,
					mousewheel: false,
					swipe: {onMouse: false, onTouch: false}
				});
			});
    </script>

    {{--End Slider Script--}}

    <!--[if lt IE 8]>
    <div style=' clear: both; text-align:center; position: relative;'>
        <a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
            <img
                src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg"
                border="0" height="42" width="820"
                alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."/>
        </a>
    </div>
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="{{ asset('js/html5shiv.js') }}"></script>
    <link rel="stylesheet" media="screen" href="{{ asset('css/ie.css') }}">

    <![endif]-->
</head>
<body>
<div class="main">
    <!--==============================header=================================-->
    <header>
        <div class="container_12">
            <div class="grid_12">
                <!-- Logo -->
                <h1>
                    <a href="index.html">
                        <img src="images/logo.png" alt="EXTERIOR">
                    </a>
                </h1>
                <!-- End Logo -->
                <!-- Menu -->
                <div class="menu_block">
                    <nav class="">
                        <ul class="sf-menu">
                            <li class="current">
                                <a href="index.html">Home</a>
                            </li>
                            <li class="with_ul">
                                <a href="index-1.html">Увійти</a>
                                <ul>
                                    <li>
                                        <a href="#"> cuisine</a>
                                    </li>
                                    <li>
                                        <a href="#">Good rest</a>
                                    </li>
                                    <li>
                                        <a href="#">Services</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="index-2.html">Menu</a></li>
                            <li><a href="index-3.html">Portfolio</a></li>
                            <li><a href="index-4.html">News </a></li>
                            <li><a href="index-5.html">Contacts</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </div>
                <!-- End Menu -->
                <div class="clear"></div>
            </div>
        </div>
    </header>
    <!-- End header -->
    <!-- Begin slider -->
    <div class="slider-relative">
        <div class="slider-block">
            <div class="slider">
                <ul class="items">
                    <li><img src="images/slide.jpg" alt=""></li>
                    <li><img src="images/slide1.jpg" alt=""></li>
                    <li><img src="images/slide2.jpg" alt=""></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End slider -->
    <!--=======content================================-->

    <div class="content page1">
        <div class="ic">More Website Templates @ TemplateMonster.com - May 13, 2013!</div>
        <div class="container_12">
            <div class="grid_7">
                <h2>Welcome</h2>
                <div class="page1_block col1">
                    <img src="images/welcome_img.png" alt="">
                    <div class="extra_wrapper">
                        <p><span class="col2"><a
                            href="http://blog.templatemonster.com/free-website-templates/"
                            rel="nofollow">Click here</a></span> for more info
                            about this free website template created by
                            TemplateMonster.com </p>
                        Aenean nonummy hendrerit mau rellus porta. Fusce
                        suscipit varius m sociis natoque penaibet magni
                        parturient montes nasetur ridiculumula dui. <br>
                        <a href="#" class="btn">more</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="grid_5">
                <h2>Features</h2>
                <ul class="list">
                    <li><a href="#">Unlimited consultations and/or planning</a>
                    </li>
                    <li><a href="#">Expert advice on traditions, customs,
                        aetiquette</a></li>
                    <li><a href="#">Determine and stay within budget</a></li>
                    <li><a href="#">Choosing the right Wedding Venue</a></li>
                    <li><a href="#">Provide preferred vendor's list</a></li>
                    <li><a href="#">Assist with wedding scheme and design</a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="grid_12">
                <div class="hor_separator"></div>
            </div>
            <div class="grid_12">
                <div class="car_wrap">
                    <h2>Best Choice</h2>
                    <a href="#" class="prev"></a><a href="#" class="next"></a>
                    <ul class="carousel1">
                        <li>
                            <div><img src="images/page1_img1.jpg" alt="">
                                <div class="col1 upp"><a href="#">Lorem ipsum
                                    doamet consectet</a></div>
                                <span> Dorem ipsum dolor amet consectetur</span>
                                <div class="price">45$</div>
                            </div>
                        </li>
                        <li>
                            <div><img src="images/page1_img2.jpg" alt="">
                                <div class="col1 upp"><a href="#">Lorem ipsum
                                    doamet consectet</a></div>
                                <span> Dorem ipsum dolor amet consectetur</span>
                                <div class="price">45$</div>
                            </div>
                        </li>
                        <li>
                            <div><img src="images/page1_img3.jpg" alt="">
                                <div class="col1 upp"><a href="#">Lorem ipsum
                                    doamet consectet</a></div>
                                <span> Dorem ipsum dolor amet consectetur</span>
                                <div class="price">45$</div>
                            </div>
                        </li>
                        <li>
                            <div><img src="images/page1_img4.jpg" alt="">
                                <div class="col1 upp"><a href="#">Lorem ipsum
                                    doamet consectet</a></div>
                                <span> Dorem ipsum dolor amet consectetur</span>
                                <div class="price">45$</div>
                            </div>
                        </li>
                        <li>
                            <div><img src="images/page1_img3.jpg" alt="">
                                <div class="col1 upp"><a href="#">Lorem ipsum
                                    doamet consectet</a></div>
                                <span> Dorem ipsum dolor amet consectetur</span>
                                <div class="price">45$</div>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <div class="clear"></div>
            <div class="bottom_block">
                <div class="grid_6">
                    <h3>Follow Us</h3>
                    <div class="socials">
                        <a href="#"></a>
                        <a href="#"></a>
                        <a href="#"></a>
                    </div>
                    <nav>
                        <ul>
                            <li class="current"><a href="index.html">Home</a>
                            </li>
                            <li><a href="index-1.html">About Us</a></li>
                            <li><a href="index-2.html">Menu</a></li>
                            <li><a href="index-3.html">Portfolio</a></li>
                            <li><a href="index-4.html">News </a></li>
                            <li><a href="index-5.html">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="grid_6">
                    <h3>Email Updates</h3>
                    <p class="col1">Join our digital mailing list and get
                        news<br> deals and be first to know about events</p>
                    <form id="newsletter">
                        <div class="success">Your subscribe request has been
                            sent!
                        </div>
                        <label class="email">
                            <input type="email" value="Enter e-mail address">
                            <a href="#" class="btn"
                               data-type="submit">subscribe</a>
                            <span class="error">*This is not a valid email address.</span>
                        </label>
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<!--==============================footer=================================-->

<footer>
    <div class="container_12">
        <div class="grid_12">
            Gourmet © 2013 &nbsp;&nbsp; |&nbsp;&nbsp; <a href="#">Privacy
            Policy</a> &nbsp;&nbsp;|&nbsp;&nbsp; Website Template designed by <a
            href="http://www.templatemonster.com/" rel="nofollow">TemplateMonster.com</a>
        </div>
        <div class="clear"></div>
    </div>
</footer>
</body>
</html>
