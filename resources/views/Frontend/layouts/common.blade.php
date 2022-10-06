<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <link rel="shortcut icon" type="image/favicon" href="image/fevicon.png">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/themify-icons.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/swiper.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/style4.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/css/responsive4.css')}}">
</head>

<body>
    <!-- top notificationbr start -->
    @php
    $locale = app()->getLocale();
    $lang = ['en' => 'English','fr' => 'Français','it' => 'Italiano','de' => 'Deutsch'];

    $currencies = ['usd','chf','rub','eur'];
    if(!in_array(session()->get('currency'),$currencies)){
    session()->put('currency','eur');
    $currency = 'eur';
    }else{
    $currency = session()->get('currency');
    };
    @endphp
    <section class="top-4">
        <div class="container">
            <div class="row ">
                <div class="col">
                    <ul class="top-home">
                        <li class="top-home-li t-content">
                            <!-- information start -->
                            <div class="top-content">
                                <ul class="top-contect">
                                    <li><a href="#"><i class="ti-mobile"></i> +41918301114</a></li>
                                    <li><a href="#"><i class="ti-email"></i> info@cbdlogistics.swiss</a></li>
                                </ul>
                            </div>
                            <!-- information end -->
                        </li>
                        <li class="top-home-li">
                            <ul class="top-dropdown">
                                <!-- login start -->
                                <li class="top-dropdown-li">
                                    <a href="javascript:void(0)">Account</a>
                                    <i class="ion-ios-arrow-down"></i>
                                    <ul class="account">
                                        <li><a href="#">Register</a></li>
                                        <li><a href="#">Login</a></li>
                                    </ul>
                                </li>
                                <!-- login end -->
                                <!-- Language start -->
                                <li class="top-dropdown-li">
                                    <a href="javascript:void(0)" value="{{$locale}}" id="selectedLang"><img src="{{asset('public/image/'.$locale.'.jpg')}}" class="me-1">{{$lang[$locale]}}</a>
                                    <i class="ion-ios-arrow-down"></i>
                                    <ul class="currency">
                                        @foreach($lang as $key => $value)
                                        @if($key != $locale)
                                        <li><a href="javascript:void(0)" value="{{$key}}" class="lang"><img src="{{asset('public/image/'.$key.'.jpg')}}" class="me-1">{{$value}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <!-- Language end -->
                                <!-- currency start -->
                                <li class="top-dropdown-li" style="text-transform: uppercase;">
                                    <a href="javascript:void(0)" id="selectedCurrency" value="{{$currency}}">{{$currency}}</a>
                                    <i class="ion-ios-arrow-down"></i>
                                    <ul class="currency">
                                        @foreach($currencies as $curr)
                                        @if($curr != $currency)
                                        <li><a href="javascript:void(0)" value="{{$curr}}" class="curr">{{$curr}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <!-- currency end -->
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- top notificationbr start -->
    <!-- header start -->
    <header class="header-area">
        <div class="header-main-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="header-main">
                            <!-- logo start -->
                            <div class="header-element logo">
                                <a href="{{url('')}}">
                                    <img src="{{asset('public/image/logo.jpg')}}" alt="logo-image" class="img-fluid">
                                </a>
                            </div>
                            <!-- logo end -->
                            <!-- search start -->
                            <div class="header-element header-search">
                                <form>
                                    <input type="text" name="search" placeholder="Search Product.">
                                    <button class="search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                            <!-- search end -->
                            <!-- header icon start -->
                            <div class="header-element right-block-box">
                                <ul class="shop-element">
                                    <li class="side-wrap nav-toggler">
                                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
                                            <span class="line"></span>
                                        </button>
                                    </li>
                                    <li class="side-wrap search-wrap">
                                        <!-- mobile search start -->
                                        <div class="search-rap">
                                            <a href="#search-modal" class="search-popuup" data-bs-toggle="modal"><i class="ion-ios-search-strong"></i></a>
                                        </div>
                                        <!-- mobile search end -->
                                    </li>
                                    <li class="side-wrap wishlist-wrap">
                                        <a href="{{route('wishlist')}}" class="header-wishlist">
                                            <span class="wishlist-icon"><i class="icon-heart"></i></span>
                                            @if(Auth::check())
                                            <span class="wishlist-counter">0</span>
                                            @else
                                            <span class="wishlist-counter">{{count(session()->get('wishlist',[]))}}</span>
                                            @endif
                                        </a>
                                    </li>
                                    <li class="side-wrap cart-wrap">
                                        <div class="shopping-widget">
                                            <div class="shopping-cart">
                                                <a href="javascript:void(0)" class="cart-count">
                                                    <span class="cart-icon-wrap">
                                                        <span class="cart-icon"><i class="icon-handbag"></i></span>
                                                        @if(Auth::check())
                                                        <span id="cart-total" class="bigcounter">0</span>
                                                        @else
                                                        <span id="cart-total" class="bigcounter">{{count(session()->get('cart',[]))}}</span>
                                                        @endif
                                                        <span class="cart-price">CHF 770.48</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- header icon start -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- menu start  -->
            <section class="menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="top-menu">
                                <!-- megamenu start -->
                                <div class="header-element megamenu-content">
                                    <div class="mainwrap">
                                        <ul class="main-menu">
                                            <!-- <li class="menu-link">
                                                    <a href="javascript:void(0)" class="link-title">
                                                        <span class="sp-link-title">Buy vegist</span>
                                                    </a>
                                                </li> -->
                                            <li class="menu-link">
                                                <a href="{{url('/')}}" class="link-title">
                                                    <span class="sp-link-title">Home</span>
                                                </a>
                                            </li>
                                            <li class="menu-link parent">
                                                <a href="javascript:void(0)" class="link-title">
                                                    <span class="sp-link-title">Shop By Category</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <a href="#collapse-top-page-menu" data-bs-toggle="collapse" class="link-title link-title-lg">
                                                    <span class="sp-link-title">Shop By Category</span>
                                                    <i class="fa fa-angle-down"></i>
                                                </a>
                                                <ul class="dropdown-submenu sub-menu collapse" id="collapse-top-page-menu">
                                                    @foreach($categories as $category)
                                                    <li class="submenu-li">
                                                        @php $locale = app()->getLocale(); @endphp
                                                        <a href="{{url($category['slug_'.$locale])}}" class="g-l-link"><span>{{$category['name_'.$locale]}} </span> <i class="fa fa-angle-right"></i></a>
                                                        <a href="#category-{{$loop->iteration}}" data-bs-toggle="collapse" class="sub-link"><span>{{$category['name_'.$locale]}} </span> <i class="fa fa-angle-down"></i></a>
                                                        <ul class="blog-style-1 collapse" id="category-{{$loop->iteration}}">
                                                            <li>
                                                                @foreach($category->subcategories as $subcategory)
                                                                <a href="{{url($category['slug_'.$locale].'/'.$subcategory['slug_'.$locale])}}" class="sub-style"><span>{{$subcategory['name_'.$locale]}}</span></a>
                                                                @endforeach
                                                            </li>
                                                        </ul>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>

                                            @foreach($pages as $page)
                                            @php $link = 'slug_'.app()->getLocale();
                                            $title = 'title_'.app()->getLocale();
                                            @endphp
                                            <li class="menu-link">
                                                <a href="{{url('page/'.$page[$link])}}" class="link-title">
                                                    <span class="sp-link-title">{{$page[$title]}}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                            <li class="menu-link">
                                                <a href="{{url('faq')}}" class="link-title">
                                                    <span class="sp-link-title">Faq</span>
                                                </a>
                                            </li>
                                            <li class="menu-link">
                                                <a href="{{url('contact')}}" class="link-title">
                                                    <span class="sp-link-title">Contact</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- megamenu end -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- menu end -->
        </div>
        <!-- mobile menu start -->
        <div class="header-bottom-area">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="main-menu-area">
                            <div class="main-navigation navbar-expand-xl">
                                <div class="box-header menu-close">
                                    <button class="close-box" type="button"><i class="ion-close-round"></i></button>
                                </div>
                                <div class="navbar-collapse" id="navbarContent">
                                    <!-- main-menu start -->
                                    <div class="megamenu-content">
                                        <div class="mainwrap">
                                            <ul class="main-menu">
                                                <li class="menu-link">
                                                    <a href="javascript:void(0)" class="link-title">
                                                        <span class="sp-link-title">Home</span>
                                                    </a>
                                                </li>
                                                <li class="menu-link">
                                                    <a href="about.html" class="link-title">
                                                        <span class="sp-link-title">About</span>
                                                    </a>
                                                </li>

                                                <li class="menu-link parent">
                                                    <a href="#collapse-top-page-menu" data-bs-toggle="collapse" class="link-title link-title-lg">
                                                        <span class="sp-link-title">Shop By Category</span>
                                                        <i class="fa fa-angle-down"></i>
                                                    </a>
                                                    <ul class="dropdown-submenu mega-menu collapse" id="collapse-top-page-menu">
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Cannabis Inflorescences </span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.99</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.30</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.00</span></a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu-1" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Cannabis Sublingual Oils </span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu-1">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>Fullspectrum</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>Boardspectrum</span></a></li>

                                                            </ul>
                                                        </li>
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu-2" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Cannabis Extraction </span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu-2">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>Fullspectrum</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>Boardspectrum</span></a></li>

                                                            </ul>
                                                        </li>
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu-3" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Certified Clones</span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu-3">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.99</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.30</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.00</span></a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu-4" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Certified Seeds</span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu-4">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.99</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.30</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.00</span></a></li>
                                                            </ul>
                                                        </li>
                                                        <li class="megamenu-li parent">
                                                            <a href="#account-menu-5" data-bs-toggle="collapse" class="sublink-title sublink-title-lg"><span>Trim Biomass</span> <i class="fa fa-angle-down"></i></a>
                                                            <ul class="dropdown-supmenu collapse" id="account-menu-5">
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.99</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.30</span></a></li>
                                                                <li class="supmenu-li"><a href="product-detail.html" class="sub-style"><span>0.00</span></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </li>

                                                <li class="menu-link">
                                                    <a href="faq.html" class="link-title">
                                                        <span class="sp-link-title">Faq</span>
                                                    </a>
                                                </li>
                                                <li class="menu-link">
                                                    <a href="contact.html" class="link-title">
                                                        <span class="sp-link-title">Contact</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- main-menu end -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- mobile menu end -->
        <!-- minicart start -->
        <div class="mini-cart">
            <a href="javascript:void(0)" class="shopping-cart-close"><i class="ion-close-round"></i></a>
            <div class="cart-item-title">
                <p>
                    <span class="cart-count-desc">There are</span>
                    <span class="cart-count-item bigcounter">4</span>
                    <span class="cart-count-desc">Products</span>
                </p>
            </div>
            <ul class="cart-item-loop">
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="#">
                            <img src="image/product1.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="#">Fresh apple 5kg</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">CHF 250.00</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="#"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="cart-item">
                    <div class="cart-img">
                        <a href="#">
                            <img src="image/product2.jpg" alt="cart-image" class="img-fluid">
                        </a>
                    </div>
                    <div class="cart-title">
                        <h6><a href="#">Natural grassbean 4kg</a></h6>
                        <div class="cart-pro-info">
                            <div class="cart-qty-price">
                                <span class="quantity">1 x </span>
                                <span class="price-box">CHF 300.00</span>
                            </div>
                            <div class="delete-item-cart">
                                <a href="#"><i class="icon-trash icons"></i></a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
            <ul class="subtotal-title-area">
                <li class="subtotal-info">
                    <div class="subtotal-titles">
                        <h6>Sub total:</h6>
                        <span class="subtotal-price">CHF 750.00</span>
                    </div>
                </li>
                <li class="mini-cart-btns">
                    <div class="cart-btns">
                        <a href="#" class="btn btn-style2"><span>View cart</span></a>
                        <a href="#" class="btn btn-style2"><span>Checkout</span></a>
                    </div>
                </li>
            </ul>
        </div>
        <!-- minicart end -->
        <!-- search start -->
        <div class="modal fade" id="search-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="search-content">
                                        <div class="search-engine">
                                            <input type="text" name="search" placeholder="Search Product.">
                                            <button class="search-btn" type="button"><i class="ion-ios-search-strong"></i></button>
                                        </div>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="ion-close-round"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- search end -->
    </header>

    <!-- main -->
    @yield('content')
    <!-- footer start -->
    <section class="footer4 section-tb-padding ">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="home4-footer">
                        <div class="f-logo">
                            <ul class="footer-ul">
                                <li class="footer-li footer-logo">
                                    <a href="index.html">
                                        <img class="img-fluid" src="{{asset('public/image/footer-logo.png')}}" alt="">
                                    </a>
                                </li>
                                <li class="footer-li footer-address">
                                    <ul class="foote-map">
                                        <li class="footer-icon">
                                            <i class="ion-ios-location"></i>
                                        </li>
                                        <li class="footer-add">
                                            <span>Cbd Logistics</span>
                                            <span>6557- Cama
                                                Switzerland
                                                CHE-190.569.496</span>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer-li footer-contact">
                                    <ul class="footer-num">
                                        <li class="footer-icon">
                                            <i class="ion-ios-telephone"></i>
                                        </li>
                                        <li class="footer-info">
                                            <a href="tel:+41918301114">Phone: +41918301114</a>
                                            <a href="mailto:info@cbdlogistics.swiss">Email: info@cbdlogistics.swiss</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-bottom">
                            <div class="footer-link" id="footer-accordian">
                                <div class="f-link">
                                    <h2 class="h-footer">Privacy & aerms</h2>
                                    <a href="#services" data-bs-toggle="collapse" class="h-footer">
                                        <span>Privacy & terms</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="f-link-ul collapse" id="services" data-bs-parent="#footer-accordian">
                                        <li class="f-link-ul-li"><a href="privacy-policy.html">Payment policy</a></li>
                                        <li class="f-link-ul-li"><a href="privacy-policy.html">Privacy policy</a></li>
                                        <li class="f-link-ul-li"><a href="faq.html">Faq</a></li>
                                        <li class="f-link-ul-li"><a href="#">Secure payments</a></li>
                                        <li class="f-link-ul-li"><a href="#">My Account</a></li>
                                    </ul>
                                </div>
                                <div class="f-link">
                                    <h2 class="h-footer">My account</h2>
                                    <a href="#privacy" data-bs-toggle="collapse" class="h-footer">
                                        <span>My account</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="f-link-ul collapse" id="privacy" data-bs-parent="#footer-accordian">
                                        <li class="f-link-ul-li"><a href="#">My account</a></li>
                                        <li class="f-link-ul-li"><a href="cart.html">My cart</a></li>
                                        <li class="f-link-ul-li"><a href="#">Order history</a></li>
                                        <li class="f-link-ul-li"><a href="wishlist.html">My wishlist</a></li>
                                        <li class="f-link-ul-li"><a href="#">My address</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="footer-deal">
                            <div class="f-deal-content">
                                <h2>Get the latest deals</h2>
                                <p>Ana receive 20$ coupon for first shopping</p>
                            </div>
                            <div class="footer-search">
                                <form>
                                    <input type="text" name="email" placeholder="Enter your emain address">
                                    <a href="javascript:void(0)" class="btn btn-style1"><span><i class="ion-paper-airplane"></i></span></a>
                                </form>
                                <ul class="f-bottom">
                                    <li class="f-social">
                                        <a href="https://www.linkedin.com/" class="f-icn-link"><i class="fa fa-linkedin"></i></a>
                                        <a href="https://www.instagram.com/" class="f-icn-link"><i class="fa fa-instagram"></i></a>

                                        <a href="https://www.facebook.com/" class="f-icn-link"><i class="fa fa-facebook-f"></i></a>
                                        <a href="https://www.youtube.com/" class="f-icn-link"><i class="fa fa-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-12 mt-4">
                    <div class="map text-center">
                        <img src="{{asset('public/image/ios.png')}}">
                        <img src="{{asset('public/image/android.png')}}">
                    </div>
                </div>

                <div class="col-lg-12 mt-4">
                    <div class="map text-center">
                        <img src="{{asset('public/image/map.png')}}">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- footer end -->

    <!-- copyright start -->
    <section class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col">
                    <ul class="f-bottom">
                        <li class="f-c f-copyright">
                            <p>Copyright <i class="fa fa-copyright"></i> 2021 CBD Logistics rights reserved</p>
                            <span>Cbd Logistics products are not medicines and can not diagnose, treat or cure diseases. Always consult your own doctor before starting a new dietary program.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- copyright end -->

    <!-- back to top start -->
    <a href="javascript:void(0)" class="scroll" id="top">
        <span><i class="fa fa-angle-double-up"></i></span>
    </a>

    <!-- jquery -->
    <script src="{{asset('public/js/modernizr-2.8.3.min.js')}}"></script>
    <script src="{{asset('public/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('public/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/js/popper.min.js')}}"></script>
    <script src="{{asset('public/js/swiper.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('public/js/custom.js')}}"></script>


    <script>
        $(document).on('click', '.lang', function() {
            var language = $(this).attr('value');
            if (language == "en" || language == "fr" || language == "de" || language == 'it') {
                var thisHtml = $(this).html();
                var selectedHtml = $('#selectedLang').html();
                $(this).attr('value', $('#selectedLang').attr('value'))
                $(this).html(selectedHtml);
                $('#selectedLang').html(thisHtml)
                $('#selectedLang').attr('value', language);

                $.ajax({
                    type: "GET",
                    data: {
                        language: language
                    },
                    url: '{{route("locale")}}',
                    success: function() {
                        window.location.reload()
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })



        $(document).on('click', '.curr', function() {
            var currency = $(this).attr('value');
            if (currency == "eur" || currency == "usd" || currency == "chf" || currency == 'rub') {
                var thisHtml = $(this).html();
                var selectedHtml = $('#selectedCurrency').html();
                $(this).attr('value', $('#selectedCurrency').attr('value'))
                $(this).html(selectedHtml);
                $('#selectedCurrency').html(thisHtml)
                $('#selectedCurrency').attr('value', currency);

                $.ajax({
                    type: "GET",
                    data: {
                        currency: currency
                    },
                    url: '{{route("currency")}}',
                    success: function() {
                        window.location.reload()
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        })




        function wishlist(id, type) {
            $.ajax({
                type: "POST",
                data: {
                    type: type,
                    product_id: id,
                    _token: "{{csrf_token()}}"
                },
                url: '{{route("wishlist")}}',
                success: function(data) {
                    alert(data.message)
                    $('.wishlist-counter').html(data.count)
                    $(`#remove_wishlist_${id}`).remove()
                    $('.wishlist-items').html(`${data.count} Item`)
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }


        function cart(id, type, attributes) {
            $.ajax({
                type: "POST",
                data: {
                    type: type,
                    product_id: id,
                    attributes: attributes,
                    _token: "{{csrf_token()}}"
                },
                url: '{{route("cart")}}',
                success: function(data) {
                    alert(data.message)
                    $('#cart-total').html(data.count)
                    // $(`#remove_wishlist_${id}`).remove()
                    // $('.wishlist-items').html(`${data.count} Item`)
                },
                error: function(err) {
                    console.log(err);
                    alert(err.responseJSON.message)
                }
            })
        }
    </script>
</body>

</html>