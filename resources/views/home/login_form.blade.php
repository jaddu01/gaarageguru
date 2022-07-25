<?php  if(empty(Auth::user())){ ?>
								 
						<div id="login_div">	 
							<form id="login_form1" class="garrage-main-form" method="POST" action="">
								<div class="form-car-img">
									<img src="{{asset('/public/img/form-car-img.png')}}" alt="">
									<div class="car-under-input">
									<input type="text" placeholder="RJ-NC-8747">
											<span> <i class="fa fa-star"></i></span> 
									</div>
								</div>
							  <div class="loginpading {{ $errors->has('mobile_no') ? ' has-error' : '' }}" style="padding-bottom:10px;">
								<input type="text" class="form-control mob-no" id="mobile_no3" name="mobile_no" placeholder="Mobile No"  value="{{ old('mobile_no') }}" onkeypress="return isNumber(event)"/>
								 	<span class="help-inline"></span>
			                   	@if ($errors->has('mobile_no'))
                                    <span class="help-block" style="text-align:left;color:red;">
                                        {{ $errors->first('mobile_no') }}
                                    </span>
                                @endif
                                </div>    
							
								<!--<div class="loginpading {{ $errors->has('password') ? ' has-error' : '' }}" style="padding-bottom:10px;" >
								 <input type="password" class="form-control mob-no" name="password" placeholder="Password"  />
				                 @if ($errors->has('password'))
                                    <span class="help-block" style="text-align:left;color:red;">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                                </div>    -->
								
								 <button  type="button"  onclick="loginPost(); "  class="login">LOGIN</button>
								<button type="button" class="signin" id="sgnotpval" name="sgnotpval" data-bs-toggle="modal" data-bs-target="#exampleModal">SIGN IN</button>
						 </form>
				    </div>
				    
				    <div id="otp_div" style="display:none">	 
							<form id="otp_verify_form" class="garrage-main-form" method="POST" action="">
							    <input type="hidden" name="mobile" id="mobile_number_otp" value="" />
		                        <input type="hidden" name="user_id" id="user_id" value="" />
								<div class="form-car-img">
									<img src="{{asset('/public/img/form-car-img.png')}}" alt="">
									<div class="car-under-input">
									<input type="text" placeholder="RJ-NC-8747">
											<span> <i class="fa fa-star"></i></span> 
									</div>
								</div>
								
							  <div class="loginpading {{ $errors->has('otp') ? ' has-error' : '' }}" style="padding-bottom:10px;">
								<input type="text" class="form-control mob-no" id="otp" name="otp" placeholder="Enter Otp"  value="{{ old('otp') }}" onkeypress="return isNumber(event)"/>
								 	<span class="help-inline"></span>
			                   	@if ($errors->has('otp'))
                                    <span class="help-block" style="text-align:left;color:red;">
                                        {{ $errors->first('otp') }}
                                    </span>
                                @endif
                                </div>   
								 <button  type="button"  onclick="otpVerify();" class="login">Submit</button>
							
						 </form>
						 <div class="modal-footer">
			                    <div id="countdown"></div>
		                  </div>
				    </div>	
				    <?php } ?>