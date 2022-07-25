@extends('layouts.master')
@push("styles")
    <style>
        span.help-inline.error {
            background: #a71515 none repeat scroll 0 0;
            border: 1px solid #a71515;
            border-radius: 3px;
            color: #fff;
            display: block;
            font-size: 12px;
            margin: 5px 0 0;
            padding: 2px 8px;
            width: 100%;
            z-index: 1;
        }

        span.help-inline.error {
            position: relative;
        }

        .help-inline {
            color: red;
        }

        span.help-inline.error::before {
            border-bottom: 7px solid #a71515;
            border-left: 7px solid transparent;
            border-right: 7px solid transparent;
            content: "";
            height: 0;
            left: 5px;
            position: absolute;
            top: -7px;
            width: 0;
        }

        .has-error .form-control {
            border-color: #669543;
        }

        .has-error label,
        .has-error .help-block {
            color: #669543;
        }
    </style>
@endpush
 @section('content')

	<!-- banner section start -->
	<?php /*
	<section id="header-banner">
		<div class="container">
			<div class="header-banner-div">
				<div class="row">
					<div class="col-lg-7">
						<div class="banner-left-div">
							<figure>
								<img src="{{asset('/public/img/garrage-header-banner-img.png')}}" alt="">
							</figure>
						</div>
					</div>
					<div class="col-lg-5">
						<div class="banner-right-div">

							    @include('home.login_form')
								<!-- sign-in pop start -->
								  <div class="modal  fade sign-in-modal-box" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
									  <div class="modal-content">
										<div class="modal-header">
										  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
										</div>
										<div class="modal-body">
										 <div class="sign-in-logo">
											 <img src="{{asset('/public/img/sign-in-gaarage-logo.svg')}}" alt="">
											 <h3>Sign In</h3>
											 <div id="txtshow" class="txtshow" style="display:none;"><span style="color:blue">Thanks for contacting us we will be in touch with you shortly!! </span></div>
										 </div>

										 <div class="form-modal-div">
											<form action="create_account.php" method="post">
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<input type="text" class="form-control" id="exampleFormControlInput1"  placeholder="Full Name" required>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Phone Number" required>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Vehicle Number" required>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<input type="text" class="form-control" id="exampleFormControlInput4" placeholder="Model" required>
														</div>
													</div>
													<div class="col-sm-12">
														<div class="form-group">
															<input type="email" class="form-control" id="exampleFormControlInput5" placeholder="Email Address" required>
														</div>
													</div>

													<div class="col-12">
														<div class="form-group">
															<button type="submit" >SIGN IN</button>
														</div>
													</div>
												</div>
											</form>
										 </div>

										</div>

									  </div>
									</div>
								  </div>

								<!-- sign-in pop end -->

								<div class="form-rating-div">
									<div class="row">
										<div class="col-6">
											<div class="rating-div">
												<h6><img src="./img/rating-star.png" alt=""> 4.5/5</h6>
												<p>Based on 22000+
													<br>Reviews</p>
											</div>
										</div>
										<div class="col-6">
											<div class="review-div">
												<h6>5000+</h6>
												<p>Based on 3200+
													<br>Reviews</p>
											</div>
										</div>
									</div>
								</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section> */ ?>

    <section class="drop-off">
        <div class="container">
            <div class="drop-off-inner">
                <div class="drop-left">
                    <h4>After Hours <br>
                        <span>Drop-Off</span>
                    </h4>
                    <p>We realize that you lead a busy life, so we have made <br>
                        it easy for you to pick & drop off your vehicle just on a call</p>
                </div>
                <div class="drop-right">
                    <img src="{{asset("public/img/drop-off-new-key.svg")}}" alt="">
                    <a href="tel:+91 9549988333" class="btnmodal1" style="text-decoration: none">Get Estimate</a>


                    <!--  first modal start-->
                    <label for="target-modal" class="btnmodal1" style="display: none;">Get Estimate</label>

                    <input type="checkbox" id="target-modal">
                    <div class="modal1">
                        <div class="modal-inner1">
                            <label for="target-modal" class="close-modal"></label>
                            <div class="login-form">
                                <h5>Login</h5>
                                <form id="login_form1" method="POST" style="margin-top: 22px;">
                                    <input type="text" class="enter-mobile" id="mobile_no3" name="mobile_no" placeholder="Enter Mobile Number"  value="{{ old('mobile_no') }}" onkeypress="return isNumber(event)" required />
                                    <span class="help-inline"></span>
                                    @if ($errors->has('mobile_no'))
                                        <span class="help-block" style="text-align:left;color:red;">
                                        {{ $errors->first('mobile_no') }}
                                    </span>
                                    @endif
                                    <p class="terms">By continuing you agree to Gaarage Guru's <a href="#">Terms of Use</a> and <a href="#">Privacy Policy</a>.</p>
                                    <button class="get-otp" onclick="loginPost(); return false;">Get OTP</button>
                                    <p class="or">OR</p>
                                    <button class="signup" onclick="signupPopup();return false;">Signup</button>
                                    <p class="create-account">New to Gaarage Guru? <a href="javascript:void(0);" onclick="signupPopup();return false;">Create an account</a></p>
                                </form>
                            </div>
                        </div>
                        <label for="target-modal" class="overlay-modal login-model"></label>
                    </div>
                    <!--  first modal end-->
                </div>
            </div>
        </div>
    </section>

    <!--  Drop off  section end -->



    <!-- looking for section start -->
    <section class="looking-for p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>What are you looking for?</h2>
                <p>Below are some of our featured services</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="looking-for-main">
                <div class="row">

                    <div class="col-md-3">
                        <div class="looking-inner">
                            <a href="https://gaarageguru.pos.coverfox.com/" target="_blankxa">
                                <div><img src="{{asset("public/img/looking-1.svg")}}" alt=""></div>
                                <p>Extended <br> Warranty </p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="looking-inner">
                            <a href="javascript:void(0);" onclick="openBookingPopup();">
                                <div>
                                    <img src="{{asset("public/img/looking-2.svg")}}" alt="">
                                </div>
                                <p>Claim <br> Assistance</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="looking-inner">
                            <a href="javascript:void(0);" onclick="openBookingPopup();">
                                <img src="{{asset("public/img/looking-3.svg")}}" alt="">
                                <p>Car <br> Repairing</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="looking-inner">
                            <a href="javascript:void(0);" onclick="openBookingPopup();">
                                <div><img src="{{asset("public/img/looking-4.svg")}}" alt=""></div>
                                <p>Car <br> Servicing</p>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
            <div class="all-btn-sec">
                 <a href="{{route('service')}}">Know More</a>


                <!--  second modal start-->
                <label for="target-modal2" class="btnmodal2" style="display:none;">OTP Popup</label>

                <input type="checkbox" id="target-modal2">
                <div class="modal2">
                    <div class="modal-inner2">
                        <label for="target-modal2" class="close-modal"></label>
                        <div class="login-form2">
                            <h5>Verification</h5>
                            <p class="login2-para-top">Enter 6 digit one time password sent to
                                your mobile no.</p>
                            <form id="otp_verify_form" class="garrage-main-form" method="POST" action="">
                                <input type="hidden" name="mobile" id="mobile_number_otp" value="" />
                                <input type="hidden" name="user_id" id="user_id" value="" />
