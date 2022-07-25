@extends('front.layouts.master')
@section('title',$title)
 @section('content')
 <section class="inner-banner" style="background-image:url({{ asset('public/web/images/page-title-bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner" data-aos="fade-up" data-aos-once="true">
                         <h1 class="page-title">Refund and Cancellation Policy</h1>
                        <ul class="page-list">
                            <li><a href="{{ URL::to('/') }}">Home</a></li>
                          <li>Refund and Cancellation Policy</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

     <section class="privacy-policy-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h6><strong>Refund and Cancellation Policy</strong></h6>
                   <p> Our focus is complete customer satisfaction. In the event, if you are displeased with the services provided, we will refund back the money provided the reasons are genuine and proved after investigation. Please read the fine prints of each deal before buying it, it provides all the details about the services or the product you purchase. </p>
					<p>In case of dissatisfaction from our services, clients have the liberty to cancel their projects and request a refund from us. Our Policy for the cancellation and refund will be as follows:</p>

                    <h6><strong>Cancellation Policy</strong></h6>
                   <p> For Cancellations please contact us via contact us. </p>
<p>Requests received later than 7 business days prior to the end of the current service, the period will be treated as a cancellation of services for the next service period. </p>
					
                  <h6><strong>Refund Policy </strong></h6>

  <p>We will try our best to create a suitable design concepts for our clients.

<h6><strong>No refund will be provided.</strong></h6>

  <p>If paid by credit card, refunds will be issued to the original credit card provided at the time of purchase and in case of payment gateway name payments refund will be made to the same account.</p>

					<p>Please mail us for any Query: <a href="mailto:testpaperlive@gmail.com">testpaperlive@gmail.com </a> </p>

					<p>No refund will be provided.</p>
                </div>
            </div>
        </div>
    </section>
 @endsection
 
 @section('script')
 <script>
function search(){ //alert(href);
   
        $.ajax({

            type: 'GET',

             url: '{{ URL::to('/dashboard') }}',

            data: $('#filter_document').serialize(),

            beforeSend: function(){

              $.LoadingOverlay("show");

            },

            success: function(data){ 
				  $('#replace-div').html('');
                $('#replace-div').html(data);
                $.LoadingOverlay("hide");

                return false;

            }

        });
    }
$('.view_type').click(function(){
		var id = $(this).attr("data-id");
	
		$("#view_type").val(id);
		if(id == 1){
			$(".btn-col").removeClass("active");
		}else{
			$(".btn-grid").removeClass("active")
		}
		$(this).addClass("active");
		search();
	});

 </script>
 @endsection