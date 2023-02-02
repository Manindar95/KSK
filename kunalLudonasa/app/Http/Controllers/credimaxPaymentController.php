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
            "return_url" => "http://m.vidhaan.space/",
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
        $transactionid = $request->reference;
        $amount = $request->amount;
        $amount = round($amount, 2);
        $returnURL = "https://kunal.ludonasa.com/checkout-completed";
        $cancelURL = "https://kunal.ludonasa.com/checkout-payment";
        $urlforcurl = "https://credimax.gateway.mastercard.com/api/rest/version/66/merchant/" . $merchant_id . "/session";
        $merchant_logo = "https://media.istockphoto.com/photos/mountain-landscape-picture-id517188688?k=20&m=517188688&s=612x612&w=0&h=i38qBm2P-6V4vZVEaMy_TaTEaoCMkYhvLCysE7yJQ5Q=";
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
        	"name": "'.$name.'",
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
}