<!--                                <div class="all-otp-inputs">
                                    <input class="otp-inputs" type="number">
                                    <input class="otp-inputs" type="number">
                                    <input class="otp-inputs" type="number">
                                    <input class="otp-inputs" type="number">
                                    <input class="otp-inputs" type="number">
                                    <input class="otp-inputs last-otp" type="number">
                                </div>-->
                                <input type="text" class="form-control mob-no" id="otp" name="otp" placeholder="Enter Otp"  value="{{ old('otp') }}" onkeypress="return isNumber(event)"/>
                                <span class="help-inline"></span>
                                @if ($errors->has('otp'))
                                    <span class="help-block" style="text-align:left;color:red;">
															{{ $errors->first('otp') }}
														</span>
                                @endif
                                <button class="submit-btn" onclick="otpVerify();return false;">Submit</button>
                                <div id="countdown"></div>
                                <p class="not-send-otp">Didn't receive OTP? <a href="javascript:void(0);" id='resend_otp' onclick='resendOtp();'> Resend</a></p>
                            </form>
                        </div>
                    </div>
                    <label for="target-modal2" class="overlay-modal"></label>
                </div>
                <!-- second modal end -->


            </div>
        </div>
    </section>
    <!-- looking for section end -->

    <!-- what we do section start -->
    <section class="what-we-do pa-20">
        <div class="container">
            <div class="all-sec-heading">
                <h2>What We Do</h2>
                <p>We offer full service auto repair & maintenance</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="what-we-do-main">
                <div class="row">

                    <div class="col-md-4">
                        <div class="what-we-do-inner what-content-1">
                            <h5>Preventive <br> Maintenance</h5>
                            <p>The best way to minimize breakdowns
                                is doing routine maintenance</p>
                            <h3>Mainten</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="what-we-do-inner what-img-1">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="what-we-do-inner what-content-2">
                            <h5>Most Common <br>
                                Repairs</h5>
                            <p>We have over 30 common <br>
                                car repairs and the list is growing</p>
                            <h3>Commo</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="what-we-do-inner what-img-2">

                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="what-we-do-inner what-content-3">
                            <h5>Break <br>
                                Repair & Service</h5>
                            <p>Break maintenance is important
                                in helping ensure the safety of
                                you and your passengers</p>
                            <h3>Break</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="what-we-do-inner what-img-3">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- what we do section end -->

    <!-- benefits section start  -->
    <section class="benefits p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Gaarage Guru benefits</h2>
                <p>100% result oriented work</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="benefits-main">
                <div class="row">

                    <div class="col-md-4">
                        <div class="benefits-inner">
                            <div><img src="{{asset("public/img/benefit-1.svg")}}" alt=""></div>
                            <h4>All Car Makes</h4>
                            <p>We provide a variety of repair and <br> maintenance services for all car <br> makes and  models, even for exotic <br>and vintage ones</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="benefits-inner">
                            <div><img src="{{asset("public/img/benefit-2.svg")}}" alt=""></div>
                            <h4>Variety Services</h4>
                            <p>The main principle of our work is to<br> offer a wide range of quality car repair <br> services and we’ve been doing it <br>
                                since our first day</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="benefits-inner">
                            <div>  <img src="{{asset("public/img/benefit-3.svg")}}" alt=""></div>
                            <h4>Quality Support</h4>
                            <p>Car Repair Services offers quality <br> support programs for any vehicles <br> that allow them to always stay <br>
                                fully functional</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="benefits-inner benefits-b-row">
                            <div><img src="{{asset("public/img/benefit-4.svg")}}" alt=""></div>
                            <h4>Make Booking Easy</h4>
                            <p>Get a quote and book a service online <br> 24/7. Our mechanics will come to <br>
                                your home or office, even on evenings <br> and weekends</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="benefits-inner benefits-b-row">
                            <div><img src="{{asset("public/img/benefit-5.svg")}}" alt=""></div>
                            <h4>Service Records</h4>
                            <p>Once your service is been done you <br> can check your car service records <br> whenever and wherever you need just <br> on a click 24/7</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="benefits-inner benefits-b-row">
                            <div> <img src="{{asset("public/img/benefit-6.svg")}}" alt=""></div>
                            <h4>Fair Pricing Parts </h4>
                            <p>We offer fair and transparent pricing <br> and provide estimates upfront for <br> hundreds of services on thousands <br>
                                of cars. Book with confidence</p>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>

    <!-- benefits section end  -->


    <!-- promises section start  -->
    <section class="promises">
        <div class="container">
            <div class="promises-main">
                <p>WE <span>GAARAGE GURU</span> <br>
                    PROMISES TO EXCHANGE <br>
                    JOY WITH BEST OF THE <br>
                    SERVICE TO ENSURE TRUST <br>
                    WITH YOUR DESIRED <br>
                    ACCESSORIES </p>
            </div>
        </div>
        <img class="promise-car" src="{{asset("public/img/red-car.png")}}" alt="red car img">
    </section>
    <!-- promises section end  -->

    <!-- how it works  section start -->
    <section class="how-it-works p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>How It Works</h2>
                <p>These few steps will help return your car to a working condition</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="how-it-works-main">
                <div class="row">

                    <div class="col-md-3">
                        <div class="how-it-works-inner">
                            <img src="{{asset("public/img/works-1.png")}}" alt="">
                            <p>Choose Your <br>
                                Service</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="how-it-works-inner">
                            <img src="{{asset("public/img/works-2.png")}}" alt="">
                            <p>Make an <br> Appointment</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="how-it-works-inner">
                            <img src="{{asset("public/img/works-3.png")}}" alt="">
                            <p>Pick Your <br> Car for repair</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="how-it-works-inner">
                            <img src="{{asset("public/img/works-4.png")}}" alt="">
                            <p>Drop It <br> At Your Place</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- how it works section end -->


    <!-- quality service section start -->
    <section class="quality-services pa-20">
        <div class="experience">
            <div class="container">
                <div class="experience-inner">
                    <div class="ex-inner-1">
                        <h3>2</h3>
                        <p>Years <br> of experience</p>
                    </div>
                    <div class="ex-inner-1">
                        <h3>200</h3>
                        <p>Vehicles <br> Repaired</p>
                    </div>
                    <div class="ex-inner-1">
                        <h3>27</h3>
                        <p>Technicians <br> & Workers</p>
                    </div>
                    <div class="ex-inner-1">
                        <h3>100%</h3>
                        <p>Satisfied <br> Customers</p>
                    </div>
                </div>
            </div>
        </div>
        <img class="service-big-img" src="{{asset("public/img/service-big-img.png")}}" alt="">
        <div class="quality-service-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-7">
                        <div class="quality-inner">
                            <h2>Quality Service and <br> Customer <br> Satisfaction</h2>
                            <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
                            <p>We use the latest diagnostic equipment to
                                guarantee your vehicle is repaired or serviced
                                properly and in a timely fashion. We are a
                                member of Professional Auto Service, an elite
                                performance network, where independent
                                service facilities share common goals of being
                                world-class automotive service centers.</p>
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i> Spare Parts Warranty Available </li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>  Courtesy Local Shuttle Service</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> Customer Rewards Program</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i>  Certified & Trained Technicians</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> 24-Hour Roadside Assistance</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> Easy Cash Claim Process</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> Best of the Infrastructure</li>
                                <li><i class="fa fa-check" aria-hidden="true"></i> Extended Warranty</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- quality service section end -->

    <!-- Certified service section start -->
    <section class="certified-service p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Why Choose Certified Service?</h2>
                <p>We partnered with best garages to bring <br>
                    you the most sophisticated fair-price estimates</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="certified-service-main">
                <div class="row">

                    <div class="col-md-4">
                        <div class="certified-service-inner">
                            <div><img src="{{asset("public/img/certified-img1.svg")}}" alt=""></div>
                            <h6>Estimates</h6>
                            <p>We bring you the most <br>
                                accurate and fair-price <br>
                                service estimates</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="certified-service-inner">
                            <div> <img src="{{asset("public/img/certified-img2.svg")}}" alt=""></div>
                            <h6>Trusted</h6>
                            <p>Trusted Service <br>
                                Centers are certified for <br>
                                high quality</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="certified-service-inner">
                            <div><img src="{{asset("public/img/certified-img3.svg")}}" alt=""></div>
                            <h6>Warantees</h6>
                            <p>Covers parts and labor <br>
                                on qualifying repairs <br>
                                and services</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Certified service section end -->


    <!-- Extended warranty section start -->
    <section class="warranty">
        <div class="warranty-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="warranty-inner">
                            <h2>Extended Warranty and <br>
                                Claim Assistance</h2>
                            <p>For more information, feel free to call at <br>
                                <span>+91-954-9988-333</span> and our Customer <br>
                                Care executive will get back to you to solve <br>
                                your issues within 2 hrs.</p>
                            <div class="all-btn-sec">
                                <a href="javascript:void(0);" onclick="openBookingPopup();">Book Now</a>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
            <img class="warranty-man" src="{{asset("public/img/man.png")}}" alt="">
            <img class="warranty-car" src="{{asset("public/img/white-car.png")}}" alt="">
        </div>
        <div class="warranty-bottom">
            <div class="container">
                <div class="warranty-bottom-inner">
                    <img src="{{asset("public/img/24hour-breakdown.svg")}}" alt="">
                    <div>
                        <h5>24 Hour Breakdown Service</h5>
                        <p>To order a Breakdown Recovery Service now or if you require
                            a quote, please contact at - <a href="tel:+91-954-9988-333">+91-954-9988-333</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Extended warranty section end -->

    <!-- Experts gurus section start -->
    <section class="we-repair-all p_70" id="experts">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Gaarage Guru Experts <br> Near by you </h2>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="partners-main">
                <div class="owl-carousel owl-theme expertsGuru" id="expertsGuru">
                    <div class="item">
                        <div class="experts-inner-guru">
                            <div class="top-img-experts">
                                <img src="{{asset("public/img/experts-img1.png")}}" alt="">
                            </div>
                            <div class="bottom-content-div">
                                <h4>car care centre</h4>
                                <p><span>Patrakaar Colony, Mansarovar</span></p>
                                <p class="service-price">
                                    Our service price <br> starts from
                                </p>
                                <div class="service-book">
                                    <div class="s-book-left">
                                        <h4>Rs.299.00</h4>
                                        <p>Onwards</p>
                                    </div>
                                    <div class="s-book-right">
                                        <a href="javascript:void(0);" onclick="openBookingPopup();">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="experts-inner-guru">
                            <div class="top-img-experts">
                                <img src="{{asset("public/img/experts-img2.png")}}" alt="">
                            </div>
                            <div class="bottom-content-div">
                                <h4>Vaishali Motors</h4>
                                <p><span>Near Amprapali Circle, Vaishali </span></p>
                                <p class="service-price">
                                    Our service price <br> starts from
                                </p>
                                <div class="service-book">
                                    <div class="s-book-left">
                                        <h4>Rs.499.00</h4>
                                        <p>Onwards</p>
                                    </div>
                                    <div class="s-book-right">
                                        <a href="javascript:void(0);" onclick="openBookingPopup();">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <div class="experts-inner-guru">
                            <div class="top-img-experts">
                                <img src="{{asset("public/img/experts-img3.png")}}" alt="">
                            </div>
                            <div class="bottom-content-div">
                                <h4>Automart Garage</h4>
                                <p><span>Riddhi-Siddhi Churaha, Tiveni Nagar</span></p>
                                <p class="service-price">
                                    Our service price <br> starts from
                                </p>
                                <div class="service-book">
                                    <div class="s-book-left">
                                        <h4>Rs.399.00</h4>
                                        <p>Onwards</p>
                                    </div>
                                    <div class="s-book-right">
                                        <a href="javascript:void(0);" onclick="openBookingPopup();">Book Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Experts gurus section end -->



    <!-- appointment today section start -->
    <section class="vehicle-damage p_70 home-vehicle">
        <div class="container">
            <div class="all-sec-heading schedule-bg">
                <h2>Schedule <span>Your Appointment</span> Today </h2>
                <p>Your Automotive Repair & Maintenance Service Specialist</p>
                <h5>+91 95499 88333</h5>
                <div class="all-btn-sec">
                     <a href="tel:+91 95499 88333">Appointment</a>


                    <!--  third modal start-->
                    <label for="target-modal3" class="btnmodal3" style="display: none;">Appointment</label>

                    <input type="checkbox" id="target-modal3">
                    <div class="modal3">
                        <div class="modal-inner3">
                            <label for="target-modal3" class="close-modal"></label>
                            <div class="login-form3">
                                <div class="signup-pop-img">
                                    <img src="{{asset("public/img/singup-pop-img.svg")}}" alt="">
                                </div>
                                <p class="signup-para-top">Please sign up to understand your <br>
                                    needs and serve you better</p>
                                <form id="siginin-form" method="post" action="" enctype="multipart/form-data">
                                    <div class="signup-form-inner">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text" name="name"  id="name" class="form-control"  placeholder="Full Name" required>
                                                <span class="help-inline"></span>
                                                @if ($errors->has('name'))
                                                    <span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number" name="mobile_no"  id="mobile_no" class="form-control"  placeholder="Mobile Number" required>
                                                <span class="help-inline"></span>
                                                @if ($errors->has('mobile_no'))
                                                    <span class="help-block"><strong>{{ $errors->first('mobile_no') }}</strong></span>
                                                @endif
                                            </div>
