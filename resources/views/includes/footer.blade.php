	<!-- footer section start -->
    <footer>
        <div class="container">
            <div class="row footer-top">
                <div class="col-md-2">
                    <div class="footer-logo">
                        <img src="{{asset('public/img/footer-logo.svg')}}" alt="">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="footer-para">
                        <p>Gaarage Guru is technology based platform providing vehicle repair, service,
                            Insurance claim assistance, breakdown with end to end solution provider for all
                            vehicles related problems through our approved channel partners.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <div class="address-div">
                        <div class="address-inner-div">
                            <ul>
                                <li>
                                    <span>Address</span> <br>
                                    Registered Office: B1/521, Chitrakoot Yojna, <br>
                                    Vaishali Nagar, Jaipur, (Raj.)-302021
                                </li>
                                <li class="middle-footer-li">
                                    <span>Email</span> <br>
                                    <a href="mailto:support@gaarageguru.com">support@gaarageguru.com</a>
                                </li>
                                <li>
                                    <span>Phone</span> <br>
                                    <a href="tel:+91 95499 88333">+91 95499 88333</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 muscut">
                    <div class="social-link">
                        <img src="{{asset("public/img/footer-new-muscut.png")}}" alt="">
                        <div class="follow-us">
                            <p>Follow us at:</p>
                            <ul>
                                <li><a href="https://www.facebook.com/Gaarage-Guru-114998741089004"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="https://twitter.com/GaarageGuru/status/1484585273334046724"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="https://www.instagram.com/gaarageguru/"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <?php use App\Http\Controllers\homeController;  ?>
    <label for="target-modal4" class="btnmodal4" style="display: none;">BOOK NOW</label>
    <input type="checkbox" id="target-modal4">
    <div class="modal4">
        <div class="modal-inner4">
            <label for="target-modal4" class="close-modal"></label>
            <div class="login-form4">
                <div class="sign-in-logo">
                    <img src="{{asset("public/img/footer-new-muscut.png")}}" alt="" style="height: 159px;">
                </div>
                <h5>Book Your Services</h5>
                <p class="signup-para-top">Where Your Car matters!</p>
                <form id="booking_form" method="post" action="" enctype="multipart/form-data">
                    <div class="booknow-form-inner">
                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="vehical_number"  id="vehical_number2" class="form-control"  placeholder="Enter Your Vehicle No." required>
                                <span class="help-inline"></span>
                                @if ($errors->has('vehical_number'))
                                    <span class="help-block"><strong>{{ $errors->first('vehical_number') }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <input type="Number" name="mobile_no"  id="mobile_no2" class="form-control"  placeholder="Enter Your Phone Number" required>
                                <span class="help-inline"></span>
                                @if ($errors->has('mobile_no'))
                                    <span class="help-block"><strong>{{ $errors->first('mobile_no') }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <?php $get_vehical = homeController::get_vehical();  ?>
                                <select class="form-select" aria-label="Default select example" id="vehical_type2" name="vehical_type">
                                    <option selected style="color: #ccc;">Select Vehicle Type</option>
                                    @if(!empty($get_vehical))
                                        @foreach($get_vehical as $row)
                                            <option value="{{$row->id}}">{{$row->vehicle_type}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="help-inline"></span>
                                @if ($errors->has('vehical_type'))
                                    <span class="help-block"><strong>{{ $errors->first('vehical_type') }}</strong></span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <select class="form-select" aria-label="Default select example" id="vehical_brand" name="vehical_brand">
                                    <option selected>Select Modal Type</option>
                                </select>
                                <span class="help-inline"></span>
                                @if ($errors->has('vehical_brand'))
                                    <span class="help-block"><strong>{{ $errors->first('vehical_brand') }}</strong></span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="selectyour-service">
                        <h6>Select your service</h6>
                        <div>
                            <ul>
                                <li>
                                    <input type="radio" id="f-option" value="Car Servicing" name="service" checked="checked">
                                    <label for="f-option">Car Servicing</label>

                                    <div class="check"></div>
                                </li>

                                <li>
                                    <input type="radio" id="s-option" value="Car Repairing" name="service">
                                    <label for="s-option">Car Repairing</label>

                                    <div class="check"><div class="inside"></div></div>
                                </li>

                                <li>
                                    <input type="radio" id="t-option" value="Denting & Painting" name="service">
                                    <label for="t-option">Denting & Painting</label>

                                    <div class="check"><div class="inside"></div></div>
                                </li>
                                <li>
                                    <input type="radio" id="y-option" value="Others" name="service">
                                    <label for="y-option">Others</label>

                                    <div class="check"><div class="inside"></div></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="free-pickup">
                        <p>Free Pick-up & Drop facility within 5 km</p>
                        <ul class="unstyled centered">
                            <li>
                                <input type="radio" id="y-option" value="Yes" name="free_pickup">
                                <label for="y-option">Yes</label>

                                <div class="check"><div class="inside"></div></div>
                            </li>
                            <li>
                                <input type="radio" id="y-option" value="no" name="free_pickup">
                                <label for="y-option">No</label>

                                <div class="check"><div class="inside"></div></div>
                            </li>
                        </ul>
                    </div>
                    <div class="booking-date">
                        <p>Booking Date</p>
                        <input type="date" id="booking" name="booking">
                    </div>
                    <button class="sign-btn booknow" type="button" onclick="booking();">Book Now</button>
                </form>
            </div>
        </div>
        <label for="target-modal4" class="overlay-modal bookingmodel"></label>
    </div>
		<!-- footer section end -->
