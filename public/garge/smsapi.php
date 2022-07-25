<?php
extract($_POST);
if(isset($register))
{
$mob=$_REQUEST['mobile'];

echo $mob;
exit();
$msg=""hello garage;
//Send sms to sender and reciever
	$senderId = "PHPTPN";
		$route = 4;
		$campaign = "OTP";
		$sms = array(
			'message' => "Message : $msg",
			'to' => array($mob)
		);
		//Prepare you post parameters
		$postData = array(
			'sender' => $senderId,
			'campaign' => $campaign,
			'route' => $route,
			'sms' => array($sms)
		);
		$postDataJson = json_encode($postData);

		$url="http://login.bulksms365.in/api/v2/sendsms";

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "$url",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => $postDataJson,
			CURLOPT_HTTPHEADER => array(
				"authkey: 7720ARd4rlCOX5ad7",
				"content-type: application/json"
			),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
	//Send sms to sender and reciever
	
		$err="<h4 style='color:green'>Message Send successfully</h4>";

}
?>


