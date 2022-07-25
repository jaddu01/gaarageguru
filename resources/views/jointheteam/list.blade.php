@extends('layouts.app')
@section('content')

<!-- page content -->
    <div class="right_col" role="main">
        <div class="">
			<div class="page-title">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle">
							<a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; Join The Team</span></a>
						</div>
						@include('dashboard.profile')
					</nav>
				</div>
			</div>
        </div>
		@if(session('message'))
			<div class="row massage">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="checkbox checkbox-success checkbox-circle">
						@if(session('message') == 'Successfully Submitted')
							<label for="checkbox-10 colo_success"> {{trans('app.Successfully Submitted')}}  </label>
						@elseif(session('message')=='Successfully Updated')
							<label for="checkbox-10 colo_success"> {{ trans('app.Successfully Updated')}}  </label>
						@elseif(session('message')=='Successfully Deleted')
							<label for="checkbox-10 colo_success"> {{ trans('app.Successfully Deleted')}}  </label>
						@endif
					</div>
				</div>
			</div>
		@endif

        <div class="row" >
			<div class="col-md-12 col-sm-12 col-xs-12" >
				<div class="x_content">
					<ul class="nav nav-tabs bar_tabs" role="tablist">
						@can('booking_view')
							<li role="presentation" class="active"><a href="{!! url('/booking/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i><b>Join The Team List</b></a></li>
						@endcan
						
					
					</ul>
				</div>
				<div class="x_panel">
					<table id="datatable" class="table table-striped  jambo_table" style="margin-top:20px;" >
						<thead>											
							<tr>
								<th>#</th>
								<th>Full Name</th>
								<th>Mobile Number</th>
								<th>Loction</th>
								<th>Pin Code</th>
								<!-- <th>{{ trans('app.Enable Branch')}}</th> -->
								
							
							</tr>
						
						</thead>
						<tbody>
							<?php $i = 1; ?>   
						@foreach($joinTheTeam as $branchData)
							<tr>
								<td>{{ $i }}</td>
							
								<td>{{ $branchData->name }}</td>
								<td>{{ $branchData->mobile_no }}</td>
								<td>{{ $branchData->location }}</td>
								<td>{{ $branchData->pin_code }}</td>
								
								<!-- <td>{{ $branchData->branch_status }}</td> -->
								
							
							</tr>
							<?php $i++; ?>
						@endforeach
						</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<script>
	$(document).ready(function() {
	    $('#datatable').DataTable( {
			responsive: true,
	        "language": {
				
					"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo getLanguageChange(); 
				?>.json"
	        }
	    });


	    /******* Delete Employee ******/
	    $('body').on('click', '.sa-warning', function() 
	    {
		  	var url =$(this).attr('url');
		  	var msg1 = "{{ trans('app.Are You Sure?')}}";
		    var msg2 = "{{ trans('app.You will not be able to recover this data afterwards!')}}";
		    var msg3 = "{{ trans('app.Cancel')}}";
		    var msg4 = "{{ trans('app.Yes, delete!')}}";
		  
	        swal({   
	        	title: msg1,
	            text: msg2,   
	            type: "warning",   
	            showCancelButton: true, 
	            cancelButtonText: msg3, 
	            cancelButtonColor: "#C1C1C1",
	            confirmButtonColor: "#297FCA",   
	            confirmButtonText: msg4,   
	            closeOnConfirm: false
	        }, function(){
				window.location.href = url;
	        });
    	});

	});
</script>
      
@endsection