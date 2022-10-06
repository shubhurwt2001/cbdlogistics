@extends('Frontend.layouts.common')
@php
$locale = app()->getLocale();
$currency = session()->get('currency') ? session()->get('currency') : 'eur';
@endphp
@section('title',$category['meta_title_'.$locale])
@section('description',$category['meta_content_'.$locale])
@section('keywords',$category['meta_keyword_'.$locale])

@section('content')
<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>{{$category['name_'.$locale]}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-12 grid-list-area">
                <ul class="grid-list-select">
                    <ul class="grid-list nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true"><i class="ti-layout-list-thumb"></i></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false"><i class="ti-layout-grid2"></i></button>
                        </li>
                    </ul>

                    <ul class="grid-list-selector">
                        <li>
                            <label>Sort by</label>
                            <select>
                                <option>Featured</option>
                                <option>Best selling</option>
                                <option>Alphabetically,A-Z</option>
                                <option>Alphabetically,Z-A</option>
                                <option>Price, low to high</option>
                                <option>Price, high to low</option>
                                <option>Date new to old</option>
                                <option>Date old to new</option>
                            </select>
                        </li>
                    </ul>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="list-product">
                            @foreach($category->products as $product)
                            <div class="list-items">
                                <div class="tred-pro">
                                    <div class="tr-pro-img">
                                        <a href="{{url($product['slug_'.$locale])}}">
                                            @foreach($product->images as $image)
                                            @if($loop->iteration == 1)
                                            <img src="{{asset('public'.$image['slug_'.app()->getLocale()])}}" class="img-fluid">
                                            @elseif($loop->iteration == 2)
                                            <img src="{{asset('public'.$image['slug_'.app()->getLocale()])}}" class="img-fluid additional-image">
                                            @endif
                                            @endforeach
                                        </a>
                                    </div>
                                </div>
                                <div class="caption">
                                    <h3><a href="{{url($product['slug_'.$locale])}}">{{$product['name_'.$locale]}}</a></h3>
                                    {!! $product['short_desc_'.$locale] !!}
                                    <div class="pro-price">
                                        <span class="new-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                                    </div>
                                    <div class="pro-icn">
                                        <a href="wishlist.html" class="w-c-q-icn"><i class="fa fa-heart"></i></a>
                                        <a href="javascript:void(0)" onclick="cart('{{$product->id}}','add','')" class="w-c-q-icn"><i class="fa fa-shopping-bag"></i></a>
                                        <a href="javascript:void(0)" class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade grid-list-area  show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="grid-pro">
                            <ul class="grid-product">
                                @foreach($category->products as $product)
                                <li class="grid-items">
                                    <div class="tred-pro">
                                        <div class="tr-pro-img">
                                            <a href="{{url($product['slug_'.$locale])}}">
                                                @foreach($product->images as $image)
                                                @if($loop->iteration == 1)
                                                <img src="{{asset('public'.$image['slug_'.app()->getLocale()])}}" class="img-fluid">
                                                @elseif($loop->iteration == 2)
                                                <img src="{{asset('public'.$image['slug_'.app()->getLocale()])}}" class="img-fluid additional-image">
                                                @endif
                                                @endforeach
                                            </a>
                                        </div>
                                        <div class="pro-icn">
                                            <a href="wishlist.html" class="w-c-q-icn"><i class="fa fa-heart"></i></a>
                                            <a href="javascript:void(0)" onclick="cart('{{$product->id}}','add','')" class="w-c-q-icn"><i class="fa fa-shopping-bag"></i></a>
                                            <a href="javascript:void(0)" class="w-c-q-icn" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3><a href="{{url($product['slug_'.$locale])}}">{{$product['name_'.$locale]}}</a></h3>
                                        <div class="pro-price">
                                            <span class="new-price">{{$currency}} {{$product['price_'.$currency]}}</span>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection