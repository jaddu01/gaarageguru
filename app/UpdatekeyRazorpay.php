<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class UpdatekeyRazorpay extends Model
{
    //For 
	protected $table = 'updatekey_razorpay';

	protected $fillable = ['razorpay_id','secret_key','publish_key'];
}
