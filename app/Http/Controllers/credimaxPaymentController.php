<?php

namespace App\Http\Controllers;

use App\CPU\Helpers;
use App\Model\BusinessSetting;
use App\Model\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class credimaxPaymentController extends Controller
{
    public function detail()
    {
        $data = BusinessSetting::where('type', '=', 'credimax')->first()->value;
        $values = json_decode($data);
        $CONFIG = array(
            "merchant" => $values->merchant_id, // Replace this with your Merchant key from Credimax
            "operator" => $values->operator_id, // Replace this with your Access Code from Credimax
            "apiPassword" => $values->operator_password, // Replace this with your Secure Secret from Credimax
            "return_url" => "https://kunal.thixpro.in/checkout-payment",
        );
        return $CONFIG;
    }
  
  public function pay(Request $request){
         $auth = "Basic bWVyY2hhbnQuRTE3NTM0OTUwOjZhYmZiODZlNmNkMjM3NzliMzk3Mjc4ZDdiMTAyMzY5";
         $operation = "AUTHORIZE";
        //$operation = "PURCHASE";
        $operator_id = $this->detail()['operator'];
        $merchant_id = $this->detail()['merchant'];
        $operator_password = $this->detail()['apiPassword'];
        $orderID = $request->orderID;
        $address = $request->address;
        $mobile = $request->mobile;
        $name = $request->name;
        $nameM = config('app.name', 'Laravel');
        $transactionid = $request->reference;
        $amount = $request->amount;
        $amount = round($amount, 2);
        $returnURL = asset('checkout-completed');
        $cancelURL = asset('checkout-payment');
        $urlforcurl = "https://credimax.gateway.mastercard.com/api/rest/version/66/merchant/" . $merchant_id . "/session";
        $merchant_logo = asset('public/assets/logo.jpeg');
        $currency_model = Helpers::get_business_settings('currency_model');
        $currency = "BHD";
        $default = BusinessSetting::where(['type' => 'system_default_currency'])->first()->value;
        $currency = Currency::find($default)->code;
        if ($orderID == "") {
            $orderID = rand(0, 10) * 10;
        }
$response = Http::withBody( 
        '{
    "apiOperation" : "INITIATE_CHECKOUT",
    "order": {
            "amount" : "'.$amount.'",
            "currency" : "'.$currency.'",
            "id" : "'.$orderID.'"
        },
        "interaction":{
        "operation":"'.$operation.'",
        "returnUrl":"'.$returnURL.'",
        "cancelUrl":"'.$cancelURL.'",
        "merchant": {
        	"name": "'.$nameM.'",
		"logo": "'.$merchant_logo.'"
                 },
	"displayControl" : {
		"billingAddress" : "HIDE"
		}
        }
}', 'json' 
    ) 
    ->withHeaders([ 
        'Accept'=> '*/*',
        'Authorization'=> $auth, 
        'Content-Type'=> 'application/json', 
    ]) 
    ->post($urlforcurl); 

    $sessionId = json_decode($response->body())->session->id;
    return view('credimax.pay',compact('sessionId','orderID','returnURL','cancelURL','name','address','mobile'));
  }
  public function payment_error(){
        view('error-payment');
    }
}