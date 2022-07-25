@extends('layouts.master')
@section('title',$title)
 @section('content')
     <!--  all-services  section start -->

     <section class="all-services">
         <div class="container">
             <div class="all-services-inner">
                 <div class="row">
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service1.png")}}" alt="">
                             <div class="service-all-content">
                                 <h6>Preventative <br> Maintenance</h6>
                                 <p>The best way to minimize <br>
                                     breakdowns is doing routine <br>
                                     maintenance</p>
                             </div>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service2.png")}}" alt="">
                             <div class="service-all-content">
                                 <h6>Brake <br>
                                     Repair & Services</h6>
                                 <p>Brakes wear out over time <br>
                                     requiring service</p>
                             </div>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service3.png")}}" alt="">
                             <div class="service-all-content">
                                 <h6>Transmission <br>
                                     Service & Repair</h6>
                                 <p>The transmission is  <br>
                                     complicated and important <br>
                                     components of your car</p>
                             </div>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service4.png")}}" alt="">
                             <div class="service-all-content">

                                 <h6>Engine <br>
                                     Servicing</h6>
                                 <p>Brakes wear out over time <br>
                                     requiring service</p>
                             </div>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service5.png")}}" alt="">
                             <div class="service-all-content">

                                 <h6>Tires <br>
                                     & Wheels</h6>
                                 <p>The best way to minimize <br>
                                     breakdowns is doing routine <br>
                                     maintenance</p>
                             </div>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="services-all">
                             <img src="{{asset("public/img/service6.png")}}" alt="">
                             <div class="service-all-content">
                                 <h6>Smoke Exhaust <br>
                                     System</h6>
                                 <p>The best way to minimize <br>
                                     breakdowns is doing routine <br>
                                     maintenance</p>
                             </div>


                         </div>
                     </div>
                 </div>
                 <div class="all-btn-sec">
                     <a href="javascript:void(0);" onclick="openBookingPopup();">Book Now</a>

                 </div>
             </div>
         </div>
     </section>

     <!-- all-services  section end -->



     <!-- vehicle damage section start -->
     <section class="vehicle-damage p_70">
         <div class="container">
             <div class="all-sec-heading schedule-bg">
                 <h2>Vehicle Damage? <span>We'll fix it</span></h2>
                 <p>We specialize in car repair. We're the one of largest <br>
                     accident damage repair network</p>
                 <h5>+91 95499 88333</h5>
                 <div class="all-btn-sec">
                     <a href="tel:+91 9549988333">Need Help?</a>
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

     <!-- reapir services section start -->
     <section class="repair-services">
         <div class="container">
             <div class="repair-inner">
                 <div class="all-sec-heading">
                     <h2>Repair Services  <br>
                         <span>That We Offer</span></h2>
                     <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
                     <p>We provide a full range of front end mechanical repairs for all makes and models
                         of cars, no matter the cause. This includes everything from struts, shocks, and tie rod
                         ends to ball joints, springs, and basically very thing that is included in repairing the
                         front end of the vehicle.</p>
                 </div>
                 <div class="all-repair-services">
                     <div class="row">
                         <div class="col-lg-6">
                             <div class="repair-inner-ul">
                                 <ul>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>FREE Local Shuttle Service</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Auto Repair & Maintenance</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Parts Repair & Replacement</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Fuel System Repair</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Exhaust System Repair</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Engine Cooling Maintenance</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Electrical Diagnostics</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Starting and Charging Repair</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>  Wheel Alignment</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Computer Diagnostic Testing</li>
                                 </ul>
                             </div>
                         </div>
                         <div class="col-lg-6">
                             <div class="repair-inner-ul">
                                 <ul>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Brake Repair and Replacement</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Air Conditioning A/C Repair</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Tire Repair and Replacement</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Vehicle Maintenance</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>State Emissions Inspection</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Emission Repair Facility</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Tune Up & Oil Change</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Brake Job / Brake Service</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Engine Cooling System & Repair</li>
                                     <li><i class="fa fa-check" aria-hidden="true"></i>Steering and Suspension Work</li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- reapir services section end -->

<script>

var msg = '{{Session::get("messagealerterror")}}';
var exist = '{{Session::has("messagealerterror")}}';
if(exist){
	swal(
		'Error!!',
		msg,
		'error'
	);
}


var msg1 = '{{Session::get("messagealert")}}';
var exist1 = '{{Session::has("messagealert")}}';
if(exist1){
	swal(
		'Success.',
		msg1,
		'success'
	);
}

var placeSearch, autocomplete;
/*
var componentForm = {
	street_number: 'short_name',
	route: 'long_name',
	locality: 'long_name',
	administrative_area_level_1: 'short_name',
	country: 'long_name',
	postal_code: 'short_name'
}; */

function initAutocomplete() {
	// Create the autocomplete object, restricting the search predictions to
	// geographical location types.
	autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});


	autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('township'), {types: ['geocode']});

	// Avoid paying for data that you don't need by restricting the set of
	// place fields that are returned to just the address components.
	//autocomplete.setFields(['address_component']);

	// When the user selects an address from the drop-down, populate the
	// address fields in the form.
	autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
	// Get the place details from the autocomplete object.
	var place = autocomplete.getPlace();

	/* for (var component in componentForm) {
		document.getElementById(component).value = '';
		document.getElementById(component).disabled = false;
	} */

	var latitude = place.geometry.location.lat();
	var longitude = place.geometry.location.lng();

	//document.getElementById("latitude").value =  latitude;

	//document.getElementById("longitude").value =  longitude;

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
	/* for (var i = 0; i < place.address_components.length; i++) {
		var addressType = place.address_components[i].types[0];
		if (componentForm[addressType]) {
		  var val = place.address_components[i][componentForm[addressType]];
		  document.getElementById(addressType).value = val;
		}
	} */
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {

			//document.getElementById("latitude").value =  position.coords.latitude;

			//document.getElementById("longitude").value =  position.coords.longitude;

			var geolocation = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			var circle = new google.maps.Circle(
			  {center: geolocation, radius: position.coords.accuracy});
			autocomplete.setBounds(circle.getBounds());
		});
	}
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsxJLlaBTlok7ZBpMW1isgvw6FgWmsF70&libraries=places&callback=initAutocomplete"
        async defer></script>
     @push("scripts")

     @endpush

 @endsection

