<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Validator;
use App\User;
use App\Vehicle;
use App\Service;
use App\Product;
use App\JobcardDetail;
use App\Sale;
use App\MailNotification;
use App\tbl_mail_notifications;
use App\Holiday;
use App\Branch;
use App\BranchSetting;
use Hash;
use Auth;
use DB;
use App\tbl_sales;
use App\tbl_colors;
use App\tbl_vehicles;
use App\tbl_services;
use App\tbl_rto_taxes;

use App\tbl_sales_taxes;




use App\CustomField;
use App\Role;
use App\Role_user;
use App\Helpers;
use Config;
use Session;
use URL;
use Mail;
use Redirect;
use View;
use Input,Response;

class homeController extends Controller {


	public function index()
	{
	   try{
			$title = "gaarageguru";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("auth.login",compact('title'));
	}

	public function aboutUs()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("home.about-us",compact('title'));
	}

	public function service()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("home.service",compact('title'));
	}


	public function contactUs()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("home.contact-us",compact('title'));
	}

	public function career()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.career",compact('title'));
	}


	public function faq()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.faq",compact('title'));
	}


	public function returnPolicy()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.return-policy",compact('title'));
	}


	public function loginPost(Request $request)
    {

	    try{

	       $validator = Validator::make(
			Input::all(),
			array(

			'mobile_no'     => 'required|digits:10',
			)

		);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{

		            	  $userData = User::where('mobile_no',$request->mobile_no)->first();
		            	  $otp = $this->random_digits(6);
		            	   $mobile =  $request->mobile_no;


			            if(empty($userData)){
			                /*	$getRoleId = Role::where('role_name', '=', 'Customer')->first();
			                	$userData 					=  new User;
			                    $userData->mobile_no 			=  $request->mobile_no;
			                    $userData->otp 			=  $otp;
			                    $userData->password 			=  Hash::make($otp);
			                    $userData->role_id = $getRoleId->id;;
			                     $userData->role = 'Customer';
			                     $userData->image='avtar.png';
			                    $userData->save();
			                    $currentUserId = $userData->id;

			                    $role_user_table = new Role_user;
			                    $role_user_table->user_id = $currentUserId;
			                    $role_user_table->role_id  = $getRoleId->id;
			                    $role_user_table->save();*/
			                    $err				=	array();
							    $err['success']		=	2;
						    	$err['message']		= "This mobile number not register with us.";
						    	return Response::json($err);


			            }else{
			                 $ch = curl_init();
								// set URL and other appropriate options
							    $sms = "Gaarageguru your otp is ".$otp." From Gaarageguru";
							    $ms = rawurlencode($sms);
							     curl_setopt($ch, CURLOPT_URL, "http://text.easy2approach.com/api/pushsms?user=gaarageguru&authkey=924CacL18A0U&sender=GAGURU&mobile=".$mobile."&text=".$otp."+is+the+OTP+to+verify+your+support+contact+number+with+GAARAGE+GURU.+OTP+is+valid+till+%7B%23var%23%7D+IST.+Do+not+share+with+anyone.&rpt=1&summary=1&output=json&entityid=1201163981433020411&templateid=1207164318894837915");
						            //curl_setopt($ch, CURLOPT_HEADER, 0);
						        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							    	// grab URL and pass it to the browser
								    curl_exec($ch);

								// close cURL resource, and free up system resources
								curl_close($ch);

			                     $userData->mobile_no 			=  $request->mobile_no;
			                     $userData->otp 			=  $otp;
			                     $userData->password 			=  Hash::make($otp);
			                      //$userData->role_id = 2;
			                     $userData->save();
		               	}
		               	$response	=	array(
											'success' 	=>	1,
											'mobile' 	=>	$mobile,
											'user_id' 	=>	$userData->id,
											'message' 	=>	''
										);
							return Response::json($response);

            	}
		} catch (Exception $e) {
			      $responseType='error';
			    $responseMessage=$e->getError()->message;
			               	$err				=	array();
							$err['success']		=	2;
							$err['message']		=	$responseMessage;
							return Response::json($err);
		}

	}
	public function otpverifyPost(Request $request)
    {

	    $mobile = $request->mobile;
		$otp = $request->otp;
		$user_id = $request->user_id;
		$device_type = "web";
		$is_code_sent = 1;
	    try{
	       $validator = Validator::make(
			Input::all(),
			array(

			'otp'     => 'required|digits:6',
			)

		);
	    if ($validator->fails()) {
		    $errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	    }else{

			                if(Auth::attempt(['mobile_no' =>$mobile, 'otp' => $otp,'password'=>$otp])){
								$userArray = Auth::user();
								$userArray->otp= "";

								$userArray->password= "";
								$userArray->save();
									$response	=	array(
											'success' 	=>	1,
											'message' 	=>	'Login successfully.'
										);
						        	return Response::json($response);

				            }else{
					                	$err				=	array();
						                $err['success']		=	2;
							            $err['message']		=	"Invalid otp";
							            return Response::json($err);
				            }

            	}
		} catch (Exception $e) {
			$responseType='error';
			$responseMessage=$e->getError()->message;
			$err				=	array();
							$err['success']		=	2;
							$err['message']		=	$responseMessage;
							return Response::json($err);
		}

	}

	public function resendOtp(Request $request)
    {
	   $mobile = $request->mobile;

	    try{
				                $otp =$this->random_digits(6);
		            	        $mobile =  $request->mobile;

		            	        $ch = curl_init();
								// set URL and other appropriate options
							    $sms = "Gaarageguru your otp is ".$otp." From Gaarageguru";
							    $ms = rawurlencode($sms);
							     curl_setopt($ch, CURLOPT_URL, "http://text.easy2approach.com/api/pushsms?user=gaarageguru&authkey=924CacL18A0U&sender=GAGURU&mobile=".$mobile."&text=".$otp."+is+the+OTP+to+verify+your+support+contact+number+with+GAARAGE+GURU.+OTP+is+valid+till+%7B%23var%23%7D+IST.+Do+not+share+with+anyone.&rpt=1&summary=1&output=json&entityid=1201163981433020411&templateid=1207164318894837915");
						            //curl_setopt($ch, CURLOPT_HEADER, 0);
						        	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							    	// grab URL and pass it to the browser
								    curl_exec($ch);

								// close cURL resource, and free up system resources
								curl_close($ch);
					$userData = User::where('mobile_no',$request->mobile)->first();
				  if($userData){
				        $userData->otp = $otp;
				        $userData->save();
					    $response	=	array(
											'success' 	=>	1,
											'message' 	=>	'Otp Sent'
										);
							return Response::json($response);
				  }else{
					  $response	=	array(
											'success' 	=>	2,
											'message' 	=>	''
										);
							return Response::json($response);
				  }
					/*
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"You already purchase this plan.";
							return Response::json($err);	*/


		} catch (Exception $e) {
			$responseType='error';
			$responseMessage=$e->getError()->message;
		}

	}
	function random_digits($length=6)
{
	$random= "";
	$data = "0123456789";
	for($i = 0; $i < $length; $i++)
	{
		 $random .= substr($data, (rand()%(strlen($data))), 1);
	}
	return $random;
}
public function signupPost2(Request $request)
{
	Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
	$validator = Validator::make(
			Input::all(),
			array(
				'email' 						=> 'required|email|unique:users',
				'country_code'					=> 'required',
				'type'					=> 'required',
				//'name'					=> 'required|max:50',
				'first_name'					=> 'required|max:50',
				'last_name'						=> 'required|max:50',
				'mobile' 						=> 'required|numeric|digits_between:8,12|unique:users',
				'password'						=> 'required|min:8|custom_password',
				'confirm_password' 	 			=> 'required|min:8|same:password',
				//'image' 						=> 'mimes:'.IMAGE_EXTENSION,
			),array("password.custom_password"	=>	"Password must have be a combination of numeric, alphabet and special characters.",
			)

		);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		$r = 0;

		$email 			=  $request->input('email');
		$password 		=  $request->input('password');
		$country_code 	=  $request->input('country_code');
		$mobile 		=  $request->input('mobile');
		//$first_name 	=  $request->input('name');
		///$invite_code 		=  $request->input('invite_code');

		if($r == 0){

			$user 					=  new User;
			$otp = $this->random_digits(6);

			$user->mobile 			=  Input::get('mobile');
			$user->email 			=  Input::get('email');
			//$user->slug	 			=  $this->getSlug(Input::get('first_name')." ".Input::get('last_name'),'full_name','User');
			$user->password	 		=  Hash::make(Input::get('password'));
			$user->country_code 	=  Input::get('country_code');
			$user->first_name		=  !empty($request->input('first_name')) ? $request->input('first_name') : '';
			$user->last_name		=  !empty($request->input('last_name')) ? $request->input('last_name') : '';
			$user->type				=	Input::get('type');
			$user->uniq_id 			= uniqid();
			//$user->invite_code 		=	Input::get('invite_code') ? Input::get('invite_code') : '';
			//$user->terms_and_condition 		=	Input::get('terms_and_condition') ? Input::get('terms_and_condition') : 0;
			//$user->referral_code 	=	$this->random_referral_code(6);
			$user->otp 				=	$otp;
			$user->otp_verify 		=	'yes';
			$user->email_verify 		=	'yes';
			//$user->is_verified 		=	'yes';
			$user->is_notification 	='1';
			$user->device_type 		='website';
			$user->status 			='1';
			$validateString			=  md5(time() . Input::get('email'));
			$user->validate_string	=  $validateString;

			$user->is_verified		=  1;
			//$obj->is_active			=  1;
			$user->save();

			$emailData = Emailtemplates::where('slug','=','user-registration')->first();
							$settingsEmail 		= Config::get("Site.email");
							$full_name = $user->first_name;
						 /* if($emailData){ //echo 'asd'; die;
							$messageBody = $emailData->description;
							$subject = $emailData->subject;
							//$user->subject = $emailData->subject;
							//$user->from = 'dinesh.singh@octalinfosolution.com';
							//$activate_url =\App::make('url')->to("user-account-activate/".$user->validate_string);
							$activate_url = \App::make('url')->to('/user-account-activate')."/".$user->validate_string;

							if($user->email!='')
							{
								$messageBody = str_replace(array('{USERNAME}','{{ACTIVE_URL}}'), array($user->first_name,$activate_url),$messageBody);
								$this->sendMail($user->email,$full_name,$subject,$messageBody,$settingsEmail);
							}

						}*/

				$response	=	array(
				'success' 	=>	'1',
				'user_id'	=>	base64_encode($user->id),
				'message' 	=>	'Registration Success. Please Login.'
			);
			return Response::json($response);
		} else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Invalid Invite code.";
							return Response::json($err);
		}

	}
}


	public function privacyPolicy()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.privacy-policy",compact('title'));
	}

	public function terms()
	{
	   try{
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.terms-conditions",compact('title'));
	}


	public function courseDetail($id = null)
	{
	   try{
			 $id = base64_decode($id);
			$package = Package::where('status',1)->where('is_deleted',0)->where('id',$id)->first();
			$title = "";

			}catch (\Exception $e) {
				$responseType='error';
				$responseMessage=$e->getMessage();
			}
		return  View::make("front.home.course-detail",compact('title','package'));
	}

	/**
	 * Function to display contact us page
	 *
	 * @param null
	 *
	 * @return view page
	 */
	public function storeContact(Request $request){
	//	Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();

			$validator = Validator::make(
					Input::all(),
					array(
						'email' 						=> 'required|email',
						'full_name'					=> 'required',
							'phone_number'					=> 'required|numeric',
								'service'					=> 'required',


						'message'					=> 'required',
					)
				);
			if ($validator->fails()) {
				$errors 	=	$validator->messages();
					$response	=	array(
						'success' 	=> false,
						'errors' 	=> $errors
					);
					return Response::json($response);
					die;
			}else{
				$date = date("Y-m-d H:i:s");
				$userData = User::where('mobile_no',$request->phone_number)->first();
				if(empty($userData)){
				    	$getRoleId = Role::where('role_name', '=', 'Customer')->first();
				                $userData 					=  new User;
			                    $userData->mobile_no 			=  $request->phone_number;
			                    $userData->email 			=  $request->email;
			                    $userData->name 			=  $request->full_name;
			                    $userData->role_id = $getRoleId->id;;
			                     $userData->role = 'Customer';
			                     $userData->image='avtar.png';
			                    $userData->save();
			                     $currentUserId = $userData->id;

			                    $role_user_table = new Role_user;
			                    $role_user_table->user_id = $currentUserId;
			                    $role_user_table->role_id  = $getRoleId->id;
			                    $role_user_table->save();



				}
				DB::table('bookings')->insert(
					array(
						'full_name'			=>  $request->input('full_name'),
						'email' 		=>  $request->input('email'),
						'mobile_no' 		=>  $request->input('phone_number'),
						'service' 		=>  $request->input('service'),
						'message' 		=>  $request->input('message'),
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);
				$email = $request->input('email');
				if(!is_null($email ))
		{
			//email format
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;

			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','contact_us')->first();
			if($emailformats->is_send == 0)
			{

					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','contact_us')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;
					$to = 'gaarageguru2021@gmail.com';
					$email = $request->input('email');
					$phone_number = $request->input('phone_number');
					$service = $request->input('service');
					$message = $request->input('message');

					//$search1 = array('{ system_name }');
					//$replace1 = array($systemname);
					$mail_sub =$mail_subjects;


					$search = array('{ system_name }','{ NAME }', '{ EMAIL }', '{ MOBILE }', '{ MESSAGE }', '{ SERVICE }' );
					$replace = array($systemname,$request->input('full_name'), $email, $phone_number, $message, $service);

					$email_content = str_replace($search, $replace, $mail_format);

					$actual_link = $_SERVER['HTTP_HOST'];
					$startip='0.0.0.0';
					$endip='255.255.255.255';
					if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <=$endip ))
					{
						//local format email
						$data=array(
						'email'=>$email,
						'mail_sub1' => $mail_sub,
						'email_content1' => $email_content,
						'emailsend' =>$mail_send_from,
						);
							$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

							$message->from($data['emailsend'],'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
					}
					else
					{
						//Live format email
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:'. $mail_send_from . "\r\n";

						$data = mail($to,$mail_sub,$email_content,$headers);
					}

		 	}
		}
				//send email to site admin with user information,to inform that user wants to contact
				/*$emailTemplates		=  EmailTemplate::where('action','=','contact_us')->get()->toArray();
				$cons 				=  explode(',',$emailActions[0]['options']);
				$constants 			=  array();

				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}

				$name			= $allData['data']['name'];
				$email			= $allData['data']['email'];
				$message		= $allData['data']['message'];
				$phone			= $allData['data']['phone'];

				$subject 		= $emailTemplates[0]['subject'];
				$rep_Array 		= array($name,$email,$phone,$message);
				$messageBody	= str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

				$settingsEmail = Config::get("Site.contact_email");

				$this->sendMail(Config::get("Site.contact_email"),'Admin',$subject,$messageBody,$settingsEmail);
				*/
				$response	=	array(
				'success' 	=>	'1',
				'message' 	=>	'Message Send Successfully.'
			);
			return Response::json($response);
			}


	}//end contactUs()

		public function storeBooking(Request $request){
	//	Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();

			$validator = Validator::make(
					Input::all(),
					array(
						//'email' 						=> 'required|email',
						//'full_name'					=> 'required',
                        'mobile_no'					=> 'required|numeric',
						'vehical_number'			=> 'required',
   					    'service'					=> 'required',
						'vehical_type'				=> 'required',
					)
				);
			if ($validator->fails()) {
				$errors 	=	$validator->messages();
					$response	=	array(
						'success' 	=> false,
						'errors' 	=> $errors
					);
					return Response::json($response);
					die;
			}else{
				$date = date("Y-m-d H:i:s");
				$userData = User::where('mobile_no',$request->mobile_no)->first();
				if(empty($userData)){
				    	$getRoleId = Role::where('role_name', '=', 'Customer')->first();
				                $userData 					=  new User;
			                    $userData->mobile_no 			=  $request->mobile_no;
			                    $userData->email 			=  $request->email;
			                    $userData->name 			=  $request->full_name;
			                   $userData->role_id = $getRoleId->id;;
			                     $userData->role = 'Customer';
			                     $userData->image='avtar.png';
			                    $userData->save();
			                     $currentUserId = $userData->id;

			                    $role_user_table = new Role_user;
			                    $role_user_table->user_id = $currentUserId;
			                    $role_user_table->role_id  = $getRoleId->id;
			                    $role_user_table->save();


				}
				DB::table('bookings')->insert(
					array(
						'full_name'			=>  $request->input('full_name'),
						'email' 		=>  $request->input('email'),
							'mobile_no' 		=>  $request->input('mobile_no'),
						'vehical_number' 		=>  $request->input('vehical_number'),
						//'model_number' 		=>  $request->input('model_number'),
						'vehical_type' 		=>  $request->input('vehical_type'),
						'vehicle_brand' 		=>  $request->input('vehicle_brand'),
						'service' 		=>  $request->input('service'),
						'repair_work' 		=> !empty( $request->input('repair_work')) ?  $request->input('repair_work') : '',
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);
				$email = $request->input('email');
				if(!is_null($email))
		{
			//email format
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;

			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','booking')->first();
			if($emailformats->is_send == 0)
			{

					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','booking')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;

					$to = 'gaarageguru2021@gmail.com';
					$email = $request->input('email');
					$mobile_no = $request->input('mobile_no');
					$vehical_number = $request->input('vehical_number');
					$model_type = $request->input('model_type');
					$service = $request->input('service');

					//$search1 = array('{ system_name }');
					//$replace1 = array($systemname);
					$mail_sub =$mail_subjects;


					$search = array('{ system_name }','{ NAME }', '{ EMAIL }', '{ MOBILE }',  '{ SERVICE }',  '{ vehical_number }',  '{ model_type }' );
					$replace = array($systemname,$request->input('full_name'), $email, $mobile_no, $service, $vehical_number, $model_type );

					$email_content = str_replace($search, $replace, $mail_format);

					$actual_link = $_SERVER['HTTP_HOST'];
					$startip='0.0.0.0';
					$endip='255.255.255.255';
					if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <=$endip ))
					{
						//local format email
						$data=array(
						'email'=>$email,
						'mail_sub1' => $mail_sub,
						'email_content1' => $email_content,
						'emailsend' =>$mail_send_from,
						);
							$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

							$message->from($data['emailsend'],'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
					}
					else
					{
						//Live format email
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:'. $mail_send_from . "\r\n";

						$data = mail($to,$mail_sub,$email_content,$headers);
					}

		 	}
		}

				//send email to site admin with user information,to inform that user wants to contact
			   /*	$emailTemplates		=  EmailTemplate::where('action','=','contact_us')->get()->toArray();
				$cons 				=  explode(',',$emailActions[0]['options']);
				$constants 			=  array();

				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}

				$name			= $allData['data']['name'];
				$email			= $allData['data']['email'];
				$message		= $allData['data']['message'];
				$phone			= $allData['data']['phone'];

				$subject 		= $emailTemplates[0]['subject'];
				$rep_Array 		= array($name,$email,$phone,$message);
				$messageBody	= str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

				$settingsEmail = Config::get("Site.contact_email");

				$this->sendMail(Config::get("Site.contact_email"),'Admin',$subject,$messageBody,$settingsEmail);
				 */
				$response	=	array(
				'success' 	=>	'1',
				'message' 	=>	'Booking Send Successfully.'
			);
			return Response::json($response);
			}


	}//end storeEnquire()
	public function joinTheTeam(Request $request){
	//	Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();

			$validator = Validator::make(
					Input::all(),
					array(
						'location' 						=> 'required',
						'name'					=> 'required',
							'mobile_no'					=> 'required',
						'pin_code'					=> 'required|numeric',

					)
				);
			if ($validator->fails()) {
				$errors 	=	$validator->messages();
					$response	=	array(
						'success' 	=> false,
						'errors' 	=> $errors
					);
					return Response::json($response);
					die;
			}else{
				$date = date("Y-m-d H:i:s");
				DB::table('join_the_teams')->insert(
					array(
						'name'			=>  $request->input('name'),
							'mobile_no' 		=>  $request->input('mobile_no'),
						'location' 		=>  $request->input('location'),
						'mobile_no' 		=>  $request->input('mobile_no'),
						'pin_code' 		=>  $request->input('pin_code'),
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);
				$email = 'mohan@mailinator.com';
				if(!is_null($email))
		{
			//email format
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;

			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','join_the_team')->first();
			if($emailformats->is_send == 0)
			{

					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','join_the_team')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;

					$to = 'gaarageguru2021@gmail.com';
					$email = $request->input('email');
					$mobile_no = $request->input('mobile_no');
					$location = $request->input('location');
					$pin_code = $request->input('pin_code');


					//$search1 = array('{ system_name }');
					//$replace1 = array($systemname);
					$mail_sub =$mail_subjects;


					$search = array('{ system_name }','{ NAME }',  '{ MOBILE }',  '{ LOCATION }',  '{ PINCODE }' );
					$replace = array($systemname,$request->input('name'), $mobile_no, $location,  $pin_code );

					$email_content = str_replace($search, $replace, $mail_format);

					$actual_link = $_SERVER['HTTP_HOST'];
					$startip='0.0.0.0';
					$endip='255.255.255.255';
					if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <=$endip ))
					{
						//local format email
						$data=array(
						'email'=>$email,
						'mail_sub1' => $mail_sub,
						'email_content1' => $email_content,
						'emailsend' =>$mail_send_from,
						);
							$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

							$message->from($data['emailsend'],'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
					}
					else
					{
						//Live format email
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:'. $mail_send_from . "\r\n";

						$data = mail($to,$mail_sub,$email_content,$headers);
					}

		 	}
		}

				//send email to site admin with user information,to inform that user wants to contact
			   /*	$emailTemplates		=  EmailTemplate::where('action','=','contact_us')->get()->toArray();
				$cons 				=  explode(',',$emailActions[0]['options']);
				$constants 			=  array();

				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}

				$name			= $allData['data']['name'];
				$email			= $allData['data']['email'];
				$message		= $allData['data']['message'];
				$phone			= $allData['data']['phone'];

				$subject 		= $emailTemplates[0]['subject'];
				$rep_Array 		= array($name,$email,$phone,$message);
				$messageBody	= str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

				$settingsEmail = Config::get("Site.contact_email");

				$this->sendMail(Config::get("Site.contact_email"),'Admin',$subject,$messageBody,$settingsEmail);
				 */
				$response	=	array(
				'success' 	=>	'1',
				'message' 	=>	'Join The Team Send Successfully.'
			);
			return Response::json($response);
			}


	}//end storeEnquire()

	public function vehical_brand($id = null) {
		$vehical_brand = DB::table('tbl_vehicle_brands')->where('vehicle_id',$id)->where('soft_delete',0)->get();
			return view('home.vehical_brand',["vehical_brand" => $vehical_brand]);
	}
		public function storeSupport(Request $request){
		Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();

			$validator = Validator::make(
					Input::all(),
					array(
						'mobile' 						=> 'required|numeric|digits_between:7,10',
						'category'					=> 'required',
					)
				);
			if ($validator->fails()) {
				$errors 	=	$validator->messages();
					$response	=	array(
						'success' 	=> false,
						'errors' 	=> $errors
					);
					return Response::json($response);
					die;
			}else{
				$date = date("Y-m-d H:i:s");
				DB::table('student_supports')->insert(
					array(
						'mobile'			=>  $request->input('mobile'),
						'category' 		=>  $request->input('category'),
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);

				//send email to site admin with user information,to inform that user wants to contact
				/*$emailTemplates		=  EmailTemplate::where('action','=','contact_us')->get()->toArray();
				$cons 				=  explode(',',$emailActions[0]['options']);
				$constants 			=  array();

				foreach($cons as $key=>$val){
					$constants[] = '{'.$val.'}';
				}

				$name			= $allData['data']['name'];
				$email			= $allData['data']['email'];
				$message		= $allData['data']['message'];
				$phone			= $allData['data']['phone'];

				$subject 		= $emailTemplates[0]['subject'];
				$rep_Array 		= array($name,$email,$phone,$message);
				$messageBody	= str_replace($constants, $rep_Array, $emailTemplates[0]['body']);

				$settingsEmail = Config::get("Site.contact_email");

				$this->sendMail(Config::get("Site.contact_email"),'Admin',$subject,$messageBody,$settingsEmail);
				*/
				$response	=	array(
				'success' 	=>	'1',
				'message' 	=>	'Message Send Successfully.'
			);
			return Response::json($response);
			}


	}
















	public function latlongbrowser(Request $request)
	{	   //return Input::get('lat1');
			//Session::put('searchAddress',Input::all());
			Session::put('searchAddress',Input::all());

	}
static function get_vehical()
{
	$data = DB::table('tbl_vehicle_types')->select('vehicle_type','id')->where('soft_delete',0)->get();

	return $data;
}
	public function login()
	{
		if (Auth::check())
		{
			return redirect('/');
		}else{
			return view('front.home.login');
		}
	}

	public function signup()
	{
		if (Auth::check())
		{
			return redirect('/');
		}else{
			return view('front.home.signup');
		}

	}
	public function otp_verify($id)
	{    $user_id = base64_decode($id);
		if (Auth::check())
		{
			return redirect('/');
		}else{
			return view('front.home.otp_verify',compact('user_id'));
		}

	}
	public function resend()
	{
		if (Auth::check())
		{
			return redirect('/');
		}else{
			return view('front.home.resend');
		}

	}
  public function signupStore()
	{
			return view('front.home.signupstore');
	}





public function accountactivate($id)
{

if ($id=="") {
	return redirect('/');
	}else{

			$id = base64_decode($id);
			$user =  User::find($id);

		if(!empty($user))
				{
			$user->email_verify = 'yes';
			$user->is_verified = 1;
			$user->save();
			// $signin_url = \App::make('url')->to("signin");

			//      $to=$userLogin->email;
			// 		  //$to="yogi.lalit2391@gmail.com";

			// 		$data = array( 'email' => $to ,'from' => 'info@sagrta.com', 'from_name' => 'SAG RTA', 'data' => array("signin_url"=>$signin_url,"status"=>$status));

			// 		Mail::send( 'pages.email.activateAccount',$data, function( $message ) use ($data)
			// 		{
			// 			$message->to( $data['email'] )->from( $data['from'], $data['from_name'] )->subject('SAG RTA Account Confirmation');

			// 		});
			Session::put('msg', '<strong class="alert alert-success"> Account Confirm successfully .</strong>');
				}else{

				Session::put('msg', '<strong class="alert alert-success"> Invalid Url .</strong>');

				}
	return redirect('/login');
}
}
public function accountactivateweb($validateString)
{
	if($validateString != "" && $validateString != null){
			$userDetail	=	User::where('validate_string',$validateString)->first();
			if(!empty($userDetail)){
				User::where('validate_string',$validateString)->update(array('validate_string'=>'',
				'is_verified'=>1));
				return Redirect::to('/')
						->with('success', "Your account verified successfully");
			}else{
				return Redirect::to('/')
						->with('error', "sorry you are using wrong link");
			}
		}else{
			return Redirect::to('/')->with('error',"sorry you are using wrong link");
		}

}

public function signin(Request $request)
{
	if (Auth::check())
	{
		return redirect('/myaccount');
	}else{
		if(!Session::has('reurl')){
		Session::put('reurl',"/myaccount");
		}
		return view('pages.signin');
	}
}


public function signupPost(Request $request)
{

	$validator = Validator::make(
			Input::all(),
			array(
				'email' 						=> 'nullable|email|unique:users',
				'name'					=> 'required',
				//'vehical_number'					=> 'required|numeric',
				//'model_number'						=> 'required|numeric',
				'mobile_no' 						=> 'required|numeric|digits_between:8,12|unique:users',
				//'password'						=> 'required|min:8',
				//'confirm_password' 	 			=> 'required|min:8|same:password',
			),array("password.custom_password"	=>	"Password must have be a combination of numeric, alphabet and special characters.",
			)

		);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		$r = 0;


		if($r == 0){
				$getRoleId = Role::where('role_name', '=', 'Customer')->first();
			$user 					=  new User;

			$user->mobile_no 			=  Input::get('mobile_no');
			$user->email 			=  Input::get('email');
			//$user->slug	 			=  $this->getSlug(Input::get('first_name')." ".Input::get('last_name'),'full_name','User');
			//$user->password	 		=  Hash::make(Input::get('password'));
			$user->name		=  !empty($request->input('name')) ? $request->input('name') : '';
		//	$user->vehical_number		=  !empty($request->input('vehical_number')) ? $request->input('vehical_number') : '';
			//$user->type				=	0;

			$user->status 			=1;

			$user->is_verified		=  0;
			 $user->role_id = $getRoleId->id;;
			                     $user->role = 'Customer';
			                     $user->image='avtar.png';
				$validateString			=  md5(time() . Input::get('email'));
			$user->validate_string	=  $validateString;
			$user->save();
			$currentUserId = $user->id;

			                    $role_user_table = new Role_user;
			                    $role_user_table->user_id = $currentUserId;
			                    $role_user_table->role_id  = $getRoleId->id;
			                    $role_user_table->save();

			$email =  Input::get('email');
			if(!is_null($email ))
		{
			//email format
			$logo = DB::table('tbl_settings')->first();
			$systemname = $logo->system_name;

			$emailformats = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
			if($emailformats->is_send == 0)
			{

					$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','User_registration')->first();
					$mail_format = $emailformat->notification_text;
					$mail_subjects = $emailformat->subject;
					$mail_send_from = $emailformat->send_from;
					$search1 = array('{ system_name }');
					$replace1 = array($systemname);
					$mail_sub = str_replace($search1, $replace1, $mail_subjects);
					$password = $this->random_digits(6);
					$systemlink = URL::to('/');
					$search = array('{ system_name }','{ user_name }', '{ email }', '{ Password }', '{ system_link }' );
					$replace = array($systemname,$request->input('name'), $email, $password, $systemlink);

					$email_content = str_replace($search, $replace, $mail_format);

					$actual_link = $_SERVER['HTTP_HOST'];
					$startip='0.0.0.0';
					$endip='255.255.255.255';
					if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <=$endip ))
					{
						//local format email
						$data=array(
						'email'=>$email,
						'mail_sub1' => $mail_sub,
						'email_content1' => $email_content,
						'emailsend' =>$mail_send_from,
						);
							$data1 = Mail::send('customer.customermail',$data, function ($message) use ($data){

							$message->from($data['emailsend'],'noreply');
							$message->to($data['email'])->subject($data['mail_sub1']);
						});
					}
					else
					{
						//Live format email
						$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
						$headers .= 'From:'. $mail_send_from . "\r\n";

						$data = mail($email,$mail_sub,$email_content,$headers);
					}

		 	}
		}
				$response	=	array(
				'success' 	=>	'1',
				'user_id'	=>	base64_encode($user->id),
				'message' 	=>	'Registration Success. Please Verify your email.'
			);
			return Response::json($response);
		} else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Invalid Invite code.";
							return Response::json($err);
		}

	}
}

