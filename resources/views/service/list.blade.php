@extends('layouts.app')

@section('content')

<!-- page content -->
	<div class="right_col" role="main">
        <div id="myModal" class="modal fade" role="dialog">
			<div class="modal-dialog modal-lg">
    <!-- Modal content-->
				<div class="modal-content modal_data">
				</div>
			</div>
        </div>
		
		<!-- Modal for Coupon Data -->
			<div class="modal fade" id="coupaon_data" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content used_coupn_modal_data">
						
					</div>
				</div>
			</div>
		<!-- End Modal for Coupon Data -->
        <div class="">
           <div class="page-title">
                <div class="nav_menu">
					<nav>
					  <div class="nav toggle">
						<a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp {{ trans('app.Service')}}</span></a>
					  </div>
						  @include('dashboard.profile')
					</nav>
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
							@can('service_view')
								<li role="presentation" class="active"><a href="{!! url('/service/list')!!}"><span class="visible-xs"></span> <i class="fa fa-list fa-lg">&nbsp;</i><b>{{ trans('app.Services List')}}</b></a></li>
							@endcan
							@can('service_add')
								<li role="presentation" class=""><a href="{!! url('/service/add')!!}"><span class="visible-xs"></span><i class="fa fa-plus-circle fa-lg">&nbsp;</i> {{ trans('app.Add Services')}} </a></li>
							@endcan
						</ul>
					</div>
					<div class="x_panel table_up_div">
						<table id="datatable" class="table table-striped jambo_table" style="margin-top:20px;">
							<thead>
								<tr>
									<th>#</th>
									<th>{{ trans('app.Job No')}}</th>
									<th>{{ trans('app.Customer Name')}}</th>
									<th>{{ trans('app.Date')}}</th> 
									<th>{{ trans('app.Service Category')}}</th>
									<th>{{ trans('app.Assign To')}}</th>
									<th>{{ trans('app.Free Service Coupon')}}</th>
									<th>{{ trans('app.Number Plate')}}</th>
									<th>{{ trans('app.Action')}}</th>
								</tr>
							</thead>
							<tbody>
							@if(!empty($service))
							<?php $i=1;?> 
								@foreach($service as $services)
									<tr>
										<td>{{ $i }}</td>
										<td>{{ $services->job_no }}</td>
										<td>{{ getCustomerName($services->customer_id) }}</td>
											<?php $date_db = date("Y-m-d", strtotime($services->service_date)); ?>
											@if(!empty($current_month) && strpos($available, $date_db) !== false)
											
												 <td><span class="label label-danger" style="font-size:13px;">{{date(getDateFormat(),strtotime($date_db)) }}</span></td>
											@else
												 <td> {{ date(getDateFormat(),strtotime($date_db)) }}</td>
											@endif
										<td>{{ $services->service_category }}</td>
										<td>{{ getAssignTo($services->assign_to) }}</td>
										<?php $coupon = getAllCoupon($services->customer_id,$services->vehicle_id);
										?>
										@if($services->service_type == "free")
											<td style="width:20%">
												@foreach($coupon as $coup)
													<?php $useddata = getUsedCoupon($services->customer_id,$services->vehicle_id,$coup->job_no);
													?>
													@if($useddata == 1)
														<button class="btn btn-danger btn-xs coupon_btn" data-toggle="modal" data-target="#coupaon_data" id="coup_data" coupon_no="{{ $coup->job_no }}" servi_id="{{ $services->id }}" url="{!! url('/service/used_coupon_data') !!}">{{ $coup->job_no }}</span></button>
													@elseif($useddata == 'empty')
														<button class="btn btn-warning btn-xs coupon_btn" data-toggle="modal" data-target="#coupaon_data" id="coup_data" coupon_no="{{ $coup->job_no }}" servi_id="{{ $services->id }}" url="{!! url('/service/used_coupon_data') !!}">{{ $coup->job_no }}</span>
													@elseif($useddata == 0)
														<button class="btn btn-success btn-xs" disabled >{{ $coup->job_no }}</span>
													@endif
												@endforeach
											
											</td>
										@else
											<td>{{ trans('app.Paid Service') }}</td>
										@endif
										<td>{{ getVehicleNumberPlate($services->vehicle_id)??"Not Added" }}</td>
										<td> 
											@can('service_view')
												<button type="button" data-toggle="modal" data-target="#myModal" serviceid="{{ $services->id }}" url="{!! url('/service/list/view') !!}" class="btn btn-round btn-info save">{{ trans('app.View')}}</button>
											@endcan
											@can('service_edit')	
												<a href="{!! url('/service/list/edit/'.$services->id) !!}" ><button type="button" class="btn btn-round btn-success">{{ trans('app.Edit')}}</button></a>
											@endcan
											@can('service_delete')
												<a url="{!! url('/service/list/delete/'.$services->id) !!}" class="sa-warning"><button type="button" class="btn btn-round btn-danger">{{ trans('app.Delete')}}</button></a>
											@endcan
										</td>
									</tr>
									<?php $i++; ?>
									@endforeach
								@endif
								
								</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>  
<!-- /page content -->


<!-- Scripts starting -->
<script src="{{ URL::asset('vendors/jquery/dist/jquery.min.js') }}"></script>
<!-- language change in user selected -->	
<script>
$(document).ready(function() 
{
    $('#datatable').DataTable( {
		responsive: true,
        "language": {
			
				"url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/<?php echo getLanguageChange(); 
			?>.json"
        }
    } );


 	$('body').on('click', '.sa-warning', function() {
	
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
 

	$('body').on('click', '.save', function() {
       	var servicesid = $(this).attr("serviceid");
       	var url = $(this).attr('url');
       	var msg10 = "{{ trans('app.An error occurred :')}}";

       	$.ajax({
       		type: 'GET',
       		url: url,
      		data : {servicesid:servicesid},
       		success: function (data)
       		{            
				$('.modal_data').html(data.html);     
			},   
			error: function(e) {
			   alert(msg10 + " " + e.responseText);
			   console.log(e);  
			}
       });

    });



	$('body').on('click', '.coupon_btn', function() {		
		var coupon_no = $(this).attr('coupon_no');
		var ser_id = $(this).attr('servi_id');
		var url = $(this).attr('url');
		
		$.ajax({
			
			url: url,
			type: 'GET',
			data: {coupon_no:coupon_no,ser_id:ser_id},
		
			success:function(response)
			{
				
				$('.used_coupn_modal_data').html(response.html);     
			},
			erro:function(e)
			{
				console.log(e);
			}
		});
	});
});
</script>
@endsection