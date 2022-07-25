@extends('front.layouts.master')
@section('title',$title)
 @section('content')
  <section class="hero-part">
        <div class="hero-content pt-0">

            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
				@if(!empty($banner))
					@foreach($banner as $key => $row)
                    <div class="carousel-item {{$key == 0 ? 'active' : ''}}">
							@if($row->image!="" && file_exists(public_path().'/media/banner/'.$row->image))
								<img class="d-block w-100" src="{{asset('/public/media/banner').'/'.$row->image}}" />
							@else
								<img class="d-block w-100" src="{{asset('/public/media/no-image.png')}}" />
							@endif 
                    </div>
					@endforeach
				@endif	
                 
                    <!-- <div class="carousel-item">
                        <img src="images/banner3.jpg" class="d-block w-100" alt="...">
                    </div> -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="learning-experience-section">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="learning-experience-box">
                            <h3 class="web-heading text-center">Learn better with our 360º learning platform</h3>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-4.png') }}">
                                    </div>
                                    <h3>All benefits of Course</h3>
                                    <p>Live classes from top educators, mock tests & quizzes, structured batch courses in line with exam syllabus</p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-delay="300" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-3.png') }}">
                                    </div>
                                    <h3>Structured courses</h3>
                                    <p> All our courses are structured in line with your exam syllabus to help you with best preparation for Nursing & Paramedical Exams</p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-delay="600" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-5.svg') }}">
                                    </div>
                                    <h3>Daily live classes</h3>
                                    <p>Chat with your Teacher, engage in discussions, ask your doubts, and get all answers  while the class is going on</p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-6.svg') }}">
                                    </div>
                                    <h3>Live tests & quizzes</h3>
                                    <p>Evaluate your preparation with our regular mock tests and quizzes and get detailed analysis of your performance
</p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-delay="300" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-8.svg') }}">
                                    </div>
                                    <h3>Unlimited access</h3>
                                    <p> One subscription gets you access to all our live and recorded courses to watch from the comfort from any of your devices</p>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4 tutoring-box" data-aos="fade-up" data-aos-once="true" data-aos-delay="600" data-aos-once="true">
                                    <div class="experience-icon">
                                        <img alt="" class="img-fluid wow bounceIn" src="{{ asset('public/web/images/pic-1.png') }}">
                                    </div>
                                    <h3>Exam Notification</h3>
                                    <p>Get notified about all the latest Exam Notifications here! Stay Updated for your upcoming exam.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
	<section class="top-education py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3> Better Learning. Better Results. </h3>
                    <p>Take your Preparation to next level with Our Course subscription</p>
                </div>
            </div>
            <div class="carousel-wrap pt-4">
                <div class="owl-carousel educators">
				@if(!empty($package))
					@foreach($package as $row)
                    <div class="item">
                        <div class="card">
                            <a href="{{ URL::to('/course-detail/'.base64_encode($row->id)) }}">
							@if($row->image!="" && file_exists(public_path().'/media/package/'.$row->image))
								<img class="card-img-top" src="{{asset('/public/media/package').'/'.$row->image}}" />
							@else
								<img class="card-img-top" src="{{asset('/public/media/no-image.png')}}" />
							@endif 	
                            <div class="card-body">
                                <h5 class="card-title mb-1">{{!empty($row->name) ? $row->name : ''}}</h5>
                                <p class="mb-2 course-details">{{!empty($row->provide_by) ? $row->provide_by : ''}}</p>
                                <div class="course-price"><span class="sale-price">{{!empty($row->discount_price) ? number_format($row->discount_price,2) : '0.00'}} ₹</span> <span
                                        class="or-price">{{!empty($row->price) ? number_format($row->price,2) : '0.00'}} ₹</span> </div>
                            </div>
                        </a>
                        </div>
                    </div>
					@endforeach
				@endif	


                </div>
            </div>

        </div>
    </section>
     <section class="service-section">
        <div class="container">
            <div class="row d-flex align-items-center py-sm-3 py-md-5">
                <div class="col-md-6">
                    <div class="service-img" data-aos="fade-up" data-aos-once="true">
                        <img src="{{ asset('public/web/images/why-us.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="service-content" data-aos="fade-up" data-aos-once="true" data-aos-delay="300">
                        <h3>Why Testpaperlive ? </h3>
                        <ul>
                            <li>Make your path easier with us to achieve your goal in medical field.</li>
                            <li>Testpaperlive is only institute focussed for nursing & paramedical exams which provides you with best learning from our faculty.</li>
                            <li>We are constantly updated with latest trend pattern of medical exams all over India.</li>
                            <li>Special curriculum for effective learning, proper guidance for your higher marks at affordable fees. Personalised discussion with teachers to clear your doubts