<!--                                            <div class="col-md-12">
                                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Email Address">
                                            </div>-->
                                        </div>
                                    </div>
                                    <button class="sign-btn" onclick="updateAccount(); return false;">Sign Up</button>
                                </form>
                            </div>
                        </div>
                        <label for="target-modal3" class="overlay-modal sign-up-modal"></label>
                    </div>
                    <!-- third modal end -->

                </div>
            </div>
            <div class="vehicle-damage-main">
                <div class="vehicle-damage-img">
                    <img src="{{asset("public/img/home-appointment.png")}}" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- appointment today section end -->

    <!-- We repair all section start -->
    <section class="we-repair-all p_70">
        <div class="container">
            <div class="all-sec-heading">
                <h2>We Repair All Makes of Automobiles</h2>
                <p>We work with all makes and models of vehicles</p>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="partners-main">
                <div class="owl-carousel owl-theme" id="weRepair">
                    <div class="item"><img src="{{asset("public/img/repair101.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/repair102.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/repair103.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/repair5.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/repair104.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/repair105.png")}}" alt=""></div>
                </div>
            </div>
        </div>
    </section>
    <!-- We repair allsection end -->






    <!-- FAQ section start -->
    <section class="faq pb_70 mt-5">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Frequently Asked Questions</h2>
                <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
            </div>
            <div class="faq-main">

                <div class="faq-1">
                    <button class="accordion">Why to use Original Spare Parts in your vehicles?</button>
                    <div class="panel">
                        <p><strong>Assurance of quality:</strong> When you choose an original spare part, it should fit and function exactly as the part it is replacing. It is the same part as what was originally installed during the manufacturing process, which can provide you with peace of mind knowing how it will perform and its quality. <br> <br>
                            <strong>Price vs. Durability:</strong> The price of original spare parts is nearly always higher than the price of comparable aftermarket parts but when compared with durability it justifies the cost in long term.  <br> <br>
                            <strong></strong> The Gaarageguru is a one stop solution which will provide the original spare parts according to vehicle along with best in class services that will not only enhance the longitivity of vehicle but also enhance the performance.
                        </p>
                    </div>
                </div>

                <div class="faq-1">
                    <button class="accordion">When spare parts are required? </button>
                    <div class="panel">
                        <p>A spare part or service part is an interchangeable part that is kept in an inventory and used for the repair or replacement of failed units.

                            <br><br>
                            If a vehicle is damaged in a crash or is aging and has experienced normal wear and tear due to driving, it might need some of its parts replaced. The repair shop you take the vehicle to, can typically get the parts needed, but the type of parts you get will depend on several factors.  <br><br>
                            The three types of parts for automotive repairs are Original spare parts, Local spare parts and Recycled spare parts (used parts).

                        </p>
                    </div>
                </div>

                <div class="faq-1">
                    <button class="accordion">What is Motor Insurance?</button>
                    <div class="panel">
                        <p>Motor insurance is insurance for cars, trucks, motorcycles, and other road vehicles. Its primary use is to provide financial protection against physical damage or bodily injury resulting from traffic collisions and against liability that could also arise from incidents in a vehicle.
                            <br><br>
                            <strong>Terms related with Insurance:</strong><br> <br>
                            <strong>Policyholder and Insured:</strong> A person or entity who buys insurance is known as a policyholder, while a person or entity covered under the policy is called an insured.
                            <br> <br>
                            <strong>Insurance Policy:</strong> The insured receives a contract, called the insurance policy, which details the conditions and circumstances under which the insurer will compensate the insured, or their designated beneficiary or assignee.
                            <br> <br>
                            <strong>Premium:</strong> The amount of money charged by the insurer to the policyholder for the coverage set forth in the insurance policy is called the premium.

                            <strong>Insurance Transaction:</strong> The insurer promises the insured to compensate in the event of a covered loss. The loss may or may not be financial, but it must be reducible to financial terms, and usually involves something in which the insured has an insurable interest established by ownership, possession, or pre-existing relationship.


                        </p>
                    </div>
                </div>
                <div class="faq-1">
                    <button class="accordion">What is the general claim process? </button>
                    <div class="panel">
                        <p>While all claims are processed and executed at the insurer’s end, the Gaarageguru provide assistance and prepare the insured for the claim process thus to make the experience hassle-free. <br> <br>
                            The details shared here may not be exhaustive and may vary from insurer to insurer but are generally followed. According to the studies, a vehicle collides every minute on the Indian roads. So, if you become an unfortunate victim of the same, here is a list of steps you should follow : <br> <br>

                            <strong>1. Arrange the documents</strong> <br>
                            To claim your insurance amount in case of an accident you need to sort out your policy documents. <br>
                            Click pictures of damage to the vehicle so that you can submit it as a proof to your insurance company. <br> <br>

                            <strong>2. Get in touch</strong> <br>
                            Communicate with the insurer by sending an email or over a call. <br>
                            Relevant documents like Policy, Claim Form and proof of damage will have to be submitted to the insurance company <br> <br>

                            <strong>3. Ask for assistance.</strong> <br>
                            If you are claiming for the first time then it is advisable that you ask for assistance from the customer care executives of the insurance company. <br> <br>

                            <strong>4. Verification by the Insurance Company</strong> <br>
                            Once you have submitted all the documents, an insurance company executive will visit to validate all the information provided by you and take the process ahead. <br> <br>




                        </p>
                    </div>
                </div>
                <div class="faq-1">
                    <button class="accordion">What is a warranty?</button>
                    <div class="panel">
                        <p>Every car today rolls out from the showroom with a standard feature – a warranty. <br>
                            In simple terms, a warranty is a written assurance, which states that the manufacturer will replace or repair any faulty part if it fails within a specific time period, with some limitations.
                        </p>
                    </div>
                </div>
                <div class="faq-1">
                    <button class="accordion">What is additional or extended warranty?</button>
                    <div class="panel">
                        <p>	What you do once warranty expires? This is where the extended warranty comes in. It is an additional warranty that you can buy at the time of purchasing the new car, or in some cases, before the standard warranty expires. Like with standard warranty, this warrants to replace or repair specific parts if they malfunction. As, it extends the warranty period of consumer durable goods beyond what is offered by the manufacturer. </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- FAQ section end -->

    <!-- our partners start -->
    <section class="partners pb_70 mt-5">
        <div class="container">
            <div class="all-sec-heading">
                <h2>Our Channel Partners</h2>
            </div>
            <div class="partners-main">
                <div class="owl-carousel owl-theme" id="partnersNew">
                    <div class="item"><img src="{{asset("public/img/partner1.jpeg")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/partner2.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/partner3.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/partner4.png")}}" alt=""></div>
                    <div class="item"><img src="{{asset("public/img/partner3.png")}}" alt=""></div>
                </div>
            </div>
        </div>
    </section>
    <!-- our partners end -->

    <!-- footer start -->
 @endsection
