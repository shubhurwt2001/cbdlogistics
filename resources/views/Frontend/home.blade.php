@extends('Frontend.layouts.common')
@section('title','CBD Logistics')
@section('description','CBD Logistics')
@section('keywords','CBD Logistics')
@php
$locale = app()->getLocale();
$currency = session()->get('currency') ? session()->get('currency') : 'eur';
@endphp
@section('content')
<!--home page slider start-->
<section class="home-slider-4">
    <div class="home-slider-main-4">
        <div class="home4-slider owl-carousel owl-theme">
            @foreach($banners as $banner)
            <div class="items">
                <div class="img-back s-image2">
                    <img src="{{asset('public'.$banner->url)}}">
                    <div class="slide-c-2 h-s-content">
                        @if(app()->getLocale() == 'en')
                        <span class="slider-name">{{$banner->title_en}}</span>
                        {!! $banner->description_en !!}
                        @endif
                        @if(app()->getLocale() == 'fr')
                        <span class="slider-name">{{$banner->title_fr}}</span>
                        {!! $banner->description_fr !!}
                        @endif
                        @if(app()->getLocale() == 'de')
                        <span class="slider-name">{{$banner->title_de}}</span>
                        {!! $banner->description_de !!}
                        @endif
                        @if(app()->getLocale() == 'it')
                        <span class="slider-name">{{$banner->title_it}}</span>
                        {!! $banner->description_it !!}
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--home page slider end-->

<!--banner start-->
<section class="t-banner1 section-t-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="home-offer-banner">
                    <div class="o-t-banner">
                        <a href="#" class="image-b">
                            <img class="img-fluid" src="{{asset('public/image/bg2.jpg')}}" alt="banner image">
                        </a>
                        <div class="o-t-content">
                            <h6>Amnesia, Blueberry, Boardspectrum CBD Oil</h6>
                            <a href="#" class="btn btn-style1">Shop now</a>
                        </div>
                    </div>
                    <div class="o-t-banner">
                        <a href="#" class="image-b">
                            <img class="img-fluid" src="{{asset('public/image/bg3.jpg')}}" alt="banner image">
                        </a>
                        <div class="o-t-content banner-color">
                            <h6>Fullspectrum CBD Oil 10%, Boardspectrum CBD Oil 20%</h6>
                            <a href="#" class="btn btn-style1">Shop now</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- banner end -->

