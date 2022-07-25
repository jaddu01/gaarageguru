<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Service extends Model
{
    //For
	protected $table = 'tbl_services';
	protected $fillable = ["job_no","service_type","sales_id","service_date","full_date","title","assign_to","service_category","done_status"
    ,"charge","customer_id","vehicle_id","detail","employee_status","is_appove","custom_field","mot_status","soft_delete","is_quotation","quotation_modify_status","tax_id",
        "branch_id"];
}