@push("scripts")
    <script>
        $('.expertsGuru').owlCarousel({
            loop:true,
            autoplay:true,
            margin:40,
            nav:true,
            dots:false,
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
        })</script>

    <script>
        $('#weRepair').owlCarousel({
            loop:true,
            autoplay:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })</script>


    <script>
        $('#partnersNew').owlCarousel({
            loop:true,
            autoplay:true,
            margin:10,
            nav:true,
            dots:false,
            responsive:{
                0:{
                    items:2
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        })</script>
    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>
    @if(empty(Auth::user()))
    <script type="text/javascript">
        $(window).on('load', function() {
            $('.btnmodal1').trigger('click');
        });
        function signupPopup(){
            $('.login-model').trigger("click");
            //$('.modal-backdrop').remove();
            $('.btnmodal3').trigger('click');
        }
    </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function (){

        });
        function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function countdown(){
            var timeleft = 45;
            var downloadTimer = setInterval(function(){
                if(timeleft <= 0){
                    clearInterval(downloadTimer);
                    document.getElementById("countdown").innerHTML = "<a href='javascript:;' id='resend_otp' onclick='resendOtp();'>Resend Otp</a>";
                } else {
                    document.getElementById("countdown").innerHTML = timeleft + "seconds remaining";
                }
                timeleft -= 1;
            }, 1000);
        }
        function resendOtp(){
            //$.LoadingOverlay("show");
            $('.help-inline').html('');
            $('.help-inline').removeClass('error');
            var mobile = $("#mobile_number_otp").val();
            $.ajax({
                type: "get",
                async: false,
                url: site_url+"/resend-otp",
                dataType: 'json',
                contentType: 'application/json; charset=utf-8',
                data: { mobile: mobile },
                success: function(r){
                    error_array 	= 	JSON.stringify(r);
                    data			=	JSON.parse(error_array);
                    console.log(data);
                    if(data['success'] == 1) {

                        //$.LoadingOverlay("hide");
                        //showMessage(data['message'],"success");
                        $('.help-inline').html(data['message']);
                        $("#resend_otp").hide(); }
                    else {
                        //$.LoadingOverlay("hide");
                    }

                }

            });

        }
        function loginPost() {
            //$.LoadingOverlay("show");
            $('.help-inline').html('');
            $('.help-inline').removeClass('error');
            $.ajax({
                url: '{{ URL("login-post") }}',
                type:'post',
                data: $('#login_form1').serialize(),
                success: function(r){
                    error_array 	= 	JSON.stringify(r);
                    data			=	JSON.parse(error_array);
                    if(data['success'] == 1) {

                        //$.LoadingOverlay("hide");
                        countdown();
                        $('.btnmodal2').trigger('click');

                        $('.login-model').trigger('click');
                        //$("#show_mobile").html("");
                        // $("#show_mobile").html(data['mobile']);
                        $("#mobile_number_otp").val("");
                        $("#mobile_number_otp").val(data['mobile']);
                        $("#user_id").val("");
                        $("#user_id").val(data['user_id']);
                    }else if(data['success'] == 2) {
                        //toastr.error(data['message']);
                        $('.help-inline').html(data['message']);
                        //$.LoadingOverlay("hide");
                    }else {
                        $.each(data['errors'],function(index,html){
                            $("input[id = "+index+"3]").next().addClass('error');
                            $("input[id = "+index+"3]").next().html(html);

                        });
                       // $.LoadingOverlay("hide");
                    }
                    //$.LoadingOverlay("hide");
                }
            });
        }

        $('#login_form1').each(function() {
            $(this).find('input').keypress(function(e) {
                if(e.which == 10 || e.which == 13) {
                    loginPost();
                    return false;
                }
            });
        });


        function otpVerify() {
            //$.LoadingOverlay("show");
            $('.help-inline').html('');
            $('.help-inline').removeClass('error');
            $.ajax({
                url: '{{ URL("otpverify-post") }}',
                type:'post',
                data: $('#otp_verify_form').serialize(),
                success: function(r){
                    error_array 	= 	JSON.stringify(r);
                    data			=	JSON.parse(error_array);
                    console.log(data);
                    if(data['success'] == 2) {
                        //$.LoadingOverlay("hide");
                        //showMessage(data['message'],"error");
                        $('.help-inline').html(data['message']);
                    }else if(data['success'] == 1) {
                        //location.reload();


                        window.location.href = '{{ URL("/") }}';
                        //document.getElementById("update-card").reset();
                        showMessage(data['message'],"success");
                    }
                    else {
                        $.each(data['errors'],function(index,html){
                            $("input[id = "+index+"]").next().addClass('error');
                            $("input[id = "+index+"]").next().html(html);
                           // $.LoadingOverlay("hide");
                        });
                    }
                }
            });
        }

        $('#otp_verify_form').each(function() {
            $(this).find('input').keypress(function(e) {
                if(e.which == 10 || e.which == 13) {
                    otpVerify();
                    return false;
                }
            });
        });
        function updateAccount(){

            //if ($('#siginin-form').valid()) {

           //$.LoadingOverlay("show");
            var formData  = $('#siginin-form')[0];
            $('.help-inline').html('');
            $('.help-inline').removeClass('error');
            //var checklogin1 = checklogin();
            //if(checklogin1  == true){
            $.ajax({
                //url: '{{ URL::to('/signup-post') }}',
                url: '{{ URL("signup-post") }}',
                type:'post',
                data: $('#siginin-form').serialize(),
                ////data: new FormData(formData), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                //contentType: false,       // The content type used when sending data to the server.
                //cache: false,             // To unable request pages to be cached
                //processData:false,
                success: function(r){
                    error_array 	= 	JSON.stringify(r);
                    data			=	JSON.parse(error_array);
                    console.log(data);
                    if(data['success'] == 1) {
                        //$.LoadingOverlay("hide");
                        //showMessage(data['message'],"success");
                        $('.sign-up-modal').trigger('click');
                        $('.btnmodal1').trigger('click');
                    }else if(data['success'] == 2) {
                        //$.LoadingOverlay("hide");
                        document.getElementById("update-card").reset();
                        showMessage(data['message'],"error");
                    }
                    else {
                        //$.LoadingOverlay("hide");
                        $.each(data['errors'],function(index,html){
                            $("input[id = "+index+"]").next().addClass('error');
                            $("input[id = "+index+"]").next().html(html);
                            $("select[id = "+index+"]").next().addClass('error');
                            $("select[id = "+index+"]").next().html(html);

                        });
                    }


                },
                error: function(data, errorThrown)
                {
                   // $.LoadingOverlay("hide");
                    var errors = data.responseJSON;
                    //console.log(errors['errors']);
                    $('.invalid-feedback').css('display','block');
                    $.each(errors['errors'],function(index,html){
                        $("input[id = "+index+"1]").next().addClass('error');
                        $("input[id = "+index+"1]").next().html(html);
                        $("select[id = "+index+"1]").next().addClass('error');
                        $("select[id = "+index+"1]").next().html(html);

                    });
                }
            });
            /*}else{
                    window.location.href	 =	"{{ URL('/') }}";
			$.LoadingOverlay("hide");
	}
}else{
	$.LoadingOverlay("hide");
     return false;
}*/

        }

    </script>
@endpush
