<select class="form-control form-select" aria-label="Default select example" id="vehical_brand2" name="vehical_brand" placeholder="Model" required>
                                									<option selected="">Select Model Type</option>
                                									<?php if(!empty($vehical_brand)){ foreach($vehical_brand as $row){?>
                                									<option value="{{$row->id}}">{{$row->vehicle_brand}}</option>
                                									<?php } 
                                									}?>
                                								
                                								</select>