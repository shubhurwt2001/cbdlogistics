@extends('Frontend.layouts.common')
@section('title','Wishlist - CBD Logistics')
@section('description','CBD Logistics')
@section('keywords','CBD Logistics')
@section('content')
@php
$locale = app()->getLocale();
$currency = session()->get('currency') ? session()->get('currency') : 'eur';
@endphp

<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>Wishlist</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- collapse start -->
<section class="wishlist-page section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="wishlist-item">
                    <span class="wishlist-head">My wishlist:</span>
                    @if(Auth::check())
                    <span class="wishlist-items">0 item</span>
                    @else
                    <span class="wishlist-items">{{count($products)}} item</span>
                    @endif
                </div>
                @foreach($products as $product)
                <div class="wishlist-area" id="remove_wishlist_{{$product->id}}">
                    <div class="wishlist-details">
                        <div class="wishlist-all-pro">
                            <div class="wishlist-pro">
                                <div class="wishlist-pro-image">
                                    @foreach($product->images as $image)
                                    @if($loop->iteration == 1)
                                    <a href="{{$product['slug_'.$locale]}}"><img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image"></a>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="pro-details">
                                    <h4><a href="{{$product['slug_'.$locale]}}">{{$product['name_'.$locale]}}</a></h4>
                                    <span class="all-size">{!! $product['short_desc_'.$locale] !!}</span>
                                    <span class="wishlist-text">{{$product->category['name_'.$locale]}}</span>
                                </div>
                            </div>
                            <div class="qty-item">
                                <a href="javascript:void(0)" onclick="cart('{{$product->id}}','add','')" class="add-wishlist">Add to cart</a>
                                <a href="#" class="add-wishlist">Buy now</a>
                            </div>
                            <div class="all-pro-price">
                                <span class="new-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                                <span onclick="wishlist('{{$product->id}}','remove')"><i class="ion-android-close"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection