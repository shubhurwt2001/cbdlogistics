@extends('Frontend.layouts.common')
@php
$locale = app()->getLocale();
$currency = session()->get('currency') ? session()->get('currency') : 'eur';
@endphp
@section('title',$product['meta_title_'.$locale])
@section('description',$product['meta_content_'.$locale])
@section('keywords',$product['meta_keyword_'.$locale])

@section('content')
<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="go-home"><a href="{{url($product->category['slug_'.$locale])}}">{{$product->category['name_'.$locale]}}</a></li>
                            <li class="go-home"><a href="{{url($product->subcategory['slug_'.$locale])}}">{{$product->subcategory['name_'.$locale]}}</a></li>
                            <li class="about-p"><span>{{$product['name_'.$locale]}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- product info start -->
<section class="section-tb-padding pro-page">
    <div class="container pro-image">
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-6 col-12 col-xs-12 larg-image">
                <div class="tab-content">
                    @foreach($product->images as $image)
                    <div class="tab-pane fade show @if($loop->iteration == 1) active @endif" id="image-{{$image->id}}">
                        <a href="javascript:void(0)" class="long-img">
                            <figure style="background-image: url({{asset('public'.$image['slug_'.$locale])}})">
                                <img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image">
                            </figure>
                        </a>
                    </div>
                    @endforeach
                    <div class="tab-pane fade show" id="image-common">
                        <a href="javascript:void(0)" class="long-img">
                            <figure style="background-image: url({{asset('public/image/cbdlogistics.jpg')}});background-size: cover">
                                <img src="{{asset('public/image/cbdlogistics.jpg')}}" class="img-fluid" alt="image">
                            </figure>
                        </a>
                    </div>
                </div>
                <ul class="nav nav-tabs pro-page-slider owl-carousel owl-theme">
                    @foreach($product->images as $image)
                    <li class="nav-item items">
                        <a class="nav-link @if($loop->iteration == 1) active @endif" data-bs-toggle="tab" href="#image-{{$image->id}}"><img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image"></a>
                    </li>
                    @endforeach
                    <li class="nav-item items">
                        <a class="nav-link" data-bs-toggle="tab" href="#image-common"><img src="{{asset('public/image/cbdlogistics.jpg')}}" class="img-fluid" alt="image"></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 col-xl-6 col-md-6 col-12 col-xs-12 pro-info">
                <h4>{{$product['name_'.$locale]}}</h4>

                <div class="pro-price">
                    <span class="new-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                </div>
                {!! $product['short_desc_'.$locale] !!}

                @foreach($product->attributes as $key => $prod_attributes)
                <div class="pro-items">
                    @foreach($attributes as $attr)
                    @if($attr->id == $key)
                    <span class="pro-size">{{$attr['name_'.$locale]}}:</span>
                    @endif
                    @endforeach
                    <ul class="pro-wight">
                        @foreach($prod_attributes as $attribute)
                        <li><a href="javascript:void(0)" data-val="{{$attribute->id}}" class="attribute" @if($loop->iteration == 1) class="active" @endif>{{$attribute->name}} {{$attr['name_'.$locale]}}</a></li>
                        @endforeach
                    </ul>
                </div>
                @endforeach
                <div class="pro-qty">
                    <span class="qty">Quantity:</span>
                    <div class="plus-minus">
                        <span>
                            <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                            <input type="text" name="name" id="quantity" value="1">
                            <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                        </span>
                    </div>
                </div>
                <div class="pro-btn">
                    <a href="javascript:void(0)" onclick="wishlist('{{$product->id}}','add')" class="btn btn-style1"><i class="fa fa-heart"></i></a>
                    <a href="javascript:void(0)" onclick="addToCart()" class="btn btn-style1"><i class="fa fa-shopping-bag"></i> Add to cart</a>
                </div>
                <div class="pay-img">
                    <a href="javascript:void(0)">
                        <img src="{{asset('public/image/payments secure.png')}}" class="img-fluid" alt="pay-image">
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product info end -->
<!-- product page tab start -->
<section class="section-b-padding pro-page-content">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="pro-page-tab">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#tab-1">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-2">Product Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#tab-3">Reviews</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-1">
                            <div class="tab-1content">
                                {!! $product['desc_'.$locale] !!}
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="tab-2">
                            <div class="tab-1content text-center">
                                <figure>
                                    <img src="{{asset('public/image/4.jpg')}}">
                                </figure>
                                <p><b>Reference</b> : {{$product->reference}}</p>
                                <p><b>In Stock</b> : {{$product->quantity}} items</p>
                            </div>
                        </div>
                        <div class="tab-pane fade show" id="tab-3">
                            <h4 class="reviews-title">Customer reviews</h4>
                            <div class="customer-reviews t-desk-2">
                                <span class="p-rating">
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                </span>
                                <p class="review-desck">Based on 2 reviews</p>
                                <a href="#add-review" data-bs-toggle="collapse">Write a review</a>
                            </div>
                            <div class="review-form collapse" id="add-review">
                                <h4>Write a review</h4>
                                <form>
                                    <label>Name</label>
                                    <input type="text" name="name" placeholder="Enter your name">
                                    <label>Email</label>
                                    <input type="text" name="mail" placeholder="Enter your Email">
                                    <label>Rating</label>
                                    <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                    <label>Review title</label>
                                    <input type="text" name="mail" placeholder="Review title">
                                    <label>Add comments</label>
                                    <textarea name="comment" placeholder="Write your comments"></textarea>
                                </form>
                            </div>
                            <div class="customer-reviews">
                                <span class="p-rating">
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star-o"></i>
                                </span>
                                <h4 class="review-head">he also good and high product see like look</h4>
                                <span class="reviews-editor">kelin patel <span class="review-name">on</span> fab 5, 2021</span>
                                <p class="r-description">he also good and high product see like look</p>
                            </div>
                            <div class="customer-reviews">
                                <span class="p-rating">
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star e-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </span>
                                <h4 class="review-head">he also good and fresh fruit organic product see like look</h4>
                                <span class="reviews-editor">Melvin louis <span class="review-name">on</span> fab 5, 2021</span>
                                <p class="r-description">he also good and fresh fruit organic product see like look</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- product page tab end -->
@section('scripts')
<script>
    var product = <?php echo json_encode($product->id); ?>;
    var attribute = null;
    $(document).on('click', '.attribute', function() {
        attribute = null;
        $('.attribute').map(function() {
            $(this).removeClass('active')
        })
        $(this).addClass('active');
        attribute = $(this).attr('data-val')
    })

    function addToCart() {
        if (attribute > 0) {
            cart(product, 'add', attribute, $('#quantity').val())
        } else {
            alert("Please select a quantity.");
        }

    }
</script>

@endsection
@endsection