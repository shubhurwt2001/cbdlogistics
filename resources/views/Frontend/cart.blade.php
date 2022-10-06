@extends('Frontend.layouts.common')
@section('title','Cart - CBD Logistics')
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
                            <li class="about-p"><span>Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- collapse start -->
<section class="cart-page section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="cart-item">
                    <span class="cart-head">My cart:</span>
                    @if(Auth::check())
                    <span class="c-items">0 item</span>
                    @else
                    <span class="c-items">{{count(session()->get('cart',[]))}} item</span>
                    @endif
                </div>

                @foreach($products as $product)
                <div class="cart-area">
                    <div class="cart-details">
                        <div class="cart-all-pro">
                            <div class="cart-pro">
                                <div class="cart-pro-image">
                                    @foreach($product->images as $image)
                                    @if($loop->iteration == 1)
                                    <a href="{{$product['slug_'.$locale]}}"><img src="{{asset('public'.$image['slug_'.$locale])}}" class="img-fluid" alt="image"></a>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="pro-details">
                                    <h4><a href="{{$product['slug_'.$locale]}}">{{$product['name_'.$locale]}}</a></h4>
                                    <span class="pro-size"><span class="size">Qty:</span> 500ml</span>
                                    <span class="cart-pro-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                                </div>
                            </div>
                            <div class="qty-item">
                                <div class="center">
                                    <div class="plus-minus">
                                        <span>
                                            <a href="javascript:void(0)" class="minus-btn text-black">-</a>
                                            <input type="text" name="name" value="1">
                                            <a href="javascript:void(0)" class="plus-btn text-black">+</a>
                                        </span>
                                    </div>
                                    <a href="javascript:void(0)" class="pro-remove">Remove</a>
                                </div>
                            </div>
                            <div class="all-pro-price">
                                <span>{{$currency}} {{$product->cart_quantity*$product['price_'.$currency]}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="col-xl-3 col-xs-12 col-sm-12 col-md-12 col-lg-4">
                <div class="cart-total">
                    <div class="cart-price">
                        <span>Subtotal</span>
                        <span class="total">$78.44 CAD</span>
                    </div>
                    <div class="cart-info">
                        <h4>Shipping info</h4>
                        <form>
                            <label>Country</label>
                            <select class="form-select" aria-label="Default select example">
                                <option>---</option>
                                <option>Afghanistan</option>
                                <option>Åland Islands</option>
                                <option>Albania</option>
                            </select>
                            <label>Zip/postal code</label>
                            <input type="text" name="code" placeholder="Zip/postal code">
                        </form>
                        <a href="javascript:void(0)" class="cart-calculate">Calculate</a>
                    </div>
                    <div class="shop-total">
                        <span>Total</span>
                        <span class="total-amount">CHF 78.44 CAD</span>
                    </div>
                    <a href="javascript:void(0)" class="check-link">Checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection