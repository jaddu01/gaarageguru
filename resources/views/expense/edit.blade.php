@extends('layouts.app')
@section('content')

<!-- page content -->
<div class="right_col" role="main">
   <div class="">
      <div class="page-title">
         <div class="nav_menu">
            <nav>
               <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i><span class="titleup">&nbsp; {{ trans('app.Expense')}}</span></a>
               </div>
               @include('dashboard.profile')
            </nav>
         </div>
      </div>
   </div>
   <div class="x_content">
      <ul class="nav nav-tabs bar_tabs tabconatent" role="tablist">
         @can('expense_view')
            <li role="presentation" class=""><a href="{!! url('/expense/list')!!}"><span class="visible-xs"></span><i class="fa fa-list fa-lg">&nbsp;</i> {{ trans('app.Expense List')}}</a></li>
         @endcan
         @can('expense_edit')
            <li role="presentation" class="active setSizeForEditExpenseForSmallDevice"><a href="{!! url('/expense/edit/'.$first_data->id)!!}"><span class="visible-xs"></span> <i class="fa fa-plus-circle fa-lg">&nbsp;</i><b>{{ trans('app.Edit Expense')}}</b></a></li>
         @endcan
      </ul>
   </div>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
         <div class="x_panel">
            <div class="x_content">
               <form id="expenseEditForm" method="post" action="{{URL::to('expense/update/'.$first_data->id)}}" enctype="multipart/form-data"  class="form-horizontal upperform">
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <h4><b>{{ trans('app.Expenses Details')}}</b></h4>
                     <hr style="margin-top:0px;">
                     <p class="col-md-12 col-xs-12 col-sm-12"></p>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="main_label">{{ trans('app.Main Label') }} <label class="color-danger">*</label> 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <input type="text" id="main_label" name="main_label"  class="form-control mainLabel" placeholder="{{ trans('app.Enter Main Label')}}" value="{{ $first_data->main_label }}" maxlength="30" required  />
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">{{ trans('app.Status') }} <label class="color-danger">*</label> 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <select name="status" id="status" class="form-control" required>
                              <option value="">Select Status</option>
                              <option value="1" <?php if($first_data->status == 1) { echo 'Selected'; } ?> >Paid</option>
                              <option value="2" <?php if($first_data->status == 2) { echo 'Selected'; } ?> >Unpaid</option>
                              <option value="0" <?php if($first_data->status == 0) { echo 'Selected'; } ?> >Partially Paid</option>
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="date">{{ trans('app.Date') }} <label class="color-danger">*</label> 
                        </label>
                        <div class="col-md-9 col-sm-9 col-xs-12 input-group date datepicker">
                           <span class="input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                           <input type="text" id="outdate_gatepass" autocomplete="off" name="date" class="form-control expenseDate" placeholder="<?php echo getDateFormat();?>" value="{{ date(getDateFormat(),strtotime($first_data->date)) }}" onkeypress="return false;" required  />
                        </div>
                     </div>

                     <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="branch">{{ trans('app.Branch')}} <label class="color-danger">*</label></label>
                              
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <select class="form-control  select_branch" name="branch">
                              @foreach ($branchDatas as $branchData)
                                 <option value="{{ $branchData->id }}" <?php if($first_data->branch_id==$branchData->id){ echo "selected"; }?>>{{$branchData->branch_name }}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <div class="items">
                        @foreach($sec_data as $sec_datas)
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12 currency" for="expense_entry" style="padding:8px 0px 0px 0px;">{{trans('app.Expense Entry')}} (<?php echo getCurrencySymbols(); ?>)<label class="color-danger">*</label> </label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="hidden" name="autoid[]" value="{{ $sec_datas->id }}"/>
                              <input type="number" id="expense_entry" class="form-control text-input"  value="{{ $sec_datas->expense_amount }}" name="expense_entry[]" maxlength="10" placeholder="Expense Amount" required>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                           <label class="control-label col-md-3 col-sm-3 col-xs-12" for="expense_label">{{trans('app.Expense Label')}}</label>
                           <div class="col-md-9 col-sm-9 col-xs-12">
                              <input type="text" id="expense_label" class="form-control text-input"  value="{{ $sec_datas->label_expense }}" name="expense_label[]" maxlength="30" placeholder="Expense Entry Label">
                           </div>
                        </div>
                        @endforeach
                     </div>
                  </div>

                  <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                     <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <button type="button" id="add_new_entry" class="btn btn-primary add_button" name="add_new_entry" >{{ trans('app.Add More Fields')}}</button>
                     </div>
                  </div>

            <!-- Custom Filed data value -->
                  @if(!empty($tbl_custom_fields))  
                     <div class="col-md-12 col-xs-12 col-sm-12 space">
                        <h4><b>{{ trans('app.Custom Fields')}}</b></h4>
                        <p class="col-md-12 col-xs-12 col-sm-12 ln_solid"></p>
                     </div>
                     <?php
                        $subDivCount = 0;
                     ?>
                     @foreach($tbl_custom_fields as $myCounts => $tbl_custom_field)
                         <?php 
                           if($tbl_custom_field->required == 'yes')
                           {
                              $required = "required";
                              $red = "*";
                           }else{
                              $required = "";
                              $red = "";
                           }
                           
                           $tbl_custom = $tbl_custom_field->id;
                           $userid = $first_data->id;
                           $datavalue = getCustomDataExpenses($tbl_custom,$userid);

                           $subDivCount++;
                        ?>
                        @if($myCounts%2 == 0)
                           <div class="col-md-12 col-sm-6 col-xs-12">
                        @endif
                           <div class="form-group col-md-6  col-sm-6 col-xs-12 error_customfield_main_div_{{$myCounts}}">
                                 <label class="control-label col-md-4 col-sm-4 col-xs-12" for="account-no">{{$tbl_custom_field->label}} <label class="color-danger">{{$red}}</label></label>
                                 <div class="col-md-8 col-sm-8 col-xs-12">
                                    @if($tbl_custom_field->type == 'textarea')
                                       <textarea  name="custom[{{$tbl_custom_field->id}}]" class="form-control textarea_{{$tbl_custom_field->id}} textarea_simple_class common_simple_class common_value_is_{{$myCounts}}" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" maxlength="100" isRequire="{{$required}}" type="textarea" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" {{$required}}>{{$datavalue}}</textarea>

                                       <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display: none"></span>

                                    @elseif($tbl_custom_field->type == 'radio')
                                       <?php
                                          $radioLabelArrayList = getRadiolabelsList($tbl_custom_field->id)
                                       ?>
                                       @if(!empty($radioLabelArrayList))
                                       <div style="margin-top: 5px;">
                                          @foreach($radioLabelArrayList as $k => $val)
                                             <input type="{{$tbl_custom_field->type}}"  name="custom[{{$tbl_custom_field->id}}]" value="{{$k}}"    <?php
                                                   //$formName = "product";
                                                   $getRadioValue = getRadioLabelValueForUpdateForAllModules($tbl_custom_field->form_name ,$first_data->id, $tbl_custom_field->id);

                                                if($k == $getRadioValue) { echo "checked"; }?> 

                                             > {{ $val }} &nbsp;
                                          @endforeach    
                                          </div>                        
                                       @endif

                                    @elseif($tbl_custom_field->type == 'checkbox')
                                    <?php
                                          $checkboxLabelArrayList = getCheckboxLabelsList($tbl_custom_field->id)
                                       ?>
                                       @if(!empty($checkboxLabelArrayList))
                                          <?php
                                             $getCheckboxValue = getCheckboxLabelValueForUpdateForAllModules($tbl_custom_field->form_name, $first_data->id, $tbl_custom_field->id);
                                          ?>
                                          <div class="required_checkbox_parent_div_{{$tbl_custom_field->id}}" style="margin-top: 5px;">
                                          @foreach($checkboxLabelArrayList as $k => $val)
                                             <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}][]" value="{{$val}}" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" custm_isd="{{$tbl_custom_field->id}}" class="checkbox_{{$tbl_custom_field->id}} required_checkbox_{{$tbl_custom_field->id}} checkbox_simple_class common_value_is_{{$myCounts}} common_simple_class" rows_id="{{$myCounts}}"

                                             <?php
                                                if($val == getCheckboxValForAllModule($tbl_custom_field->form_name, $first_data->id, $tbl_custom_field->id,$val)) 
                                                      { echo "checked"; }
                                                ?>
                                             > {{ $val }} &nbsp;
                                          @endforeach
                                             <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display: none"></span>
                                          </div>               
                                       @endif                        
                                    @elseif($tbl_custom_field->type == 'textbox')
                                       <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}]" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" value="{{$datavalue}}" maxlength="30" class="form-control textDate_{{$tbl_custom_field->id}} textdate_simple_class common_value_is_{{$myCounts}} common_simple_class" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" {{$required}}>

                                       <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display:none"></span>

                                    @elseif($tbl_custom_field->type == 'date')
                                       <input type="{{$tbl_custom_field->type}}" name="custom[{{$tbl_custom_field->id}}]" placeholder="{{ trans('app.Enter')}} {{$tbl_custom_field->label}}" value="{{$datavalue}}" maxlength="30" class="form-control textDate_{{$tbl_custom_field->id}} date_simple_class common_value_is_{{$myCounts}} common_simple_class" isRequire="{{$required}}" fieldNameIs="{{ $tbl_custom_field->label }}" rows_id="{{$myCounts}}" onkeydown="return false" {{$required}}>

                                       <span id="common_error_span_{{$myCounts}}" class="help-block error-help-block color-danger" style="display:none"></span>
                                    @endif
                                 </div>
                              </div>
                        @if($myCounts%2 != 0)
                           </div>
                        @endif
                     @endforeach
                     <?php 
                        if ($subDivCount%2 != 0) {
                           echo "</div>";
                        }
                     ?>
                  @endif
            <!-- Custom Filed data value End-->
                  
                  <input type="hidden" name="_token" value="{{csrf_token()}}">
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                     <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <a class="btn btn-primary" href="{{ URL::previous() }}">{{ trans('app.Cancel')}}</a>
                        <button type="submit" class="btn btn-success updateExpenseButton">{{ trans('app.Update')}}</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>

         <!-- Add More Field Button call from here to create new Textbox (Start) -->
         <div class="hide copy">
            <div class="remove_fields">
               <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group my-form-group" style="padding-left:0px;">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12 currency" style="padding:8px 0px 0px 0px" for="expense_entry">{{trans('app.Expense Entry')}} (<?php echo getCurrencySymbols(); ?>)<label class="color-danger">*</label> 
                     </label>
                     <div class="col-md-9 col-sm-9 col-xs-12">
                        <!-- <input type="text" id="expense_entry" class="form-control text-input SetSizeAddExpenseEntryTextBox"  value="" name="expense_entry[]" maxlength="10" placeholder="Expense Amount" required> -->

                        <input type="number" id="expense_entry" class="form-control text-input SetSizeAddExpenseEntryTextBox extraExtenseTextbox" value="0" name="expense_entry[]" maxlength="10" placeholder="{{ trans('app.Expense Amount')}}" required>
                     </div>
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12 form-group givePaddingToDiv">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12 expenseLabel" for="expense_label">{{trans('app.Expense Label')}}</label>
                     <div class="col-md-7 col-sm-7 col-xs-12">
                        <input type="text" id="expense_label" class="form-control text-input SetSizeAddExpenseLabelTextBox" value="" name="expense_label[]" maxlength="30" placeholder="Expense Entry Label">
                     </div>
                     <div class="col-sm-2 col-xs-2 addmoredelete">
                        <button type="button" class="btn btn-primary del deleteButton" style="margin-top:0;">{{ trans('app.Delete')}}
                        </button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Add More Field Button call from here to create new Textbox (End) -->
      </div>
   </div>
</div>
<!-- /page content -->


<!-- Scripts starting -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{ URL::asset('build/js/jquery.min.js') }}"></script>
<script src="{{ URL::asset('vendors/moment/min/moment.min.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ URL::asset('vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>

<script>
$(document).ready(function() 
{
   
   /*JQuery for create extra textbox and extra textbox also remove*/
   $(".add_button").click(function(){ 
      var html = $(".copy").html();
      $(".items").after(html);
   });

   
   $("body").on("click",".del",function(){ 
      $(this).parents('.remove_fields').remove();
   });


   /*datetimepicker*/
   $('.datepicker').datetimepicker({
      format: "<?php echo getDatepicker(); ?>",
      autoclose: 1,
      minView: 2,
   });



   /*If select box have value then error msg and has error class remove*/
   $('body').on('change','.expenseDate',function(){

      var dateValue = $(this).val();

      if (dateValue != null) {
         $('#outdate_gatepass-error').css({"display":"none"});
      }

      if (dateValue != null) {
         $(this).parent().parent().removeClass('has-error');
      }
   });



   $('body').on('keyup', '.mainLabel', function(){

      var mainLabelName = $(this).val();

      if (!mainLabelName.replace(/\s/g, '').length) {
         $(this).val("");
      }
   });

   $('body').on('keyup', '.extraExtenseTextbox', function(){

      var extraexpenseVal = $(this).val();

      if (!extraexpenseVal.replace(/\s/g, '').length) {
         $(this).val(0);
      }
   });


   /*Custom Field manually validation*/
   var msg31 = "{{ trans('app.field is required')}}";
   var msg32 = "{{ trans('app.Only blank space not allowed')}}";
   var msg33 = "{{ trans('app.Special symbols are not allowed.')}}";
   var msg34 = "{{ trans('app.At first position only alphabets are allowed.')}}";

   /*Form submit time check validation for Custom Fields */
   $('body').on('click','.updateExpenseButton',function(e){
      $('#expenseEditForm input, #expenseEditForm select, #expenseEditForm textarea').each(

          function(index)
          {  
              var input = $(this);

              if (input.attr('name') == "main_label" || input.attr('name') == "status" || input.attr('name') == "date") {
               if (input.val() == "") {
                  return true;
               }
               else{
                  return true;
               }        
              }
              else if (input.attr('isRequire') == 'required')
              {   
               var rowid = (input.attr('rows_id'));
                 var labelName = (input.attr('fieldnameis'));
               
               if (input.attr('type') == 'textbox' || input.attr('type') == 'textarea')
               {              
                  if (input.val() == '' || input.val() == null) 
                  {           
                     $('.common_value_is_'+rowid).val("");
                     $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
                     $('#common_error_span_'+rowid).css({"display":""});
                     $('.error_customfield_main_div_'+rowid).addClass('has-error');
                     e.preventDefault();
                     return false;
                  }
                  else if (!input.val().replace(/\s/g, '').length) 
                  {
                     $('.common_value_is_'+rowid).val("");
                     $('#common_error_span_'+rowid).text(labelName + " : " + msg32);
                     $('#common_error_span_'+rowid).css({"display":""});
                     $('.error_customfield_main_div_'+rowid).addClass('has-error');
                     e.preventDefault();  
                     return false;
                  }
                  else if(!input.val().match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/))
                  {
                     $('.common_value_is_'+rowid).val("");
                     $('#common_error_span_'+rowid).text(labelName + " : " + msg33);
                     $('#common_error_span_'+rowid).css({"display":""});
                     $('.error_customfield_main_div_'+rowid).addClass('has-error');
                     e.preventDefault();  
                     return false;
                  }
               }
               else if (input.attr('type') == 'checkbox') 
               {
                  var ids = input.attr('custm_isd');
                  if($(".required_checkbox_" + ids).is(':checked'))
                  {
                     $('#common_error_span_'+rowid).css({"display":"none"});
                     $('.error_customfield_main_div_'+rowid).removeClass('has-error');
                     $('.required_checkbox_parent_div_'+ids).css({"color":""});
                     $('.error_customfield_main_div_'+rowid).removeClass('has-error');
                  }
                  else
                  {
                     $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
                     $('#common_error_span_'+rowid).css({"display":""});
                     $('.error_customfield_main_div_'+rowid).addClass('has-error');
                     $('.required_checkbox_'+ids).css({"outline":"2px solid #a94442"});
                     $('.required_checkbox_parent_div_'+ids).css({"color":"#a94442"});
                     e.preventDefault();  
                     return false;
                  }              
               }
               else if (input.attr('type') == 'date') 
               {
                  if (input.val() == '' || input.val() == null) 
                  {  
                     $('.common_value_is_'+rowid).val("");
                     $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
                     $('#common_error_span_'+rowid).css({"display":""});
                     $('.error_customfield_main_div_'+rowid).addClass('has-error');
                     e.preventDefault();  
                     return false;
                  }
                  else
                  {
                     $('#common_error_span_'+rowid).css({"display":"none"});
                     $('.error_customfield_main_div_'+rowid).removeClass('has-error'); 
                  }
               }
            } 
            else if (input.attr('isRequire') == "")
            {
               //Nothing to do
            }
          }
      );
   });


   /*Anykind of input time check for validation for Textbox, Date and Textarea*/
   $('body').on('keyup','.common_simple_class',function(){

      var rowid = $(this).attr('rows_id');      
        var valueIs = $('.common_value_is_'+rowid).val();
        var requireOrNot = $('.common_value_is_'+rowid).attr('isrequire');
        var labelName = $('.common_value_is_'+rowid).attr('fieldnameis');
        var inputTypes = $('.common_value_is_'+rowid).attr('type');
      
      if (requireOrNot != "") 
      {
         if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') 
          {
            if (valueIs == "") 
            {
               $('.common_value_is_'+rowid).val("");
               $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
               $('#common_error_span_'+rowid).css({"display":""});
               $('.error_customfield_main_div_'+rowid).addClass('has-error');
            }
            else if (valueIs.match(/^\s+/))
            {
               $('.common_value_is_'+rowid).val("");
               $('#common_error_span_'+rowid).text(labelName + " : " + msg34);
               $('#common_error_span_'+rowid).css({"display":""});
               $('.error_customfield_main_div_'+rowid).addClass('has-error');
            }
            else if(!valueIs.match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/))
            {
               $('.common_value_is_'+rowid).val("");
               $('#common_error_span_'+rowid).text(labelName + " : " + msg33);
               $('#common_error_span_'+rowid).css({"display":""});
               $('.error_customfield_main_div_'+rowid).addClass('has-error');
            }
            else
            {
               $('#common_error_span_'+rowid).css({"display":"none"});
               $('.error_customfield_main_div_'+rowid).removeClass('has-error');
            }
          }
          else if (inputTypes == 'date')
          {
            if (valueIs != "") 
            {
               $('#common_error_span_'+rowid).css({"display":"none"});
               $('.error_customfield_main_div_'+rowid).removeClass('has-error');
            }
            else
            {
               $('.common_value_is_'+rowid).val("");
               $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
               $('#common_error_span_'+rowid).css({"display":""});
               $('.error_customfield_main_div_'+rowid).addClass('has-error');             
            }
          }
          else
          {
            //alert("Yes i am radio and checkbox");
          }
      }
      else
      {
         if (inputTypes != 'radio' && inputTypes != 'checkbox' && inputTypes != 'date') 
          {
            if (valueIs != "") 
            {
               if (valueIs.match(/^\s+/))
               {
                  $('.common_value_is_'+rowid).val("");
                  $('#common_error_span_'+rowid).text(labelName + " : " + msg34);
                  $('#common_error_span_'+rowid).css({"display":""});
                  $('.error_customfield_main_div_'+rowid).addClass('has-error');
               }
               else if(!valueIs.match(/^[a-zA-Z\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F][a-zA-Z0-9\u0621-\u064A\u00C0-\u017F\u0600-\u06FF\u0750-\u077F\uFB50-\uFDFF\uFE70-\uFEFF\u2E80-\u2FD5\u3190-\u319f\u3400-\u4DBF\u4E00-\u9FCC\uF900-\uFAAD\u0900-\u097F\s\.\-\_]*$/))
               {
                  $('.common_value_is_'+rowid).val("");
                  $('#common_error_span_'+rowid).text(labelName + " : " + msg33);
                  $('#common_error_span_'+rowid).css({"display":""});
                  $('.error_customfield_main_div_'+rowid).addClass('has-error');
               }
               else
               {
                  $('#common_error_span_'+rowid).css({"display":"none"});
                  $('.error_customfield_main_div_'+rowid).removeClass('has-error');
               }
            }
            else
            {
               $('#common_error_span_'+rowid).css({"display":"none"});
               $('.error_customfield_main_div_'+rowid).removeClass('has-error');
            }
          }
      }
   });


   /*For required checkbox checked or not*/
   $('body').on('click','.checkbox_simple_class',function(){

      var rowid = $(this).attr('rows_id');      
        var requireOrNot = $('.common_value_is_'+rowid).attr('isrequire');
        var labelName = $('.common_value_is_'+rowid).attr('fieldnameis');
        var inputTypes = $('.common_value_is_'+rowid).attr('type');
        var custId = $('.common_value_is_'+rowid).attr('custm_isd');

      if (requireOrNot != "") 
      {
         if($(".required_checkbox_" + custId).is(':checked'))
         {           
            $('.required_checkbox_'+custId).css({"outline":""});
            $('.required_checkbox_'+custId).css({"color":""});
            $('#common_error_span_'+rowid).css({"display":"none"});
            $('.required_checkbox_parent_div_'+custId).css({"color":""});
            $('.error_customfield_main_div_'+rowid).removeClass('has-error');
         }
         else
         {
            $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
            $('.required_checkbox_'+custId).css({"outline":"2px solid #a94442"});
            $('.required_checkbox_'+custId).css({"color":"#a94442"});
            $('#common_error_span_'+rowid).css({"display":""});
            $('.required_checkbox_parent_div_'+custId).css({"color":"#a94442"});
            $('.error_customfield_main_div_'+rowid).addClass('has-error');
         }
      }
   });



   $('body').on('change','.date_simple_class',function(){
      
      var rowid = $(this).attr('rows_id');
      var valueIs = $('.common_value_is_'+rowid).val();
        var requireOrNot = $('.common_value_is_'+rowid).attr('isrequire');
        var labelName = $('.common_value_is_'+rowid).attr('fieldnameis');
        var inputTypes = $('.common_value_is_'+rowid).attr('type');
        var custId = $('.common_value_is_'+rowid).attr('custm_isd');

      if (requireOrNot != "") 
      {
         if (valueIs != "") 
         {
            $('#common_error_span_'+rowid).css({"display":"none"});
            $('.error_customfield_main_div_'+rowid).removeClass('has-error');
         }
         else
         {
            $('#common_error_span_'+rowid).text(labelName + " : " + msg31);
            $('#common_error_span_'+rowid).css({"display":""});
            $('.error_customfield_main_div_'+rowid).addClass('has-error');
         }
      }
   });
});
</script>

<!-- Form field validation -->
{!! JsValidator::formRequest('App\Http\Requests\StoreExpenseAddEditFormRequest', '#expenseEditForm'); !!}
<script type="text/javascript" src="{{ asset('public/vendor/jsvalidation/js/jsvalidation.js') }}"></script>

@endsection