public function sendMail($to,$fullName,$subject,$messageBody, $from = '',$files = false,$path='',$attachmentName='') {
		$data				=	array();
		$data['to']			=	$to;
		$data['from']		=	(!empty($from) ? $from : 'dinesh.singh@octalinfosolution.com');
		$data['fullName']	=	$fullName;
		$data['subject']	=	$subject;
		$data['filepath']	=	$path;
		$data['attachmentName']	=	$attachmentName;
		if($files===false){
			Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
				$message->to($data['to'], $data['fullName'])->from($data['from'])->subject($data['subject']);

			});
		}else{
			if($attachmentName!=''){
				Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
					$message->to($data['to'], $data['fullName'])->from($data['from'])->subject($data['subject'])->attach($data['filepath'],array('as'=>$data['attachmentName']));
				});
			}else{
				Mail::send('emails.template', array('messageBody'=> $messageBody), function($message) use ($data){
					$message->to($data['to'], $data['fullName'])->from($data['from'])->subject($data['subject'])->attach($data['filepath']);
				});
			}
		}
		DB::table('email_logs')->insert(
			array(
				'email_to'	 => $data['to'],
				'email_from' => $data['from'],
				'subject'	 => $data['subject'],
				'message'	 =>	$messageBody,
				'created_at' => DB::raw('NOW()')
			)
		);
	}
public function otp_verify_post(Request $request)
{

	$validator = Validator::make(
			Input::all(),
			array(
				'otp' 						=> 'required',

				//'image' 						=> 'mimes:'.IMAGE_EXTENSION,
			)
			);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		$r = 0;

		$user_id 			=  $request->input('user_id');
		$otp 		=  $request->input('otp');
		//$first_name 	=  $request->input('name');
		$userArray = User::where('id','=',$user_id)->first();
		if($userArray){
						if($userArray->status == '0'){
							$is_deactivate = '1';
							//$message = "Your account has been deactivated.";
							$r = 1;
						}
					}

		if($r == 0){
						//$user_id = $decoded['user_id'];
						$check_otp = User::where('id','=',$user_id)->where('otp','=',$otp)->first();
			if($check_otp)
						{
							$check_otp->otp="";
							$check_otp->otp_verify="yes";
							$check_otp->is_verified=1;
							$check_otp->save();
								$response	=	array(
								'success' 	=>	1,
								'message' 	=>	'OTP has been verified successfully.Your account has been created successfully.'
							);
							return Response::json($response);
						}else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Please enter valid OTP.";
							return Response::json($err);
						}
		}elseif($r == 1){
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Your account has been deactivated.";
							return Response::json($err);
		} else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Invalid Details.";
							return Response::json($err);
		}

	}
}

public function resend_post(Request $request)
{

	$validator = Validator::make(
			Input::all(),
			array(
				'country_code' 						=> 'required',
				'mobile' 						=> 'required|numeric|digits_between:8,12',

				//'image' 						=> 'mimes:'.IMAGE_EXTENSION,
			)
			);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		$r = 0;

		$country_code 			=  $request->input('country_code');
		$mobile 		=  $request->input('mobile');
		//$first_name 	=  $request->input('name');
		$userArray = User::where('mobile','=',$mobile)->where('country_code','=',$country_code)->first();
					if($userArray){
						if($userArray->status == '0'){
							$is_deactivate = '1';
							//$message = "Your account has been deactivated.";
							$r = 1;
						}
					}else{
							//$message = "Please enter your registered mobile.";
							$r = 2;
						}

		if($r == 0){


							$otp = $this->random_digits(6);
							if($country_code == 49 || $country_code == 971 || $country_code == 91){
								$userArray->otp=$otp;
								$userArray->save();
								$mobile = $country_code.$mobile;

								/* For Otp used */
						require(base_path().'/vendor/websms-com/websmscom-php/WebSmsCom_Toolkit.inc');
							//print_r('sdfsdfd');die();
						$username             = 'o.jafari@bringoo.de';
						$pass                 = 'bringoo123!';
						$accessToken          = 'b31515a8-7cc4-4674-a068-647807c8a713';
						$gateway_url          = 'https://api.websms.com/';

						$recipientAddressList = array($mobile);
						$utf8_message_text    = "Your Bringoo OTP is ".$otp." and please do not share this OTP with anyone";

						$maxSmsPerMessage     = 2;
						$test                 = false; // true: do not send sms for real, just test interface
							//$message = array('message'=>'asd');
							//$message = $otp;
						try {
							//$smsClient = new WebSmsCom_Client($username, $pass, $gateway_url); //echo 'asd'; die;
							//$smsClient->setSslVerifyHost(2);
							$smsClient = new WebSmsCom_Client($username, $pass, $gateway_url);
						$smsClient->setSslVerifyHost(2);
							$message  = new WebSmsCom_TextMessage($recipientAddressList, $utf8_message_text);
							$Response = $smsClient->send($message, $maxSmsPerMessage, $test);


							//print_r($Response); die;

							// show success
							/*echo '<pre>';
							print_r(array(
								"Status          : ".$Response->getStatusCode(),
								"StatusMessage   : ".$Response->getStatusMessage(),
								"TransferId      : ".$Response->getTransferId(),
								"ClientMessageId : ".(($Response->getClientMessageId()) ?
														$Response->getClientMessageId() : '<NOT SET>'),
							));*/
						} catch (WebSmsCom_ParameterValidationException $e) {
							exit("ParameterValidationException caught: ".$e->getMessage()."\n");

						} catch (WebSmsCom_AuthorizationFailedException $e) {
							exit("AuthorizationFailedException caught: ".$e->getMessage()."\n");

						} catch (WebSmsCom_ApiException $e) {
							echo $e; // possibility to handle API status codes $e->getCode()
							exit("ApiException Exception\n");

						} catch (WebSmsCom_HttpConnectionException $e) {
							exit("HttpConnectionException caught: ".$e->getMessage()."HTTP Status: ".$e->getCode()."\n");

						} catch (WebSmsCom_UnknownResponseException $e) {
							exit("UnknownResponseException caught: ".$e->getMessage()."\n");

						} catch (Exception $e) {
							exit("Exception caught: ".$e->getMessage()."\n");
						}

						$response	=	array(
								'success' 	=>	'1',
								'user_id' 	=>	base64_encode($userArray->id),
								'message' 	=>	'OTP has been sent to your mobile number.'
							);
							return Response::json($response);
							}else{
								$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"We are not able to send otp on this number.";
							return Response::json($err);
							}


		}elseif($r == 1){
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Your account has been deactivated.";
							return Response::json($err);
		}elseif($r == 2){

							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Please enter your registered mobile.";
							return Response::json($err);
		} else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Invalid Details.";
							return Response::json($err);
		}

	}
}
public function signupstorePost(Request $request)
{
	Input::replace($this->arrayStripTags(Input::all()));
		$formData	=	Input::all();
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
	$validator = Validator::make(
			Input::all(),
			array(
				'email' 						=> 'required|email|unique:users',
				'country_code'					=> 'required',
				'first_name'					=> 'required|max:50',
				'last_name'						=> 'required|max:50',
				'store_name'					=> 'required|max:50',
				'mobile' 						=> 'required|numeric|digits_between:8,12|unique:users',
				'password'						=> 'required|min:8|custom_password',
				'confirm_password' 	 			=> 'required|min:8|same:password',
				//'image' 						=> 'mimes:'.IMAGE_EXTENSION,
			),array("password.custom_password"	=>	"Password must have be a combination of numeric, alphabet and special characters.",
			)

		);
	if ($validator->fails()) {
		$errors 	=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		$r = 0;

		$email 			=  $request->input('email');
		$password 		=  $request->input('password');
		$country_code 	=  $request->input('country_code');
		$mobile 		=  $request->input('mobile');
		//$first_name 	=  $request->input('name');
		$invite_code 		=  $request->input('invite_code');
		if($invite_code !=""){
						$invite_codeuser= User::where('uniq_id',$invite_code)->first();
						if(empty($invite_codeuser)){
							$r = 3;
						}

					}

		if($r == 0){

			$user 					=  new User;
			$otp = $this->random_digits(6);

			$user->mobile 			=  Input::get('mobile');
			$user->email 			=  Input::get('email');
			//$user->slug	 			=  $this->getSlug(Input::get('first_name')." ".Input::get('last_name'),'full_name','User');
			$user->password	 		=  Hash::make(Input::get('password'));
			$user->custom_password	=  Input::get('password');
			$user->country_code 	=  Input::get('country_code');
			$user->first_name		=  !empty($request->input('first_name')) ? $request->input('first_name') : '';
			$user->last_name		=  !empty($request->input('last_name')) ? $request->input('last_name') : '';
			$user->type				=	1;
			$user->uniq_id 			= uniqid();
			$user->invite_code 		=	Input::get('invite_code') ? Input::get('invite_code') : '';
			$user->otp 				=	$otp;
			//$user->otp_verify 		=	'no';
			//$user->is_notification 	='1';
			//$user->device_type 		='website';
			//$user->status 			='1';
			$validateString			=  md5(time() . Input::get('email'));
			$user->validate_string	=  $validateString;

			$user->status		=  '0';

			$user->is_active	=  0;
			$user->save();
			$store 					=  new stores;

			$name =  $request->input('store_name');
			$slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));
			$oldslug = Stores::where('slug', '=', $slug)->first();
			if ($oldslug === null)
			{$newslug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($name)));}
			else { $newslug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($name.'-'.time())));}

			$store->name  = $request->input('store_name');
			$store->slug = $newslug;
			$store->user_id  = $user->id;
			$store->save();

			$emailData = Emailtemplates::where('slug','=','store-registration')->first();
							$settingsEmail 		= Config::get("Site.email");
							 $full_name = $user->first_name.' '.$user->last_name;
						  if($emailData){ //echo 'asd'; die;
							$messageBody = $emailData->description;
							$subject = $emailData->subject;
							//$user->subject = $emailData->subject;
							//$user->from = 'dinesh.singh@octalinfosolution.com';
							//$activate_url =\App::make('url')->to("user-account-activate/".$user->validate_string);
							//$activate_url = \App::make('url')->to('/user-account-activate')."/".$user->validate_string;

							if($user->email!='')
							{
								$messageBody = str_replace(array('{USERNAME}'), array($user->first_name),$messageBody);
								$this->sendMail($user->email,$full_name,$subject,$messageBody,$settingsEmail);
							}

						}

				$response	=	array(
				'success' 	=>	'1',
				'message' 	=>	'Your details send to admin. when admin active your acount then inform you. '
			);
			return Response::json($response);
		} else{
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Invalid Invite code.";
							return Response::json($err);
		}

	}
}



public function LoginUser(){ //echo '<pre>'; print_r(Input::all()); die;
		Input::replace($this->arrayStripTags(Input::all()));
			$formData	=	Input::all();
			if(!empty($formData)){
				$validator = Validator::make(
					Input::all(),
					array(
						'login_username' 			=> 'required',
						'login_password'			=> 'required',
					),
					array(
						'login_username.required' 		=> "The login email field is required.",

					)
				);
			}
			if ($validator->fails()){
				$response	=	array(
					'success' 	=> 0,
					'message' 	=> $validator->errors()
				);
				return Response::json($response);
				die;
			}else {
				$field = filter_var(Input::get('login_username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';
				if($field == "email"){
						$userdata = array(
						'email' 		=>	 Input::get('login_username'),
						'password' 		=> 	 Input::get('login_password'),
						'status'		=>	 '1',
						'email_verify'  =>   'yes',
						//'is_verified' 	=>   1,
					);
				}else{
					$userdata = array(
						'mobile' 		=>	 Input::get('login_username'),
						'password' 		=> 	 Input::get('login_password'),
						'status'		=>	 '1',
						//'is_verified' 	=>   1,
						'otp_verify'	=>	'yes',
					);
				}

				$remember_me 		= !empty(Input::get('remember')) ? true : false;
				/* if($remember_me == true){ //echo $remember_me ; die;
                            setcookie ("user_email",Input::get('login_username'),time()+ (86400 * 30));
                            setcookie ("user_password",Input::get('login_password'),time()+ (86400 * 30));
                        } */
						//echo '<pre>'; print_r($userdata); die;
				if (Auth::attempt($userdata,$remember_me)){


				if($remember_me)
                    {
						    setcookie ("login_username",Input::get('login_username'),time()+ (86400 * 30));
                            setcookie ("login_password",Input::get('login_password'),time()+ (86400 * 30));

                    }else{ //die;
						 unset($_COOKIE['login_username']);
						 setcookie('login_username', '', 1);
						 unset($_COOKIE['login_password']);
						 setcookie('login_password', '', 1);
					}
							//$users = DB::table('users')->where('email',$userdata['email'])->first();
					User::where('id', Auth::user()->id)->update(array('device_token' => Input::get('device_token')));

					if(request()->ajax()) {
						if(Auth::user()->type != SUPER_ADMIN_ROLE_ID || Auth::user()->type != VENDOR_ROLE_ID){
							//Session::flash('success',  trans("messages.home.you_are_now_login"));
							$err				=	array();
							$err['success']		=	1;
							//$err['is_profile_complete']		=	Auth::user()->is_profile_complete;
							$err['message']		=	"You are now login.";
							return Response::json($err);
							die;
						}else{
							Auth::logout();
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"username or password is incorrect";
							return Response::json($err);
							die;
						}
					}else{
						return redirect()->intended('/');
					}
				}else{  //echo 'asd'; die;
					if($field == "email"){
					$userDetails	=	DB::table('users')
										->where('email',Input::get('login_username'))
										->where('type', '!=' , SUPER_ADMIN_ROLE_ID )
										->where('type', '!=' , VENDOR_ROLE_ID)
										->first();
					}else{
						$userDetails	=	DB::table('users')
										->where('mobile',Input::get('login_username'))
										->where('type', '!=' , SUPER_ADMIN_ROLE_ID )
										->where('type', '!=' , VENDOR_ROLE_ID)
										->first();
					}
							//echo '<pre>'; print_r($userDetails); die;
					if(!empty($userDetails)) {
						if($userDetails->status == INACTIVE) {
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Your account is inactive please contact to admin";
							return Response::json($err);
						}else if($userDetails->email_verify == "no" && $field == "email") {
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"Your account is unverified please verified your account";
							return Response::json($err);
						}else if($userDetails->otp_verify == "no") {

							$otp = $this->random_digits(6);
							$userDetailss = User::find($userDetails->id);
								$userDetailss->otp=$otp;
								$userDetailss->save();
							if($userDetails->country_code == 49 || $userDetails->country_code == 971 || $userDetails->country_code == 91){

								$mobile = $userDetails->country_code.$userDetails->mobile;

								/* For Otp used */
									require(base_path().'/vendor/websms-com/websmscom-php/WebSmsCom_Toolkit.inc');
										//print_r('sdfsdfd');die();
									$username             = 'o.jafari@bringoo.de';
									$pass                 = 'bringoo123!';
									$accessToken          = 'b31515a8-7cc4-4674-a068-647807c8a713';
									$gateway_url          = 'https://api.websms.com/';

									$recipientAddressList = array($mobile);
									$utf8_message_text    = "Your Bringoo OTP is ".$otp." and please do not share this OTP with anyone";

									$maxSmsPerMessage     = 2;
									$test                 = false; // true: do not send sms for real, just test interface
										//$message = array('message'=>'asd');
										//$message = $otp;
									try {
										//$smsClient = new WebSmsCom_Client($username, $pass, $gateway_url); //echo 'asd'; die;
										//$smsClient->setSslVerifyHost(2);
										$smsClient = new WebSmsCom_Client($username, $pass, $gateway_url);
									$smsClient->setSslVerifyHost(2);
										$message  = new WebSmsCom_TextMessage($recipientAddressList, $utf8_message_text);
										$Response = $smsClient->send($message, $maxSmsPerMessage, $test);


										//print_r($Response); die;

										// show success
										/*echo '<pre>';
										print_r(array(
											"Status          : ".$Response->getStatusCode(),
											"StatusMessage   : ".$Response->getStatusMessage(),
											"TransferId      : ".$Response->getTransferId(),
											"ClientMessageId : ".(($Response->getClientMessageId()) ?
																	$Response->getClientMessageId() : '<NOT SET>'),
										));*/
									} catch (WebSmsCom_ParameterValidationException $e) {
										exit("ParameterValidationException caught: ".$e->getMessage()."\n");

									} catch (WebSmsCom_AuthorizationFailedException $e) {
										exit("AuthorizationFailedException caught: ".$e->getMessage()."\n");

									} catch (WebSmsCom_ApiException $e) {
										echo $e; // possibility to handle API status codes $e->getCode()
										exit("ApiException Exception\n");

									} catch (WebSmsCom_HttpConnectionException $e) {
										exit("HttpConnectionException caught: ".$e->getMessage()."HTTP Status: ".$e->getCode()."\n");

									} catch (WebSmsCom_UnknownResponseException $e) {
										exit("UnknownResponseException caught: ".$e->getMessage()."\n");

									} catch (Exception $e) {
										exit("Exception caught: ".$e->getMessage()."\n");
									}

							}

							$err				=	array();
							$err['success']		=	3;
							$err['user_id']		=	base64_encode($userDetails->id);
							$err['message']		=	"Your account is unverified please verified your account";
							return Response::json($err);
                       } else if($userDetails->is_deleted == 1){
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	trans('Your account deleted by admin');
							return Response::json($err);
						}else {
							$err				=	array();
							$err['success']		=	2;
							$err['message']		=	"username or password is incorrect";
							return Response::json($err);
						}
					}else {
						$err				=	array();
						$err['success']		=	2;
						$err['message']		=	"username or password is incorrect";
						return Response::json($err);
					}
					die;
				}
			}
	}// end LoginUser()
	public function forgot()
{
	if (Auth::check())
	{
		return redirect('/myaccount');
	}else{
		return view('front.home.forgot_password');
	}
}
public function createpass($uniqurl)
{
	if (Auth::check())
	{
		return redirect('/');
	}else {
		$user = User::whereForgot_url($uniqurl)->first();
		if(!isset($user->id)){
			return view('pages.error404',['msg'=>'link expire !']);
		}else{
			$time = date('Y-m-d H:i:s');
			$time1 = strtotime($user->forgot_time);
			$time2 = strtotime($time);
			$diff = $time2 - $time1;
			$hour_diff = $diff/3600;
			if($hour_diff > 24)
			{
				return view('pages.error404',['msg'=>'Your Session has been expired!']);
			}else{
				return view('pages.createpassword',['uniqurl'=>$uniqurl]);
			}
		}
	}
}

public function createpassweb($uniqurl)
{
	if (Auth::check())
	{
		return redirect('/');
	}else {
		$user = User::whereForgot_url($uniqurl)->first();
		if(!isset($user->id)){
			return view('pages.error404',['msg'=>'link expire !']);
		}else{
			$time = date('Y-m-d H:i:s');
			$time1 = strtotime($user->forgot_time);
			$time2 = strtotime($time);
			$diff = $time2 - $time1;
			$hour_diff = $diff/3600;
			if($hour_diff > 24)
			{
				return view('pages.error404',['msg'=>'Your Session has been expired!']);
			}else{
				return view('front.home.resetpassword',['uniqurl'=>$uniqurl]);
			}
		}
	}
}

public function createpasspost(Request $request)
{
	if (Auth::check())
	{
		return redirect('/myaccount');
	}else {
		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});
	$validator = Validator::make($request->all(), [
	'uniqurl' => 'required',
	'password' => 'required|min:6|max:16|confirmed|custom_password',
	'password_confirmation' => 'required|min:6|max:16',
	],["password.custom_password"	=>	"Password must have be a combination of numeric, alphabet and special characters.",
	]);
	if ($validator->fails()) {
	return redirect()->back()->withErrors($validator)->withInput();
	}else{
		 $password =  $request->input('password');
		 $uniqurl =  $request->input('uniqurl');
		$uniqurldata = User::whereForgot_url($uniqurl)->first();

		if(!isset($uniqurldata->id)){
			return view('pages.error404',['msg'=>'link expire !']);
		}else{

			$uniqurldata->forgot_url = "";
			$uniqurldata->password = Hash::make($password);
			$uniqurldata->save();
			//Session::put('msg', '<div class="alert alert-success">password changed successfully. You can login with new password.</div>');
			Session::flash('flash_notice',  "password changed successfully. You can login with new password in your app");
			return redirect('/');

		}
	}
	}
}


public function createpasspostweb(Request $request)
{
	if (Auth::check())
	{
		return redirect('/myaccount');
	}else {

		Validator::extend('custom_password', function($attribute, $value, $parameters) {
			if (preg_match('#[0-9]#', $value) && preg_match('#[a-zA-Z]#', $value) && preg_match('#[\W]#', $value)) {
				return true;
			} else {
				return false;
			}
		});

	$validator = Validator::make($request->all(), [
	//'uniqurl' => 'required',
	'password' => 'required|min:8|custom_password',
	'confirm_password' => 'required|min:8|same:password',
	],['password.custom_password' => 'Password must have be a combination of numeric, alphabet and special characters.'
	]);
	if ($validator->fails()) {
	$errors 				=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
	}else{
		 $password =  $request->input('password');
		 $uniqurl =  $request->input('uniqurl');
		$uniqurldata = User::whereForgot_url($uniqurl)->first();

		if(!isset($uniqurldata->id)){
			//return view('pages.error404',['msg'=>'link expire !']);
				$err				=	array();
				$err['success']		=	2;
				$err['message']		=	"link expire !";
				return Response::json($err);
		}else{
			$uniqurldata->forgot_url = "";
			$uniqurldata->password = Hash::make($password);
			$uniqurldata->save();

				$err				=	array();
				$err['success']		=	1;
				$err['message']		=	"password changed successfully. You can login with new password.";
				return Response::json($err);
			//Session::put('msg', '<div class="alert alert-success">password changed successfully. You can login with new password.</div>');
			//return redirect('/signin');

		}
	}
	}
}
public function ForgotPassword(){
		 $validator = Validator::make(
			Input::all(),
			array(
				'email' 			=> 'required|email',
			)
		);
		if ($validator->fails()){
			//return Redirect::back()->withErrors($validator)->withInput();
			$errors 				=	$validator->messages();
			 $response	=	array(
				'success' 	=> false,
				'errors' 	=> $errors
			);
			return Response::json($response);
			die;
		}else{
			$email		=	Input::get('email');
			$userArray = User::where('email','=',$email)->first();
				///pr($userDetail); die;
			if(!empty($userArray) && $userArray->type == 0){
				$status = 1;
						$length = 10;
						$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						$charactersLength = strlen($characters);
						$randomString = '';

						for ($i = 0; $i < $length; $i++)
						{$randomString .= $characters[rand(0, $charactersLength - 1)];}
						$url = $randomString;
						$cur_date = date("Y-m-d H:i:s");
						$userArray->forgot_url = $url;
						$userArray->forgot_time = $cur_date;
						$userArray->save();
						$create_url = \App::make('url')->to('/web-create-password')."/".$url;


						$emailData = Emailtemplates::where('slug','=','user-forgot-password')->first();
						if($emailData){
						  $textMessage = $emailData->description;
						  $userArray->subject = $emailData->subject;
						  $settingsEmail 		= Config::get("Site.email");
						  $full_name = $userArray->first_name;
						  $subject = $emailData->subject;;
						  if($userArray->email!='')
						  {
							  $textMessage = str_replace(array('{USER_NAME}','{FORGOT_PASSWORD_LINK}','{LINK}'), array($userArray->first_name,$create_url,$create_url),$textMessage);

							   $this->sendMail($userArray->email,$full_name,$subject,$textMessage,$settingsEmail);




						  }
					  }
				//Session::flash('flash_notice',  trans("messages.home.password_has_been_send_successfully"));
				$err				=	array();
				$err['success']		=	1;
				$err['message']		=	"Password has been send successfully";
				return Response::json($err);
				//return Redirect::back() ->withInput();
			}else{
				$response	=	array(
					'success' 	=> 2,
					'message' 	=> "Your email is not registered with us"
				);
				return Response::json($response);
				die;

				//Session::flash('error',  trans("messages.home.forgotpassword.your_email_is_not_registered_with_us"));
				//return Redirect::back() ->withInput();
			}
		}
	} //end ForgotPassword()
    public function showCms($slug){
		$pageTitle = ucfirst($slug);

		$cmsPagesDetail	=	DB::table('content')->where('slug',$slug)->first();

		if(empty($cmsPagesDetail)){
			return Redirect::to('/');
		}
		$result	=	array();
		//echo '<pre>'; print_r($cmsPagesDetail); die;
		//foreach($cmsPagesDetail as $cms){
			//$key	=	$cmsPagesDetail->title;
			//$value	=	$cmsPagesDetail->description;
			//$result[$cmsPagesDetail->title]	=	$cmsPagesDetail->description;
		//}
		return View::make('front.cms.index' , compact('cmsPagesDetail','slug',"pageTitle"));
	}//end showCms()


	public function contactUsPost(){
		$pageTitle ="Contact Us";
		//Input::replace($this->arrayStripTags(Input::all()));
		$allData	=	Input::all();

		if(!empty($allData)){
			$validator = Validator::make(
				$allData['data'],
				array(
					'name' 				=> 'required|max:50',
					'email' 			=> 'required|email',
					'message'  			=> 'required',
					'phone_number'  			=> 'nullable|numeric|digits_between:8,15|min:1'
				)

			);

			if ($validator->fails()){
					$response	=	array(
						'success' 	=> false,
						'errors' 	=> $validator->errors()
					);
					return Response::json($response);
					die;
			}else{
				$date = date("Y-m-d H:i:s");
				DB::table('contact_us')->insert(
					array(
						'name'			=> $allData['data']['name'],
						'email' 		=> $allData['data']['email'],
						'phone_number' 		=> $allData['data']['phone'],
						'message' 		=> $allData['data']['message'],
						'created_at' 	=> $date,
						'updated_at' 	=> $date,
					)
				);

					/*	$emailData = Emailtemplates::where('slug','=','contact_us')->first();
							$settingsEmail 		= Config::get("Site.email");
							$full_name = $allData['data']['name'];
						  if($emailData){ //echo 'asd'; die;
							$messageBody = strip_tags($emailData->description);
							$subject = $emailData->subject;

								$messageBody = str_replace(array('{NAME}','{EMAIL}','{MOBILE}','{MESSAGE}'), array($allData['data']['name'],$allData['data']['email'],$allData['data']['phone'],$allData['data']['message']),$messageBody);
								$this->sendMail(Config::get("Site.contact_email"),'Admin',$subject,$messageBody,$settingsEmail);


						}*/

				$response	=	array(
						'success' 	=>	1,
						//'user_id'	=>	base64_encode($user->id),
						'message' 	=>	'Message has been send.'
					);
				//Session::flash('flash_notice',  "Message has been send");
				return  Response::json($response);
				die;
			}
		}
		return View::make('front.cms.contact_us',compact('pageTitle'));
	}//end contactUs()

    public function logout()
    {
    	if (Auth::check())
    	{
    	 Auth::logout();
    	 return redirect('/');
    	}else {
    	 return redirect('/');
    	}
    }





    public function serviceBookPost(Request $request)
    {

	    try{

	       $validator = Validator::make(
				Input::all(),
				array(
					'pickup_loc'     => 'required',
					'drop_loc'     => 'required',
				)

			);
			if ($validator->fails()) {
				$errors 	=	$validator->messages();
				$response	=	array(
					'success' 	=> false,
					'errors' 	=> $errors
				);
				//return Response::json($response);
				return redirect('/service')->messagealert('message',Response::json($response));
			}else{
				$userData = User::where('role','admin')->first();

				if(!empty($userData)){
					$email = $userData->email;
					$admin = $userData->name . ' ' . $userData->lastname;

					if($email != ''){

						$pickup_location =  $request->pickup_loc;
						$drop_location =  $request->drop_loc;

						$logo = DB::table('tbl_settings')->first();
						$systemname = $logo->system_name;

						$emailformat = DB::table('tbl_mail_notifications')->where('notification_for','=','service_notification')->first();
						$mail_format = $emailformat->notification_text;
						$mail_subjects = $emailformat->subject;
						$mail_send_from = $emailformat->send_from;
						$search1 = array('{ system_name }','{ pickup_location }', '{ drop_location }');
						$replace1 = array($systemname, $pickup_location, $drop_location);
						$mail_sub = str_replace($search1, $replace1, $mail_subjects);

						$search = array('{ system_name }','{ admin }','{ pickup_location }', '{ drop_location }' );
						$replace = array($systemname, $admin, $pickup_location, $drop_location );

						$email_content = str_replace($search, $replace, $mail_format);


						$actual_link = $_SERVER['HTTP_HOST'];
						$startip='0.0.0.0';
						$endip='255.255.255.255';
						if(($actual_link == 'localhost' || $actual_link == 'localhost:8080') || ($actual_link >= $startip && $actual_link <=$endip ))
						{
							 //local format email

							$data=array(
								'email'=>$email,
								'mail_sub1' => $mail_sub,
								'email_content1' => $email_content,
								//'emailsend' =>$mail_send_from,
							);
							$data1 = Mail::send(['html' => 'emails.servicemail'],  ['messageBody'=>$data], function ($m) use ($data) {
								//$m->from($data['emailsend'],'noreply');
								$m->to($data['email'])->subject($data['mail_sub1']);
							});
						}
						else
						{
							//live format email
							$headers = 'Content-Type: text/html; charset=UTF-8' . "\r\n";
							//$headers .= 'From:'. $mail_send_from . "\r\n";

							$data = mail($email,$mail_sub,$email_content,$headers);
						}
					}
					return redirect('/service')->with('messagealert','Service request sent successfully.');
				}
				return redirect('/service')->with('messagealert','Something went wrong.');
			}
		} catch (Exception $e) {
			$responseType='error';
			$responseMessage=$e->getError()->message;
			$err				=	array();
			$err['success']		=	2;
			$err['message']		=	$responseMessage;
			//return Response::json($err);
			return redirect('/service')->with('messagealert',$responseMessage);
		}

	}









}

?>
