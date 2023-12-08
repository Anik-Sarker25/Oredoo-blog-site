
<!doctype html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- favicon -->
    <link rel="icon" sizes="16x16" href="{{ asset('frontend_assets')}}/assets/img/favicon.png">

    <!-- Title -->Stay Connected
    <title> Oredoo - Personal Blog HTML Template </title>

    <!-- CSS Plugins -->
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/fontawesome.css">

    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend_assets')}}/assets/css/custom.css">
</head>

<body>
    <!--loading -->
    <div class="loader">
        <div class="loader-element"></div>
    </div>

    <!-- Header-->
    <header class="header navbar-expand-lg fixed-top ">
        <div class="container-fluid ">
            <div class="header-area ">
                <!--logo-->
                <div class="logo">
                    <a href="{{ route('root')}}">
                        <img src="{{ asset('frontend_assets')}}/assets/img/logo/logo-dark.png" alt="" class="logo-dark">
                        <img src="{{ asset('frontend_assets')}}/assets/img/logo/logo-white.png" alt="" class="logo-white">
                    </a>
                </div>
                <div class="header-navbar">
                    <nav class="navbar">
                        <!--navbar-collapse-->
                        <div class="collapse navbar-collapse" id="main_nav">
                            <ul class="navbar-nav ">
                                <li class="nav-item ">
                                    <a class="nav-link {{ (\Request::route()->getName() == 'root') ? 'active' : '' }}" href="{{ route('root')}}"> Home </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (\Request::route()->getName() == 'blog.post') ? 'active' : '' }}" href="{{ route('blog.post')}}"> Blogs </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="author.html"> Authors </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html"> About </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ (\Request::route()->getName() == 'contact') ? 'active' : '' }}" href="{{ route('contact') }}"> Contact </a>
                                </li>
                            </ul>
                        </div>
                        <!--/-->
                    </nav>
                </div>

                <!--header-right-->
                <div class="header-right ">
                    <!--theme-switch-->
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" />
                            <span class="slider round ">
                                <i class="lar la-sun icon-light"></i>
                                <i class="lar la-moon icon-dark"></i>
                            </span>
                        </label>
                    </div>

                    <!--search-icon-->
                    <div class="search-icon">
                        <i class="las la-search"></i>
                    </div>
                    <!--button-subscribe-->



                    @auth
                        @if (auth()->user()->approve_status == true)
                            <div class="botton-sub">
                                <a href="{{ route('home') }}" class="btn-subscribe">Dashboard</a>
                            </div>
                        @else
                            <div class="botton-sub">
                                <a href="{{ route('signup.view') }}" class="btn-subscribe">Sign Up</a>
                            </div>
                        @endif
                    @else
                        <div class="botton-sub">
                            <a href="{{ route('signup.view') }}" class="btn-subscribe">Sign Up</a>
                        </div>
                    @endauth



                    <!--navbar-toggler-->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    {{-- header ends form here --}}

    @yield('content')

    {{-- footer starts form here --}}
    <!--footer-->
    <div class="footer">
        <div class="footer-area">
            <div class="footer-area-content">
                <div class="container">
                    <div class="row ">
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Menu</h6>
                                <ul>
                                    <li><a href="#">Homepage</a></li>
                                    <li><a href="#">about us</a></li>
                                    <li><a href="#">contact us</a></li>
                                    <li><a href="#">privarcy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!--newslatter-->
                        <div class="col-md-6">
                            <div class="newslettre">
                                <div class="newslettre-info">
                                    <h3>Subscribe To OurNewsletter</h3>
                                    <p>Sign up for free and be the first to get notified about new posts.</p>
                                </div>

                                <form action="#" class="newslettre-form">
                                    <div class="form-flex">
                                        <div class="form-group">
                                            <input type="email" class="form-control" placeholder="Your Email Adress"
                                                required="required">
                                        </div>
                                        <button class="submit-btn" type="submit">
                                            <i class="fas fa-paper-plane"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--/-->
                        <div class="col-md-3">
                            <div class="menu">
                                <h6>Follow us</h6>
                                <ul>
                                    <li><a href="#">facebook</a></li>
                                    <li><a href="#">instagram</a></li>
                                    <li><a href="#">youtube</a></li>
                                    <li><a href="#">twitter</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--footer-copyright-->
            <div class="footer-area-copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright">
                                <p>© 2022, AssiaGroupe, All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/-->
        </div>
    </div>

    <!--Back-to-top-->
    <div class="back">
        <a href="#" class="back-top">
            <i class="las la-long-arrow-alt-up"></i>
        </a>
    </div>

    <!--Search-form-->
    <div class="search">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-10 m-auto">
                    <div class="search-width">
                        <button type="button" class="close">
                            <i class="far fa-times"></i>
                        </button>
                        <form class="search-form" action="{{ route('blog.search') }}" method="GET">
                            <input type="search" name="search_item" value="" placeholder="What are you looking for?">
                            <button type="submit" class="search-btn"> search</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('frontend_assets')}}/assets/js/jquery.min.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/popper.min.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/bootstrap.min.js"></script>


    <!-- JS Plugins  -->
    <script src="{{ asset('frontend_assets')}}/assets/js/theia-sticky-sidebar.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/ajax-contact.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/switch.js"></script>
    <script src="{{ asset('frontend_assets')}}/assets/js/jquery.marquee.js"></script>

    {{-- sweetalart --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- JS main  -->
    <script src="{{ asset('frontend_assets')}}/assets/js/main.js"></script>
    {!! NoCaptcha::renderJs() !!}

    @yield('scripts_content')


</body>
</html>
