<?php

namespace App\Http\Controllers;

use Auth; 
use DB;
use Mail;
use Session;

use App\Http\Requests;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Stripe\Error\Card;

use App\User;
use App\tbl_incomes;
use App\tbl_add_payments;
use App\tbl_payment_records;
use App\tbl_income_history_records;
use App\Income;
use App\IncomeHistoryRecord;
use App\Branch;
use App\BranchSetting;
use App\Invoice;
use Razorpay\Api\Api;
use App\UpdatekeyRazorpay;
class InvoicePaymentController extends Controller
{ 	
	/*public function __construct()
    {
        $this->middleware('auth');
    }*/
	
	// inclue required files for stripe
	public function initialize()
	{
		parent::initialize();
		require_once('vendor/Stripe/init.php');		
		require_once('vendor/Stripe/lib/Stripe.php');	
			
	}
	
	// stripe payment process 
    public function stripe(Request $request)
	{	
  //dd($request->all());
         $updatekey = UpdatekeyRazorpay::first();
		$invoice_id=$request->invoice_id;
		$stripeamount=$request->invoice_amount;
	//	$p_key=$request->p_key;
		$invoice_number=$request->invoice_no;
		//$stripeToken=$request->stripeToken;
        
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
        
         $payment = $api->payment->fetch($request->razorpay_payment_id);
		/*For add selected branch_id for all user with admmin also*/
		$currentUser = User::where([['soft_delete',0],['id','=',Auth::User()->id]])->orderBy('id','DESC')->first();
		$adminCurrentBranch = BranchSetting::where('id','=',1)->first();
		$currentCustomer = Invoice::where('id','=',$invoice_id)->first();
		$bramnchId = "";
		if (isAdmin(Auth::User()->role_id)){			
			$bramnchId = $adminCurrentBranch->branch_id;
		}
		elseif (getUsersRole(Auth::user()->role_id) == 'Customer') {
			$bramnchId = $currentCustomer->branch_id;
		}
		else{
			$bramnchId = $currentUser->branch_id;
		}
		
		try {
				$updatekey = DB::table('updatekey')->first();
				//$s_key = $updatekey->secret_key;
			//	$key = \Stripe\Stripe::setApiKey($s_key);
				//if(!empty(Input::has('stripeToken'))){
				
			//	if(!empty($stripeToken)){
                if(count($request->all())  && !empty($request->razorpay_payment_id)) {
				//	$token  = $_POST['stripeToken'];
					/*$charge = \Stripe\Charge::create(array(
						  "amount" => $stripeamount *100,
						  // "currency" => "usd",
						  "currency" => strtolower(getCurrencyCode()),
						  "description" => $invoice_number,
						  "source" => $token,
						));
					
					$string_json = json_encode($charge);*/
					 try {
					    $response = $api->payment->fetch($request->razorpay_payment_id)->capture(array('amount'=>$payment['amount'])); 
					 } catch (Exception $e) {
                return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
            }
   //dd($response);
					if(!empty( $response))
					{
						$tbl_invoices = DB::table('tbl_invoices')->where('invoice_number','=',$invoice_number)->first();
						$ids = $tbl_invoices->customer_id;
						$invoiceid = $tbl_invoices->id;
						$type = $tbl_invoices->type;
						$paid_amount = $tbl_invoices->paid_amount;
						$amount = $paid_amount + $stripeamount;
						if($type== 0){
							$type1= 'service';
						}
						elseif($type== 1){
							$type1= 'sales';
						}
						else{
							$type1='';
						}
						 						
						$nowdate = date("Y-m-d");
						$characterss = '0123456789';
						$codepay =  'P'.''.substr(str_shuffle($characterss),0,6);
						$handle = fopen("test.txt","w");
						fwrite($handle,$codepay);
												
						$sql = DB::update("update tbl_invoices set paid_amount='$amount',payment_status='2',charge_id='' where invoice_number=$invoice_number");
												
						$tbl_incomes = new Income;
						$tbl_incomes->invoice_number =$invoice_number;
						$tbl_incomes->payment_number = $codepay;
						$tbl_incomes->customer_id = $ids;
						$tbl_incomes->status = '2';
						$tbl_incomes->payment_type = 'Razorpay';
						$tbl_incomes->date = $nowdate;
						$tbl_incomes->main_label = $type1;
						$tbl_incomes->branch_id = $bramnchId;
						$tbl_incomes->save();
						
						$tbl_income_id = DB::table('tbl_incomes')->orderBy('id','DESC')->first();
						$tbl_incomes_id=$tbl_income_id->id;
						
						$tbl_income_history_records = new IncomeHistoryRecord;
						$tbl_income_history_records->tbl_income_id =$tbl_incomes_id;
						$tbl_income_history_records->income_amount = $stripeamount;
						$tbl_income_history_records->income_label = $type1;
						$tbl_income_history_records->branch_id = $bramnchId;
						$tbl_income_history_records->save();
						
						$tbl_payment_records = new tbl_payment_records;
						$tbl_payment_records->invoices_id = $invoiceid;
						$tbl_payment_records->amount = $stripeamount;
						$tbl_payment_records->payment_date = $nowdate;
						$tbl_payment_records->payment_type = 'Razorpay';
						$tbl_payment_records->payment_number = $codepay;
						$tbl_payment_records->branch_id = $bramnchId;
						$tbl_payment_records->save();						
					}										
				return redirect('invoice/list')->with('message','Successfully Sent');
				}
				else{
				 return redirect('invoice/list')->with('message','Error! Something went wrong.');
				}
			}
			catch(Exception $e)  {
				 return  $e->getMessage();
                Session::put('error',$e->getMessage());
                return redirect()->back();
			}
		return redirect('invoice/list')->with('message','Error! Something went wrong.');		
	}
}
