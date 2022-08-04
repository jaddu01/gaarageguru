@extends('layouts.master')
@section('title',$title)
 @section('content')
 	<script type="text/javascript">
		window.addEventListener("scroll", function(){
			var header = document.querySelector("header");
			header.classList.toggle("sticky", window.scrollY > 0);
		})
	</script>

    <!--  reputation  section start -->

    <section class="reputation">
        <div class="container">
            <div class="reputation-inner">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="reputation-left">
                            <img src="{{asset("public/img/reputation.png")}}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="reputation-right">
                            <div class="all-sec-heading">
                                <h2><span>A Reputation</span> 500+ <br>
                                    Days in the Making</h2>
                                <p>Below are some of our featured services</p>
                                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
                            </div>
                            <p class="small-f-para">Although Gaarage Guru started in the year 2020 but has been
                                involved in general automotive repair for over a decade, and
                                the business continues to grow.
                                <br> <br>
                                Gaarage Guru, Car Repair Service is a family owned organized
                                auto repair service based out of Jaipur, Rajasthan serving our
                                local community and surrounding areas for 2 years. Our
                                certified technicians from companies like; Maruti, Toyota &
                                Mahindra with years of hands-on experience are ready to deal
                                with any car repair needed or vehicle issues you may be
                                experiencing.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  reputation section end -->



    <!-- mission for section start -->
    <section class="mission">
        <div class="container">
            <div class="mission-main">
                <div class="row">

                    <div class="col-md-4">
                        <div class="mission-inner">
                            <div><img src="{{asset("public/img/mission.svg")}}" alt=""></div>
                            <h6>Mission Statement</h6>
                            <p>Our Mission is to serve our customers and always deliver the highest level of customer service; to develop our team and strive to constantly improve; and to conduct ourselves in an environmentally responsible manner.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mission-inner">
                            <div><img src="{{asset("public/img/mission.svg")}}" alt=""></div>
                            <h6>Our Vision</h6>
                            <p>To be the world’s most exciting leader in automotive business intelligence solutions. We will generate excitement through implementing pioneering ideas, problem solving & going beyond our customers’ expectations.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mission-inner mission-ul-last">
                            <div><img src="{{asset("public/img/mission.svg")}}" alt=""></div>
                            <h6>Core Values</h6>
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Teamwork through Trust and Respect.</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Commitment to Customer </li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Enthusiasm.</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Accountability at all Levels.</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>Passion for Winning.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- mission section end -->

    <!-- service advantages section start -->
    <section class="service-advantage">
        <div class="container-fluid">
            <div class="service-advantage-main">
                <div class="row">

                    <div class="col-md-6 col-lg-3">
                        <div class="service-advantage-inner advantage-1">
                            <div class="advantage-inner-new">
                                <h5>Advantages <br>
                                    of <span>Our Service</span></h5>
                                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
                                <p>Auto servicing your car is an
                                    essential task that should not
                                    be ignored or forgotten.</p>
                                <div class="all-btn-sec">
                                    <a href="javascript:void(0);" onclick="openBookingPopup();">Get a Quote</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-advantage-inner advantage-2">
                            <div class="advantage-inner-new">
                                <div>
                                    <img src="{{asset("public/img/mission.svg")}}" alt="">
                                </div>
                                <h6>Customer-Oriented <br>
                                    Service</h6>
                                <p>We value the service we provide
                                    and our loyal returning customers
                                    can always expect some
                                    appreciation from us, like a future
                                    service discount etc.</p>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-advantage-inner advantage-3">
                            <div class="advantage-inner-new">
                                <div>
                                    <img src="{{asset("public/img/mission.svg")}}" alt="">
                                </div>
                                <h6>Affordable Prices <br>
                                    of Services</h6>
                                <p>We value the service we provide
                                    and our loyal returning customers
                                    can always expect some
                                    appreciation from us, like a future
                                    service discount etc.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-advantage-inner advantage-4">
                            <div class="advantage-inner-new">
                                <div>
                                    <img src="{{asset("public/img/mission.svg")}}" alt="">
                                </div>
                                <h6>High-Quality <br>
                                    Car Parts</h6>
                                <p>We value the service we provide
                                    and our loyal returning customers
                                    can always expect some
                                    appreciation from us, like a future
                                    service discount etc.</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- service advantages  section end -->

    <!-- meet team section start  -->
    <section class="meet-team p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Meet the Team</h2>
                <p>by working on many makes, our technicians can be trusted
                    to properly diagnose different repairs</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="meet-team-main">
                <div class="row">

                    <div class="owl-carousel owl-theme" id="teamOwl">
                        <div class="item">
                            <div>
{{--                                <img src="{{asset("public/img/team1.png")}}" alt="">--}}
                            </div>
                            <div class="team-content">
                                <h6>Abhishek Sawal</h6>
                                <p>Founder & Director Operations</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- meet team section end  -->




    <!-- service gallery  section start -->
    <section class="service-gallery">
        <div class="container-fluid">
            <div class="all-sec-heading">
                <h2>Our Service Gallery</h2>
                <p>These Photos will help you learn more about our car
                    Service and Services Provided</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="service-gallery-main">
                <div class="row">
                    <div class="owl-carousel owl-theme" id="galleryOwl">
                        <div class="item"><img src="{{asset("public/img/gallery-1.png")}}" alt=""></div>
                        <div class="item"><img src="{{asset("public/img/gallery-2.png")}}" alt=""></div>
                        <div class="item"><img src="{{asset("public/img/gallery-4.png")}}" alt=""></div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- service gallery section end -->






    <!-- vehicle damage section start -->
    <section class="vehicle-damage p_70">
        <div class="container">
            <div class="all-sec-heading schedule-bg">
                <h2>Need Help With Your Car? <span>We'll fix it</span></h2>
                <p>We specialize in repairing accident damage to vehicles. We're also very much
                    experienced handling 'Cashless Claim' for your beloved car</p>
                <h5>+91 95499 88333</h5>
                <div class="all-btn-sec">
                    <a href="tel:+91 95499 88333">Appointment</a>
                </div>
            </div>
            <div class="vehicle-damage-main">
                <div class="vehicle-damage-img">
                    <img src="{{asset("public/img/vehicledamage-img.png")}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- vehicle damage section end -->


 @endsection
@push("scripts")

    <script>
        $('#teamOwl').owlCarousel({
            loop:true,
            margin:60,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:3
                }
            }
        })
    </script>

    <script>
        $('#galleryOwl').owlCarousel({
            loop:true,
            margin:0,
            nav:false,
            autoplay:true,
            autoplayTimeout:4000,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                },
                1000:{
                    items:4
                }
            }
        })
    </script>
@endpush

