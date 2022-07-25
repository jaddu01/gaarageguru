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

<?php
	$curntroute = Request::path();
	if($curntroute == 'service'){
	    $class = "header-banner-section-service";
	}elseif($curntroute == 'contact-us'){
	    $class = "header-banner-section-contactus";
	}elseif($curntroute == 'about-us'){
	    $class = "header-banner-section-aboutus";
	}else{
	    $class = "header-banner-section-home";
	}
?>


<section class="header-banner-section <?php echo $class;?>">
	<header>
		<div class="container">
			<nav class="navbar navbar-expand-lg navbar-light">
				<div class="container-fluid">
					<?php  if(empty(Auth::user())){ ?>
						<a class="navbar-brand" href="{{ URL::to('/') }}">
					<?php }else{ ?>
					 	<a class="navbar-brand" href="{{ URL::to('/dashboard') }}">
					<?php } ?>
					    <img class="white-logo" src="{{asset('/public/img/new-clear-wt-bg-logo.svg')}}" alt="">
					    <img class="logo-blue" src="{{asset('/public/img/logo-blue.png')}}" alt=""> Gaarage Guru
					</a>

					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span>
					</button>
					<div class="location-option">
						<form action="" class="location-form">
							<select id="location">
                                <option value="jaipur">Jaipur</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="pune">Pune</option>
                                <option value="hyderabad">Hyderabad</option>
							</select>
						</form>
					</div>
					<div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
						<ul class="navbar-nav mb-2 mb-lg-0">
							<li class="nav-item"> <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page" href="{{ URL::to('/') }}">Home</a>
							</li>
							<li class="nav-item"> <a class="nav-link {{ Request::is('about-us*') ? 'active' : '' }}" href="{{ URL::to('/about-us') }}">About Us</a>
							</li>
							<li class="nav-item"> <a class="nav-link {{ Request::is('service*') ? 'active' : '' }}" href="{{ URL::to('/service') }}">Services</a>
							</li>
							<li class="nav-item"> <a class="nav-link {{ Request::is('contact-us*') ? 'active' : '' }}" href="{{ URL::to('/contact-us') }}">Contact</a>
							</li>
							<?php if(!empty(Auth::user())){ ?>
							<li class="nav-item"> <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ URL::to('/dashboard') }}">Dashboard</a>
							</li>
							<?php } ?>
						</ul>
					</div>
<!--					<div class="emergency-red-btn">
						<a href="tel:95499 88333">	<button type="button" class="signin"><img src="{{asset('/public/img/help-img.svg')}}" alt=""></button></a>

						<?php if(empty(Auth::user())){ ?>
						<button type="button" id="openPopup" style="display:none;" data-bs-toggle="modal" data-bs-target="#exampleModal2">Popup</button>
						<?php }else{ ?>
						    <button type="button" id="openPopup" style="display:none;">Popup</button>
						<?php } ?>
					</div>-->
                        <button id="myBtn"><a href="tel:95499 88333"><img src="{{asset('/public/img/help-img.svg')}}" alt=""></a></button>


					<div class="modal  fade sign-in-modal-box" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
						  <div class="modal-content">
							<div class="modal-header">

							</div>
							<div class="modal-body">
							 <div class="sign-in-logo">
								 <img src="{{asset('/public/img/mechanic-new-white-svg.svg')}}" alt="">
								 <p>Please enter your mobile <br>
									number To continue or sign in</p>
							 </div>
							 <div class="form-modal-div" id="login_div">
								<form id="login_form1" method="POST" action="">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<input type="text" class="form-control mob-no" id="mobile_no3" name="mobile_no" placeholder="Mobile No"  value="{{ old('mobile_no') }}" onkeypress="return isNumber(event)" required />
												<span class="help-inline"></span>
												@if ($errors->has('mobile_no'))
												<span class="help-block" style="text-align:left;color:red;">
													{{ $errors->first('mobile_no') }}
												</span>
												@endif
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<button class="log-in-btn" onclick="loginPost();return false;">LOGIN</button>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<button class="sign-in-btn" onclick="signupPopup();return false;">SIGNUP</button>
												<button type="button" id="openPopup1" style="display:none;" data-bs-toggle="modal" data-bs-target="#exampleModal">Popup</button>
											</div>
										</div>
									</div>
								</form>
							 </div>
							 <div class="form-modal-div" id="otp_div" style="display:none">
								<form id="otp_verify_form" class="garrage-main-form" method="POST" action="">
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<input type="hidden" name="mobile" id="mobile_number_otp" value="" />
												<input type="hidden" name="user_id" id="user_id" value="" />
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group">
												<div class="loginpading {{ $errors->has('otp') ? ' has-error' : '' }}" style="padding-bottom:10px;">
													<input type="text" class="form-control mob-no" id="otp" name="otp" placeholder="Enter Otp"  value="{{ old('otp') }}" onkeypress="return isNumber(event)"/>
														<span class="help-inline"></span>
													@if ($errors->has('otp'))
														<span class="help-block" style="text-align:left;color:red;">
															{{ $errors->first('otp') }}
														</span>
													@endif
												</div>
											</div>
										</div>

										<div class="col-12">
											<div class="form-group">
												<button class="log-in-btn" onclick="otpVerify();return false;">Submit</button>
											</div>
										</div>
									</div>
								</form>
								<div class="modal-footer">
									<div id="countdown"></div>
							  </div>
							 </div>
							</div>

						  </div>
						</div>
					</div>
					</div>
				</nav>
			</div>
		</header>
	<?php   if($curntroute == 'about-us'){ ?>
	   <div class="container container-banner">
		<div class="header-banner-content-new">
			<div class="headerinner-content-new">
				<h1>End to end solution provider
					for all vehicles</h1>
					<p>Gaarage Guru is technology based platform providing vehicle repair,
						service, Insurance claim assistance & breakdown.</p>
					<div>
						<!--<a href="#">Learn More</a>-->
							<img src="{{asset('/public/img/mechanic-new-blue-svg.svg')}}" alt="">
					</div>
			</div>
		</div>

	</div>
	<?php }else if($curntroute == 'contact-us'){ ?>
	<div class="container container-banner">
		<div class="header-banner-content-new">
			<div class="headerinner-content-new">
				<h1>We Go Beyond To Make all
					The Process Hassle Free</h1>
					<p>We pride ourselves on our courtesy and our professionalism. <br> With each Insurance Claim, our goal is to  truly make the process easier for our customers...Right from the very beginning.</p>
					<div>
						<!--<a href="#">Learn More</a>-->
						<img src="{{asset('/public/img/mechanic-new-blue-svg.svg')}}" alt="">
					</div>
			</div>
		</div>

	</div>
	<?php }else if($curntroute == 'service'){ ?>
	<div class="container container-banner">
			<div class="header-banner-content-new">
				<div class="headerinner-content-new">
					<h1>Your car has never <br>
						looked so nice before</h1>
						<p>We exist to help you transform your lovable <br>
							car into a comfortable riding experience of a lifetime.</p>
						<div>
							<!--<a href="#">Learn More</a>-->
							<img src="{{asset('/public/img/mechanic-new-blue-svg.svg')}}" alt="">
						</div>
				</div>
			</div>

		</div>

	<?php } ?>
	</section>





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
			 <h3>SIGN UP</h3>
		 </div>
		 <div class="form-modal-div">
			<form id="siginin-form" method="post" action="" enctype="multipart/form-data">

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('full_name')?'has-error':''); ?>">
							<input type="text" name="name"  id="name" class="form-control"  placeholder="Full Name" required>
							<span class="help-inline"></span>
							@if ($errors->has('name'))
									<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('mobile_no')?'has-error':''); ?>">
							<input type="text" name="mobile_no"  id="mobile_no" class="form-control"  placeholder="Mobile Number" required>
							<span class="help-inline"></span>
							@if ($errors->has('mobile_no'))
									<span class="help-block"><strong>{{ $errors->first('mobile_no') }}</strong></span>
							@endif
						</div>
					</div>
					<!--<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('vehical_number')?'has-error':''); ?>">
							<input type="text" name="vehical_number"  id="vehical_number" class="form-control"  placeholder="Vehicle Number" required>
							<span class="help-inline"></span>
							@if ($errors->has('vehical_number'))
									<span class="help-block"><strong>{{ $errors->first('vehical_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('model_number')?'has-error':''); ?>">
							<input type="text" class="form-control" name="model_number"  id="model_number" placeholder="Model" required>
							<span class="help-inline"></span>
							@if ($errors->has('model_number'))
									<span class="help-block"><strong>{{ $errors->first('model_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group <?php echo ($errors->first('email')?'has-error':''); ?>">
							<input type="email" class="form-control" name="email"  id="email"  placeholder="Email Address" >
							<span class="help-inline"></span>
							@if ($errors->has('email'))
									<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
							@endif
						</div>
					</div>-->
				<!---	<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('password')?'has-error':''); ?>">
							<input type="text" class="form-control" name="password"  id="password" placeholder="Password" required>
							<span class="help-inline"></span>
							@if ($errors->has('password'))
									<span class="help-block"><strong>{{ $errors->first('password') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('confirm_password')?'has-error':''); ?>">
							<input type="text" class="form-control" name="confirm_password"  id="confirm_password" placeholder="Confirm Password" required>
							<span class="help-inline"></span>
							@if ($errors->has('confirm_password'))
									<span class="help-block"><strong>{{ $errors->first('confirm_password') }}</strong></span>
							@endif
						</div>
					</div>-->

					<div class="col-12">
						<div class="form-group">

							 <button  type="button"  onclick="updateAccount();">SIGN UP</button>
						</div>
					</div>
				</div>
			</form>
		 </div>
		</div>

	  </div>
	</div>
  </div>



<?php use App\Http\Controllers\homeController;  ?>
  <!-- enquire pop start -->
<div class="modal  fade sign-in-modal-box" id="enquireModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
	  <div class="modal-content">
		<div class="modal-header">
		  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
		 <div class="sign-in-logo">
			<img src="{{asset('/public/img/sign-in-gaarage-logo.svg')}}" alt="">
			 <h3>Booking</h3>
		 </div>
		 <div class="form-modal-div">
			<form id="booking_form" method="post" action="" enctype="multipart/form-data">

				<div class="row">
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('full_name')?'has-error':''); ?>">
							<input type="text" name="full_name"  id="full_name2" class="form-control"  placeholder="Full Name" required>
							<span class="help-inline"></span>
							@if ($errors->has('full_name'))
									<span class="help-block"><strong>{{ $errors->first('full_name') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('mobile_no')?'has-error':''); ?>">
							<input type="text" name="mobile_no"  id="mobile_no2" class="form-control"  placeholder="Mobile Number" required>
							<span class="help-inline"></span>
							@if ($errors->has('mobile_no'))
									<span class="help-block"><strong>{{ $errors->first('mobile_no') }}</strong></span>
							@endif
						</div>
					</div>
				<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('vehical_number')?'has-error':''); ?>">
							<input type="text" name="vehical_number"  id="vehical_number2" class="form-control"  placeholder="Vehicle Number" required>
							<span class="help-inline"></span>
							@if ($errors->has('vehical_number'))
									<span class="help-block"><strong>{{ $errors->first('vehical_number') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('service')?'has-error':''); ?>">
							<input type="text" name="service"  id="service2" class="form-control"  placeholder="Service" readonly>
							<span class="help-inline"></span>
							@if ($errors->has('service'))
									<span class="help-block"><strong>{{ $errors->first('service') }}</strong></span>
							@endif
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('vehical_type')?'has-error':''); ?>">
							<?php $get_vehical = homeController::get_vehical();  ?>
							<select class="form-control form-select" aria-label="Default select example" id="vehical_type2" name="vehical_type" placeholder="Model" required>
									<option selected="">Select Model Type</option>
									<?php if(!empty($get_vehical)){ foreach($get_vehical as $row){?>
									<option value="{{$row->id}}">{{$row->vehicle_type}}</option>
									<?php }
									}?>

								</select>

							<span class="help-inline"></span>
							@if ($errors->has('vehical_type'))
									<span class="help-block"><strong>{{ $errors->first('vehical_type') }}</strong></span>
							@endif



						</div>
					</div>
						<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('vehical_brand')?'has-error':''); ?>">
						   <div id="vehical_brand">
							<select readonly class="form-control form-select" aria-label="Default select example" id="vehical_brand2" name="vehical_brand" placeholder="Model" required>
									<option selected="">Select Vehical Brand</option>
								</select>
						   </div>
							<span class="help-inline"></span>
							@if ($errors->has('vehical_brand'))
									<span class="help-block"><strong>{{ $errors->first('vehical_brand') }}</strong></span>
							@endif



						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group <?php echo ($errors->first('email')?'has-error':''); ?>">
							<input type="email" class="form-control" name="email"  id="email2"  placeholder="Email Address" required>
							<span class="help-inline"></span>
							@if ($errors->has('email'))
									<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>
							@endif
						</div>
					</div>
					<?php  $repaire_type = ['Clutch Work'=>'Clutch Work','Suspension Work'=>'Suspension Work',' Engine Work'=>' Engine Work','Gear Work'=>'Gear Work','Steering Work'=>'Steering Work'];     ?>
					<div class="col-sm-6" style="display:none;" id="repair_work1">
						<div class="form-group <?php echo ($errors->first('email')?'has-error':''); ?>">

							<select class="form-control form-select" aria-label="Default select example" id="repair_work2" name="repair_work" placeholder="Model" required>
									<option selected="">Select Repair Work</option>
									<?php if(!empty($repaire_type)){ foreach($repaire_type as $key => $value){?>
									<option value="{{$key}}">{{$value}}</option>
									<?php }
									}?>

								</select>

							<span class="help-inline"></span>
							@if ($errors->has('repair_work'))
									<span class="help-block"><strong>{{ $errors->first('repair_work') }}</strong></span>
							@endif
						</div>
					</div>
					<?php  $repaire_type1 = ['Washing'=>'Washing','Darycling'=>'Darycling','Polishing'=>'Polishing','Rubbing'=>'Rubbing','Sanitizing'=>'Sanitizing'];     ?>
					<div class="col-sm-6" style="display:none;" id="repair_work3">
						<div class="form-group <?php echo ($errors->first('email')?'has-error':''); ?>">

							<select class="form-control form-select" aria-label="Default select example" id="repair_work2" name="repair_work" placeholder="Model" required>
									<option selected="">Select Car Boutique</option>
									<?php if(!empty($repaire_type1)){ foreach($repaire_type1 as $key => $value){?>
									<option value="{{$key}}">{{$value}}</option>
									<?php }
									}?>

								</select>

							<span class="help-inline"></span>
							@if ($errors->has('repair_work'))
									<span class="help-block"><strong>{{ $errors->first('repair_work') }}</strong></span>
							@endif
						</div>
					</div>

					<div class="col-12">
						<div class="form-group">

							 <button  type="button"  onclick="booking();">Book Now</button>
						</div>
					</div>
				</div>
			</form>
		 </div>
		</div>

	  </div>
	</div>
  </div>
