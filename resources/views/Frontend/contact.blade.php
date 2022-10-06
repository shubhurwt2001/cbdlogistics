@extends('Frontend.layouts.common')
@php
$locale = app()->getLocale();
@endphp
@section('title','Contact')
@section('description',"contact")
@section('keywords',"contact")

@section('content')
<section class="about-breadcrumb">
    <div class="about-back section-tb-padding" style="background-image: url({{asset('public/image/breadcrumb-bg.jpg')}})">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="about-l">
                        <ul class="about-link">
                            <li class="go-home"><a href="{{url('/')}}">Home</a></li>
                            <li class="about-p"><span>Contact</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="contact section-tb-padding">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="map-area">
                    <div class="map-title">
                        <h1>Contact us</h1>
                    </div>
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2757.936345728932!2d9.166933115786923!3d46.27136928724109!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47844f48fd4bf96d%3A0xdf189ec8ec3caac8!2sCbd%20Logistics!5e0!3m2!1sen!2sin!4v1661163186736!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="map-details section-t-padding">
                        <div class="contact-info">
                            <div class="contact-details">
                                <h4>Drop us message</h4>
                                <form>
                                    <label>Your name</label>
                                    <input type="text" name="name" placeholder="Enter your name">
                                    <label>Email</label>
                                    <input type="text" name="Email" placeholder="Enter your email address">
                                    <label>Message</label>
                                    <textarea rows="5" placeholder="Your message hare..."></textarea>
                                </form>
                                <a href="#" class="btn-style1">Submit <i class="ti-arrow-right"></i></a>
                            </div>
                        </div>
                        <div class="contact-info">
                            <div class="information">
                                <h4>Get in touch</h4>
                                <p class="info-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum earum eveniet dolorum suscipit nesciunt incidunt animi repudiandae ab at, tenetur distinctio voluptate vel illo similique.</p>
                                <div class="contact-in">
                                    <ul class="info-details">
                                        <li><i class="fa fa-street-view"></i></li>
                                        <li>
                                            <h4>Address</h4>
                                            <p>Cbd Logistics Shop
                                                c/o Orgena SA
                                                Stradon 116
                                                6557 Cama
                                                Switzerland</p>
                                        </li>
                                    </ul>
                                    <ul class="info-details">
                                        <li><i class="fa fa-phone"></i></li>
                                        <li>
                                            <h4>Phone</h4>
                                            <p>+41918301114</p>
                                        </li>
                                    </ul>
                                    <ul class="info-details">
                                        <li><i class="fa fa-envelope"></i></li>
                                        <li>
                                            <h4>Email</h4>
                                            <p>info@cbdlogistics.swiss</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection