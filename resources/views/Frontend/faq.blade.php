@extends('Frontend.layouts.common')
@section('title','FAQ - CBD Logistics')
@section('description','CBD Logistics')
@section('keywords','CBD Logistics')

@section('content')
<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>FAQ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb end -->

<!-- collapse start -->
<section class="faq-collapse section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                @foreach($faqs as $faq)
                @php
                $question = 'question_'.app()->getLocale();
                $answer = 'answer_'.app()->getLocale();
                @endphp
                <div class="faq-start">
                    <span>Q.{{$loop->iteration}}</span>
                    <a href="#collapse-{{$loop->iteration}}" data-bs-toggle="collapse" class="collapse-title">{{$faq[$question]}}</a>
                    <div class="collapse show collapse-content" id="collapse-{{$loop->iteration}}">
                        {!! $faq[$answer] !!}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection