<?php

namespace App\Http\Controllers;

use App\CPU\CartManager;
use App\CPU\Helpers;
use App\CPU\OrderManager;
use App\Model\BusinessSetting;
use App\Model\Currency;
use App\Model\Order;
use App\Model\Product;
use App\Model\ShippingMethod;
use App\User;
use Illuminate\Http\Request;
use App\Lib\iPayBenefitPipe;
use Illuminate\Support\Facades\Http;
use Session;

class BenefitPaymentController extends Controller
{
    private $Pipe; 

    public function __construct() {
        $this->Pipe = new iPayBenefitPipe();

        // modify the following to reflect your "Tranportal ID", "Tranportal Password ", "Terminal Resourcekey"
        $this->Pipe->setkey("22657736439322657736439322657736");
        $this->Pipe->setid("711740702");
        $this->Pipe->setpassword("711740702");
    }
  
    public function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    /**
     * Send Payment request to Benefit PG
     */
    public function request(Request $request) {
        $orderID = $request->orderID;
        $address = $request->address;
        $mobile = $request->mobile;
        $name = $request->name;
        $transactionid = $request->reference;
        $amount = $request->amount;
        $amount = round($amount, 2);
        // Do NOT change the values of the following parameters at all.
        $this->Pipe->setaction("1");
        $this->Pipe->setcardType("D");
        $this->Pipe->setcurrencyCode("048");

        // modify the following to reflect your pages URLs
        $this->Pipe->setresponseURL(route('pg.response')); //replace with your response url
        $this->Pipe->seterrorURL(route('pg.error'));//replace with your error url
        
        $random_string = $this->generateRandomString(5);
        // set a unique track ID for each transaction so you can use it later to match transaction response and identify transactions in your system and “BENEFIT Payment Gateway” portal.
        $this->Pipe->settrackId($random_string);

        // set transaction amount
        $this->Pipe->setamt($amount);

        // The following user-defined fields (UDF1, UDF2, UDF3, UDF4, UDF5) are optional fields.
	    // However, we recommend setting theses optional fields with invoice/product/customer identification information as they will be reflected in “BENEFIT Payment Gateway” portal where you will be able to link transactions to respective customers. This is helpful for dispute cases. 
        $this->Pipe->setudf1("set value 1");
        $this->Pipe->setudf2("set value 2");
        $this->Pipe->setudf3("set value 3");
	    $this->Pipe->setudf4("set value 4");
	    $this->Pipe->setudf5("set value 5");

        $isSuccess = $this->Pipe->performeTransaction();
        if($isSuccess == 1)
        {
            $url = $this->Pipe->getresult();
            return redirect($url);
        }
        else
        {
            return response()->json(['error' => $this->Pipe->geterrorText()],422);
        }
    }
    
    /**
     * Handle merchant notification request from PG
     * The response is returned to Benefit PG
     */
    public function response(Request $request) {
        $trandata = isset($request->trandata) ? $request->trandata : "";

        if ($trandata != "")
        {

            $this->Pipe->settrandata($trandata);

            $returnValue =  $this->Pipe->parseResponseTrandata();
            if ($returnValue == 1)
            {
                $paymentID = $this->Pipe->getpaymentId();
                $result = $this->Pipe->getresult();
                $responseCode = $this->Pipe->getauthRespCode();
                $transactionID = $this->Pipe->gettransId();
                $referenceID = $this->Pipe->getref();
                $trackID = $this->Pipe->gettrackId();
                $amount = $this->Pipe->getamt();
                $UDF1 = $this->Pipe->getudf1();
                $UDF2 = $this->Pipe->getudf2();
                $UDF3 = $this->Pipe->getudf3();
                $UDF4 = $this->Pipe->getudf4();
                $UDF5 = $this->Pipe->getudf5();
                $authCode = $this->Pipe->getauthCode();
                $postDate = $this->Pipe->gettranDate();
                $errorCode = $this->Pipe->geterror();
                $errorText = $this->Pipe->geterrorText();

                // Remove any HTML/CSS/javascrip from the page. Also, you MUST NOT write anything on the page EXCEPT the word "REDIRECT=" (in upper-case only) followed by a URL.
                // If anything else is written on the page then you will not be able to complete the process.
                if ($this->Pipe->getresult() == "CAPTURED")
                {
                    return redirect(route('pg.approved').'?trandata='.$trandata);
                }
                else if ($this->Pipe->getresult() == "NOT CAPTURED" || $this->Pipe->getresult() == "CANCELED" || $this->Pipe->getresult() == "DENIED BY RISK" || $this->Pipe->getresult() == "HOST TIMEOUT")
                {
                    if ($this->Pipe->getresult() == "NOT CAPTURED")
                    {
                        switch ($this->Pipe->getAuthRespCode())
                        {
                            case "05":
                                $response = "Please contact issuer";
                                break;
                            case "14":
                                $response = "Invalid card number";
                                break;
                            case "33":
                                $response = "Expired card";
                                break;
                            case "36":
                                $response = "Restricted card";
                                break;
                            case "38":
                                $response = "Allowable PIN tries exceeded";
                                break;
                            case "51":
                                $response = "Insufficient funds";
                                break;
                            case "54":
                                $response = "Expired card";
                                break;
                            case "55":
                                $response = "Incorrect PIN";
                                break;
                            case "61":
                                $response = "Exceeds withdrawal amount limit";
                                break;
                            case "62":
                                $response = "Restricted Card";
                                break;
                            case "65":
                                $response = "Exceeds withdrawal frequency limit";
                                break;
                            case "75":
                                $response = "Allowable number PIN tries exceeded";
                                break;
                            case "76":
                                $response = "Ineligible account";
                                break;
                            case "78":
                                $response = "Refer to Issuer";
                                break;
                            case "91":
                                $response = "Issuer is inoperative";
                                break;
                            default:
                                // for unlisted values, please generate a proper user-friendly message
                                $response = "Unable to process transaction temporarily. Try again later or try using another card.";
                                break;

                        }
                    }
                    else if ($this->Pipe->getresult() == "CANCELED")
                    {
                        $response = "Transaction was canceled by user.";
                    }
                    else if ($this->Pipe->getresult() == "DENIED BY RISK")
                    {
                        $response = "Maximum number of transactions has exceeded the daily limit.";
                    }
                    else if ($this->Pipe->getresult() == "HOST TIMEOUT")
                    {
                        $response = "Unable to process transaction temporarily. Try again later.";
                    }
                    return redirect(route('pg.declined').'?trandata='.$trandata);
                }
                else
                {
                    //Unable to process transaction temporarily. Try again later or try using another card.
                    return redirect(route('pg.error'));
                }
            }
            else
            {
                $errorText = $this->Pipe->geterrorText();
            }
        }
        else if (isset($request->ErrorText))
        {
            $paymentID = $request->paymentid;
            $trackID = $request->trackid;
            $amount = $request->amt;
            $UDF1 = $request->udf1;
            $UDF2 = $request->udf2;
            $UDF3 = $request->udf3;
            $UDF4 = $request->udf4;
            $UDF5 = $request->udf5;
            $errorText = $request->ErrorText;
        }
        else
        {
            $errorText = "Unknown Exception";
        }

        echo $errorText;
    }
    
