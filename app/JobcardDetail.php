<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class JobcardDetail  extends Model
{
    //For
	protected $table = 'tbl_jobcard_details';
	protected $fillable = ["out_date", "service_id", "jocard_no", "customer_id", "vehicle_id", "in_date","delay_date","kms_run","done_status","coupan_no","soft_delete"];
}