Quality content with current affairs</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="features-section achievments-secction">
        <div class="container">
            <div class="row d-flex align-items-center py-sm-3 py-md-5">
                <div class="col-xl-6 col-lg-6 col-md-6 order-md-2">
                    <div class="features-block" data-aos="fade-up" data-aos-once="true">
                        <h3> Our Achievement </h3>
                        <p class="features-p">The Feathers in Our Cap
                            <br> ★ Branch in Rajasthan, Jaipur
                            <br> ★ 230K+ Subscribers on YouTube
                            <br> ★ 5+ Digital Studios
                            <br>
                        </p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 order-md-1">
                    <div class="achievments-block">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6">
                                <div class="download-block" data-aos="fade-up" data-aos-once="true">
                                    <h5>Downloads</h5>
                                    <p>70K<span>+</span></p>
                                </div>
                                <div class="rating-block" data-aos="fade-up" data-aos-once="true" data-aos-delay="400">
                                    <h5>App Rating</h5>
                                    <p>4.7<span>+</span></p>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 mt-5">
                                <div class="cities-block" data-aos="fade-up" data-aos-once="true" data-aos-delay="800">
                                    <h5>Cities</h5>
                                    <p>100<span>+</span></p>
                                </div>
                                <div class="times-block" data-aos="fade-up" data-aos-once="true" data-aos-delay="1000">
                                    <h5>Countries</h5>
                                    <p>5<span>+</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="call-to-action-area">
        <div class="container">
            <div class="call-to-action-inner style-05">
                <div class="row align-items-end">
                    <div class="col-lg-5 d-lg-block d-none">
                        <div class="call-action-img">
                            <img src="{{ asset('public/web/images/02.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="call-to-action-content">
                            <h3>Download India’s <br>Best Educational App</h3>
                            <p class="subtitle">Download lessons and learn anytime, anywhere with the Testpaperlive app.</p>
                            <div class="apps-download">
                               <!-- <div class="download-img">
                                    <a href=""> <img src="images/app-store-btn.png" alt=""></a>
                                </div>-->
                                <div class="download-img style-01">
                                    <a href="https://play.google.com/store/apps/details?id=com.testpaperlive"> <img src="{{ asset('web/images/play-store-btn.png') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


 @endsection
 
 @section('script')
   <script>
        $('.educators').owlCarousel({
            loop: true,
            margin: 10,
            autoplayTimeout: 4000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            items: 4.2,
            nav: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                items: 1
                },

                600: {
                items: 2
                },

                1024: {
                items: 4
                },

                1366: {
                items: 5
                }
            },
        })
    </script>

    <script>
        $('.top-learners').owlCarousel({
            loop: true,
            margin: 10,
            autoplayTimeout: 4000,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            nav: true,
            navText: [
                "<i class='fa fa-angle-left'></i>",
                "<i class='fa fa-angle-right'></i>"
            ],
            autoplay: true,
            autoplayHoverPause: true,
            responsive: {
                0: {
                items: 1
                },

                600: {
                items: 1
                },

                992: {
                items: 2
                },
                1200: {
                items: 2
                },

                1366: {
                items: 2.2
                }
            },
        })
    </script>
 @endsection