    /**
     * approved page that the user will see
     */
    public function approved(Request $request) {
        $trandata = isset($request->trandata) ? $request->trandata : "";
        if($trandata == "") {
            return $request->all();
        }
        
        $this->Pipe->settrandata($trandata);
        $this->Pipe->parseResponseTrandata();
        // replace the json response with your approved page
        $data = array(
            'paymentID' => $this->Pipe->getpaymentId(),
			'result' => $this->Pipe->getresult(),
			'responseCode' => $this->Pipe->getauthRespCode(),
			'transactionID' => $this->Pipe->gettransId(),
			'referenceID' => $this->Pipe->getref(),
			'trackID' => $this->Pipe->gettrackId(),
			'amount' => $this->Pipe->getamt(),
			'UDF1' => $this->Pipe->getudf1(),
			'UDF2' => $this->Pipe->getudf2(),
			'UDF3' => $this->Pipe->getudf3(),
			'UDF4' => $this->Pipe->getudf4(),
			'UDF5' => $this->Pipe->getudf5(),
			'authCode' => $this->Pipe->getauthCode(),
			'postDate' => $this->Pipe->gettranDate(),
			'errorCode' => $this->Pipe->geterror(),
			'errorText' => $this->Pipe->geterrorText(),
        );
        // return json_encode($data);
        return redirect(route('checkout-complete','online By Benefit Payments Gateway/'.$this->Pipe->getpaymentId()));
    }
    
    /**
     * declined page that the user will see
     */
    public function declined(Request $request) {
        $trandata = isset($request->trandata) ? $request->trandata : "";
        if($trandata == "") {
            return $request->all();
        }
        
        $this->Pipe->settrandata($trandata);
        $this->Pipe->parseResponseTrandata();
        // replace the json response with your declined page
        $data = array(
            'paymentID' => $this->Pipe->getpaymentId(),
			'result' => $this->Pipe->getresult(),
			'responseCode' => $this->Pipe->getauthRespCode(),
			'transactionID' => $this->Pipe->gettransId(),
			'referenceID' => $this->Pipe->getref(),
			'trackID' => $this->Pipe->gettrackId(),
			'amount' => $this->Pipe->getamt(),
			'UDF1' => $this->Pipe->getudf1(),
			'UDF2' => $this->Pipe->getudf2(),
			'UDF3' => $this->Pipe->getudf3(),
			'UDF4' => $this->Pipe->getudf4(),
			'UDF5' => $this->Pipe->getudf5(),
			'authCode' => $this->Pipe->getauthCode(),
			'postDate' => $this->Pipe->gettranDate(),
			'errorCode' => $this->Pipe->geterror(),
			'errorText' => $this->Pipe->geterrorText(),
        );
        return view('error-payment',compact('data'));
    }
    
    /**
     * error page that the user will see
     */
    public function error(Request $request) {
         // return error page to the user
        return $request->all();
    }
}
