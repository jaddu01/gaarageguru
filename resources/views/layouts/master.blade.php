<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset("public/css/style.css")}}">
    <link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
    <title>Gaarage guru</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"  crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script href="{{asset("public/js/loadingoverlay.min.js")}}"></script>
    <script href="{{asset("public/js/toastr.min.js")}}"></script>
    <script type="text/javascript">
        window.addEventListener("scroll", function(){
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>
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
    @stack("styles")
</head>

<body>
		<!-- Header -->
		@include('includes.header')
		@yield('content')
		@include('includes.footer')


        <script>
            var site_url = '{!! url("/") !!}';
            var public_url = '{!! url("/public") !!}';
            var csrf_token = "{{csrf_token()}}";
        </script>

        <script>
            function showMessage(message,type) {
                toastr.remove()
                if (type == 'success') {
                    toastr.success(message);
                } else if (type == 'error') {
                    toastr.error(message);
                } else if (type == 'warning') {
                    toastr.warning(message);
                } else if (type == 'info') {
                    toastr.info(message);
                }
            }
        </script>
        <script type="text/javascript">
            $( "#vehical_type2" ).change(function () { //alert();

                var vehical_type2 = $(this).val();

                $.ajax({

                    url: "{{url('vehical_brand') }}" + '/'+vehical_type2,

                    success: function(data) {

                        //$('#order_by').prop('disabled', false);

                        $('#vehical_brand').html('');

                        $('#vehical_brand').html(data);

                    }

                });

            });
            function openBookingPopup(service){
                $('#service2').val(service);
                /*if(service == 'Repair'){
                    $('#repair_work1').show();
                    $('#repair_work3').hide();
                }else if(service == "Car Boutique"){
                    $('#repair_work3').show();
                    $('#repair_work1').hide();
                }else{
                    $('#repair_work1').hide();
                    $('#repair_work3').hide();
                }
                $('#enquireModal').modal('show');*/
                $(".btnmodal4").trigger("click");
            }
$(document).ready(function (){
   $(".booknow").on("click", function (){
       //$.LoadingOverlay("show");
       $('.help-inline').html('');
       $('.help-inline').removeClass('error');
       $.ajax({
           url: '{{ URL("booking") }}',
           type:'post',
           data: $('#booking_form').serialize(),
           success: function(r){
               error_array 	= 	JSON.stringify(r);
               data			=	JSON.parse(error_array);
               if(data['success'] == 1) {

                   //showMessage(data['message'],"success");
                   $('.bookingmodel').trigger("click");
                   //$('#enquireModal').modal('hide');
                   location.reload();
               }else {
                   $.each(data['errors'],function(index,html){
                       $("input[id = "+index+"2]").next().addClass('error');
                       $("input[id = "+index+"2]").next().html(html);
                       $("select[id = "+index+"2]").next().addClass('error');
                       $("select[id = "+index+"2]").next().html(html);
                       $("textarea[id = "+index+"2]").next().addClass('error');
                       $("textarea[id = "+index+"2]").next().html(html);
                   });
                   //$.LoadingOverlay("hide");
               }
               //$.LoadingOverlay("hide");
           }
       });
   })
});
            function booking() {
                //$.LoadingOverlay("show");
                $('.help-inline').html('');
                $('.help-inline').removeClass('error');
                $.ajax({
                    url: '{{ URL("booking") }}',
                    type:'post',
                    data: $('#booking_form').serialize(),
                    success: function(r){
                        error_array 	= 	JSON.stringify(r);
                        data			=	JSON.parse(error_array);
                        if(data['success'] == 1) {

                            showMessage(data['message'],"success");
                            $('#enquire_form').trigger("reset");
                            $('#enquireModal').modal('hide');
                            //window.location.href	 =	"{{ URL('contact-us') }}";
                        }else {
                            $.each(data['errors'],function(index,html){
                                $("input[id = "+index+"2]").next().addClass('error');
                                $("input[id = "+index+"2]").next().html(html);
                                $("select[id = "+index+"2]").next().addClass('error');
                                $("select[id = "+index+"2]").next().html(html);
                                $("textarea[id = "+index+"2]").next().addClass('error');
                                $("textarea[id = "+index+"2]").next().html(html);
                            });
                            //$.LoadingOverlay("hide");
                        }
                        //$.LoadingOverlay("hide");
                    }
                });
            }

            $('#booking_form').each(function() {
                $(this).find('input').keypress(function(e) {
                    if(e.which == 10 || e.which == 13) {
                        booking();
                        return false;
                    }
                });
            });
        </script>
	<!-- sign-in pop end -->
@stack("scripts")

</body>

</html>