<!-- products tab start -->
<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pro-tab">
                    <div class="section-title3">
                        <h2><span>Popular Products</span></h2>
                    </div>
                    <ul class="nav nav-tabs">
                        @foreach($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link  @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" href="#category_{{$category->id}}">{{$category['name_'.$locale]}} </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="tab-content tab-pro-slider">
                        @foreach($categories as $category)
                        <div class="tab-pane fade show @if($loop->iteration == 1) active @endif" id="category_{{$category->id}}">
                            <div class="home4-tab swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach($category->products as $product)
                                    <div class="swiper-slide">
                                        <div class="tab-product">
                                            <div class="tred-pro">
                                                <div class="tr-pro-img">
                                                    <a href="{{url($product['slug_'.$locale])}}">
                                                        @foreach($product->images as $image)
                                                        @if($loop->iteration == 1)
                                                        <img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid">
                                                        @elseif($loop->iteration == 2)
                                                        <img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid additional-image">
                                                        @endif
                                                        @endforeach
                                                    </a>
                                                </div>
                                                <div class="pro-icn">
                                                    <a href="javascript:void(0)" onclick="wishlist('{{$product->id}}','add')" class="w-c-q-icn"><i class="fa fa-heart"></i></a>
                                                    <a href="javascript:void(0)" onclick="cart('{{$product->id}}','add','')" class="w-c-q-icn"><i class="fa fa-shopping-bag"></i></a>
                                                    <a href="javascript:void(0)" class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#product_{{$product->id}}"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </div>
                                            <div class="tab-caption">
                                                <h3><a href="{{url($product['slug_'.$locale])}}">{{$product['name_'.$locale]}}</a></h3>
                                                <div class="rating">
                                                    <i class="fa fa-star e-star"></i>
                                                    <i class="fa fa-star e-star"></i>
                                                    <i class="fa fa-star e-star"></i>
                                                    <i class="fa fa-star e-star"></i>
                                                    <i class="fa fa-star e-star"></i>
                                                </div>
                                                <div class="pro-price">
                                                    <span class="new-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="swiper-buttons">
                                <div class="content-buttons">
                                    <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"></div>
                                    <div class="swiper-button-prev swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- teb product end -->
            </div>
        </div>
    </div>
</section>
<!-- quick veiw start -->
<section class="quick-view">
    @foreach($categories as $category)
    @foreach($category->products as $product)
    <div class="modal fade" id="product_{{$product->id}}" tabindex="-1" aria-labelledby="product_{{$product->id}}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="product_{{$product->id}}">Product quickview</h5>
                    <a href="javascript:void(0)" data-bs-dismiss="modal" aria-label="Close"><i class="ion-close-round"></i></a>
                </div>
                <div class="quick-veiw-area">
                    <div class="quick-image">
                        <div class="tab-content">
                            @foreach($product->images as $image)
                            <div class="tab-pane fade  @if($loop->iteration == 1) show active @endif" id="image-{{$image->id}}">
                                <a href="javascript:void(0)" class="long-img">
                                    <img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <ul class="nav nav-tabs quick-slider owl-carousel owl-theme">
                            @foreach($product->images as $image)
                            <li class="nav-item items">
                                <a class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" href="#image-{{$image->id}}"><img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image"></a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="quick-caption">
                        <h4>{{$product['name_'.$locale]}}</h4>
                        <div class="quick-price">
                            <span class="new-price" id="prod_price_{{$product->id}}">{{$currency}} {{$product['price_'.$currency]}}</span>
                            <!-- <span class="old-price"><del>{{$currency}} 399.99</del></span> -->
                        </div>
                        <div class="quick-rating">
                            <i class="fa fa-star c-star"></i>
                            <i class="fa fa-star c-star"></i>
                            <i class="fa fa-star c-star"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <div class="pro-description">
                            <p>{!! $product['short_desc_'.$locale] !!}</p>
                        </div>


                        @foreach($product->attributes as $key => $prod_attributes)
                        <div class="pro-size">
                            @foreach($attributes as $attr)
                            @if($attr->id == $key)
                            <label>{{$attr['name_'.$locale]}}: </label>
                            @endif
                            @endforeach
                            <select data-pro="{{$product->id}}" data-cat="{{$category->id}}" id="attribute_{{$product->id}}" class="attribute">
                                <option value="" disabled selected>Select</option>
                                @foreach($prod_attributes as $attribute)
                                <option value="{{$attribute->id}}">{{$attribute->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endforeach
                        <div class="plus-minus">
                            <span>
                                <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                                <input type="number" class="quantity" name="name" id="quantity_{{$product->id}}" value="1">
                                <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                            </span>
                            <a href="javascript:void(0)" data-val="{{$product->id}}" class="quick-cart"><i class="fa fa-shopping-bag"></i></a>
                            <a href="javascript:void(0)" onclick="wishlist('{{$product->id}}','add')" class="quick-wishlist"><i class="fa fa-heart"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @endforeach
</section>
<!-- quick veiw end -->

<!-- Back-image and countdown star -->
<section class="home-countdown1">
    <div class="back-img" style="background-image: url({{asset('public/image/bg1.jpg')}});">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="deal-content">
                        <h2>Deal Of The Day!</h2>
                        <span class="deal-c">We offer a hot deal offer every festival</span>
                        <ul class="contdown_row">
                            <li class="countdown_section">
                                <span id="days" class="countdown_timer">254</span>
                                <span class="countdown_title">Days</span>
                            </li>
                            <li class="countdown_section">
                                <span id="hours" class="countdown_timer">11</span>
                                <span class="countdown_title">Hours</span>
                            </li>
                            <li class="countdown_section">
                                <span id="minutes" class="countdown_timer">33</span>
                                <span class="countdown_title">Minutes</span>
                            </li>
                            <li class="countdown_section">
                                <span id="seconds" class="countdown_timer">36</span>
                                <span class="countdown_title">Seconds</span>
                            </li>
                        </ul>
                        <a href="#" class="btn btn-style1">Shop collection</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Back image and countdown end -->

<!-- category image start -->
<section class="section-tb-padding home4-category blog1">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="section-title3">
                    <h2><span>Shop by category</span></h2>
                </div>
                <div class="home4-cate owl-carousel owl-theme">
                    @foreach($categories as $category)
                    <div class="items">
                        <div class="cate-image">
                            <a href="{{url($category['slug_'.$locale])}}">
                                <img src="{{asset('public'.$category['image_slug_'.$locale])}}" class="img-fluid" alt="cate-image">
                                <span class="cate-title">{{$category['name_'.$locale]}}</span>
                            </a>
                            <span class="cate-item">{{count($category->products)}} item</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="container section-t-padding">
        <div class="row">
            <div class="col">
                <div class="section-title3">
                    <h2><span>Latest Post</span></h2>
                </div>
                <div class="home-blog owl-carousel owl-theme">
                    <div class="items">
                        <div class="blog-start">
                            <div class="blog-image">
                                <a href="#">
                                    <img src="image/blog1.jpg" alt="blog-image" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-title">
                                    <h6><a href="#">CBD E-LIQUIDS AND CBD CARTRIDGE: WHAT IS THE DIFFERENCE? </a></h6>
                                    <span class="blog-admin">3684 <span class="blog-editor">Views</span></span>
                                </div>
                                <p class="blog-description">E-liquids are the liquids used in electronic devices and e-cigarettes. These devices..</p>
                                <a href="#" class="read-link">
                                    <span>Read more</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="blog-start">
                            <div class="blog-image">
                                <a href="#">
                                    <img src="image/blog2.jpg" alt="blog-image" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-title">
                                    <h6><a href="#">HEMP AND BLOCKCHAIN: The new "Seed-to-Shelf" tracking tool </a></h6>
                                    <span class="blog-admin">3684 <span class="blog-editor">Views</span></span>
                                </div>
                                <p class="blog-description">Cryptocurrencies and Cannabis have similar aspects: booming sectors that have suffered...</p>
                                <a href="#" class="read-link">
                                    <span>Read more</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="blog-start">
                            <div class="blog-image">
                                <a href="#">
                                    <img src="image/blog3.jpg" alt="blog-image" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-title">
                                    <h6><a href="#">HEMP CULTIVATION: the know-how necessary to start a successful production</a></h6>
                                    <span class="blog-admin">3684 <span class="blog-editor">Views</span></span>
                                </div>
                                <p class="blog-description">Hemp contains various active ingredients, among which the best known are cannabidiol...</p>
                                <a href="#" class="read-link">
                                    <span>Read more</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="items">
                        <div class="blog-start">
                            <div class="blog-image">
                                <a href="#">
                                    <img src="image/blog4.jpg" alt="blog-image" class="img-fluid">
                                </a>
                            </div>
                            <div class="blog-content">
                                <div class="blog-title">
                                    <h6><a href="#">CBD For Insomnia: Can CBD Help You Sleep Better</a></h6>
                                    <span class="blog-admin">4444 <span class="blog-editor">Views</span></span>
                                </div>
                                <p class="blog-description">It’s true. Scientists have studied CBD for insomnia and came to promising conclusions....</p>
                                <a href="#" class="read-link">
                                    <span>Read more</span>
                                    <i class="ti-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="all-blog">
                    <a href="#" class="btn btn-style1">View all</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- category image end -->
@section('scripts')
<script>
    var categories = <?php echo json_encode($categories); ?>;
    var currency = <?php echo json_encode($currency); ?>;
    $(document).on('change', '.attribute', function() {
        var attribute = $(this).val();
        var product = $(this).attr('data-pro')
        var category = $(this).attr('data-cat')

        categories.map(function(cat) {
            if (cat.id == category) {
                cat.products.map(function(pro) {
                    if (pro.id == product) {
                        pro.allAttributes.map(function(attr) {
                            if (attr.id == attribute) {
                                $(`#prod_price_${product}`).html(`${currency} ${parseFloat(attr['price_'+currency]*$(`#quantity_${product}`).val()).toFixed(2)}`)
                            }
                        })
                    }
                })
            }
        })
    })

    $(document).on('click', '.quick-cart', function() {
        var product = $(this).attr('data-val');
        var quantity = $(`#quantity_${product}`).val();
        var attribute = $(`#attribute_${product}`).val();

        if (quantity <= 0) {
            alert("Minimum quantity should be 1.")
            return
        }

        if (!attribute) {
            alert("Please select a quantity.")
            return
        }

        cart(product, 'add', attribute, quantity);
    })
</script>
@endsection
@endsection