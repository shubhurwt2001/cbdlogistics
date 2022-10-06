@extends('Frontend.layouts.common')
@php
$locale = app()->getLocale();
@endphp
@section('title',$page['meta_title_'.$locale])
@section('description',$page['meta_content_'.$locale])
@section('keywords',$page['meta_keyword_'.$locale])

@section('content')
<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>{{$page['title_'.$locale]}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about-content section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! $page['content_'.$locale] !!}
            </div>
        </div>
    </div>
</section>
@endsection