<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="{{ URL::asset('fevicol.png') }}" type="image/gif" sizes="16x16">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700&family=Poppins:ital,wght@0,200;0,300;0,400;0,500;0,600;0,900;1,800&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	 

	 <link href="{{ URL::asset('public/css/style_new.css') }}" rel="stylesheet">
	 <link rel="stylesheet" href="{{ asset('public/css/toastr.min.css') }}">
	<title>Gaarage Guru Motors Private Limited</title>
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ asset('public/js/loadingoverlay.min.js') }}"></script>
<script src="{{ asset('public/js/toastr.min.js') }}"></script>
</head>
	<script type="text/javascript">
function updateAccount(){
    
 //if ($('#siginin-form').valid()) {  
     
		$.LoadingOverlay("show");
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
			$.LoadingOverlay("hide");
				showMessage(data['message'],"success");
				$('#exampleModal').modal('hide');
			}else if(data['success'] == 2) {
				$.LoadingOverlay("hide");
                    document.getElementById("update-card").reset();
                    showMessage(data['message'],"error");
                }
			else {
			    $.LoadingOverlay("hide");
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
			   $.LoadingOverlay("hide");
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
  
  /*$('#siginin-form').each(function() {
	$(this).find('input').keypress(function(e) {
       if(e.which == 10 || e.which == 13) {
			updateAccount();
			return false;
        }
    });*/
</script>

<script type="text/javascript">
		window.addEventListener("scroll", function(){
			var header = document.querySelector("header");
			header.classList.toggle("sticky", window.scrollY > 0);
		})
	</script>
							
<script>
		var site_url = '{!! url("/") !!}';
		var public_url = '{!! url("/public") !!}';
		var csrf_token = "{{csrf_token()}}";
			</script>
<body>
       
		<!-- Header -->
		@include('includes.header')	
		@yield('content')
		@include('includes.footer')	
		
		
	<script type="text/javascript">
		if($('.owl-carousel').length>0)
		    {
		        $('.owl-carousel').owlCarousel({
		        loop:true,
		        margin:16,
		        nav:true,
		        dots:false,
		        responsive:{
		            0:{
		                items:1
		            },
		            576:{
		                items:2
		            },
		            1000:{
		                items:4
		            }
		        }
		      })
		    }
		
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
	<script>
	$(document).ready(function(){
		$("#sgnotpvallgn").click(function(){ 
		var mblvalotp = $("#mblvalotp").val();
		  window.location.assign("https://gaarageguru.com/login")
		});
	});
	</script>

	<!-- sign-in pop end -->
							
	
</body>

</html>