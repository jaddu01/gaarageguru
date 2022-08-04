@extends('layouts.master')
@section('title',$title)
 @section('content')

     <!-- get in touch start  section -->
     <section class="get-in-touch">
         <div class="container">
             <div class="all-sec-heading">
                 <h2>Get in touch!</h2>
                 <p>We specialize in car repair. We're the one of largest
                     accident damage repair network</p>
                 <img src="{{asset("public/img/all-sec-bottom-border.svg")}}" alt="">
             </div>
             <div class="get-in-touch-inner">
                 <div class="contact-inner-form-div">
                    @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                     <form id="contact_form" method="post" class="garrage-main-form" action="{{route('saveContactUs')}}" enctype="multipart/form-data">
                        @csrf()
                        <div class="row">
                             <div class="col-sm-6">
                                 <div class="form-group ">
                                     <input type="text" class="form-control" id="full_name1" value="{{old('full_name','')}}" placeholder="Full Name" name="full_name">
                                     <span class="help-inline"></span>
                                 </div>
                                 @error('full_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group ">
                                     <input type="text" class="form-control" id="phone_number1" value="{{old('phone_number','')}}" placeholder="Phone Number" name="phone_number">
                                     <span class="help-inline"></span>
                                 </div>
                                 @error('phone_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group ">
                                     <input type="email" class="form-control" id="email1" value="{{old('email','')}}" placeholder="E-mail" name="email">
                                     <span class="help-inline"></span>
                                 </div>
                                 @error('email')
                                 <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
                             </div>
                             <div class="col-sm-6">
                                 <div class="form-group select-option-arrow-img ">
                                     <select class="form-control form-select" aria-label="Default select example" id="service1" name="service">
                                         <option selected="" value="">Select Service Type</option>
                                         <option value="Free" {{old('service') == 'Free' ? 'selected' : ''}}>Free</option>
                                         <option value="Paid" {{old('service') == 'Paid' ? 'selected' : ''}}>Paid</option>

                                     </select>
                                     <span class="help-inline"></span>
                                 </div>
                                 @error('service')
                                 <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
                             </div>
                             <div class="col-12">
                                 <div class="form-group ">
                                     <textarea class="form-control" id="message1" placeholder="Message*" rows="6" name="message">{{old('message','')}}</textarea>
                                     <span class="help-inline"></span>
                                 </div>
                                 @error('message')
                                 <div class="alert alert-danger">{{ $message }}</div>
                             @enderror
                             </div>
                             <div class="col-12">
                                 <div class="all-btn-sec">
                                     <button type="submit">Contact Us</button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </section>
     <!-- get in touch end  section -->

     <!-- helpline start  section -->
     <section class="helpline pt-5">
         <div class="container">
             <div class="helpline-inner">
                 <div class="row">
                     <div class="col-md-4">
                         <div class="help-in-div">
                             <div> <img src="{{asset("public/img/helpline-number.svg")}}" alt=""></div>
                             <h6>Helpline Number</h6>
                             <p>+91 9549988333</p>
                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="help-in-div">
                             <div>   <img src="{{asset("public/img/opening-hours.svg")}}" alt=""></div>
                             <h6>Opening Hours</h6>
                             <p>Mon-Sat: 9:30 AM - 6:30 PM  <br>
                             <span style="font-size: small">(Sunday By Appointment Only)</span></p>

                         </div>
                     </div>
                     <div class="col-md-4">
                         <div class="help-in-div">
                             <div><img src="{{asset("public/img/email-address.svg")}}" alt=""></div>
                             <h6>E-mail Address</h6>
                             <p>support@gaarageguru.com</p>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </section>
     <!-- helpline start  section -->

     <!-- career start section -->
     <section class="carrer p_70">
         <div class="container">
             <div class="carrer-inner all-sec-heading">
                 <h2>Career<span>@</span>Gaarage Guru</h2>
                 <h6>Let's grow together.</h6>
                 <p>We're building a culture at Gaarage Guru where amazing
                     people (like you) can do their best work. If you're ready to grow
                     your career and help millions to ease their life and get best of the
                     services, share your resume to claim your place.</p>
                 <div class="all-btn-sec">
                     <a href="#">career@gaarageguru.com</a>
                 </div>
             </div>
         </div>
     </section>
     <!-- career end section -->

     <script>
function contact_us() {
		$.LoadingOverlay("show");
		$('.help-inline').html('');
		$('.help-inline').removeClass('error');
		$.ajax({
			url: '{{ URL("contact-us") }}',
			type:'post',
			data: $('#contact_form').serialize(),
			success: function(r){
				error_array 	= 	JSON.stringify(r);
				data			=	JSON.parse(error_array);
				if(data['success'] == 1) {

					showMessage(data['message'],"success");
					$('#contact_form').trigger("reset");
					//window.location.href	 =	"{{ URL('contact-us') }}";

				}else {
					$.each(data['errors'],function(index,html){
					$("input[id = "+index+"1]").next().addClass('error');
					$("input[id = "+index+"1]").next().html(html);
					$("select[id = "+index+"1]").next().addClass('error');
					$("select[id = "+index+"1]").next().html(html);
					$("textarea[id = "+index+"1]").next().addClass('error');
					$("textarea[id = "+index+"1]").next().html(html);
					});
					$.LoadingOverlay("hide");
				}
					$.LoadingOverlay("hide");
			}
		});
	}

	 $('#contact_form').each(function() {
		$(this).find('input').keypress(function(e) {
           if(e.which == 10 || e.which == 13) {
				contact_us();
				return false;
            }
        });
	});
 </script>
 @endsection
