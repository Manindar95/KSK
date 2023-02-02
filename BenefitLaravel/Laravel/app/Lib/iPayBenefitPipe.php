<?php
namespace App\Lib;

class iPayBenefitPipe {
	protected $id = null;
	protected $action = null;
	protected $password = null;
	protected $amt = null;
	protected $trackId = null;
	protected $udf1 = null;
	protected $udf2 = null;
	protected $udf3 = null;
	protected $udf4 = null;
	protected $udf5 = null;
	protected $udf6 = null;
	protected $udf7 = null;
	protected $udf8 = null;
	protected $currencyCode = null;
	protected $member = null;
	protected $cardType = null;
	protected $expMonth = null;
	protected $expYear = null;
	protected $cardNo = null;
	protected $paymentData = null;
	protected $paymentMethod = null;
	protected $transactionIdentifier = null;
	protected $responseURL = null;
	protected $errorURL = null;
	protected $key = null;
	protected $iv = "PGKEYENCDECIVSPC";
	protected $result = null;
	protected $status = null;
	protected $error = null;
	protected $errorText = null;
	protected $trandata = null;
	protected $endPoint = "https://www.test.benefit-gateway.bh/payment/API/hosted.htm";
	protected $tranDate = null;
	protected $authRespCode = null;
	protected $authCode = null;
	protected $transId = null;
	protected $tranid = null;
	protected $ref = null;
	protected $paymentId = null;
	protected $pin = null;
	protected $ticketNo = null;
	protected $bookingId = null;
	protected $transactionDate = null;
	protected $transUpdateTime = null;
	protected $isEncryptedPin = false;

	

	
	
	/* Get */
	function getendPoint() {
		return $this->endPoint;
	}
	function getpin() {
		return $this->pin;
	}
	function getid() {
		return $this->id;
	}
	function getaction() {
		return $this->action;
	}
	function getpassword() {
		return $this->password;
	}
	function getamt() {
		return $this->amt;
	}
	function gettrackId() {
		return $this->trackId;
	}
	function getudf1() {
		return $this->udf1;
	}
	function getudf2() {
		return $this->udf2;
	}
	function getudf3() {
		return $this->udf3;
	}
	function getudf4() {
		return $this->udf4;
	}
	function getudf5() {
		return $this->udf5;
	}
	function getudf6() {
		return $this->udf6;
	}
	function getudf7() {
		return $this->udf7;
	}
	function getudf8() {
		return $this->udf8;
	}
	function getcurrencyCode() {
		return $this->currencyCode;
	}
	function getmember() {
		return $this->member;
	}
	function getcardType() {
		return $this->cardType;
	}
	function getexpMonth() {
		return $this->expMonth;
	}
	function getexpYear() {
		return $this->expYear;
	}
	function getcardNo() {
		return $this->cardNo;
	}
	function getpaymentData() {
		return $this->paymentData;
	}
	function getpaymentMethod() {
		return $this->paymentMethod;
	}
	function gettransactionIdentifier() {
		return $this->transactionIdentifier;
	}	
	function getresponseURL() {
		return $this->responseURL;
	}
	function geterrorURL() {
		return $this->errorURL;
	}
	function getkey() {
		return $this->key;
	}
	function getstatus() {
		return $this->status;
	}
	function getresult() {
		return $this->result;
	}
	function geterror() {
		return $this->error;
	}
	function geterrorText() {
		return $this->errorText;
	}
	function gettranDate() {
		return $this->tranDate;
	}
	function getauthRespCode() {
		return $this->authRespCode;
	}
	function getauthCode() {
		return $this->authCode;
	}
	function gettransId() {
		return $this->transId;
	}
	function gettranId() {
		return $this->tranId;
	}
	function getref() {
		return $this->ref;
	}
	function getpaymentId() {
		return $this->paymentId;
	}
	function getticketNo() {
		return $this->ticketNo;
	}
	function getbookingId() {
		return $this->bookingId;
	}
	function gettransactionDate() {
		return $this->transactionDate;
	}
	function gettransUpdateTime() {
		return $this->transUpdateTime;
	}
	
	
	/* Set */
	function setendPoint($val) {
		$this->endPoint = $val;
	}
	function setpin($val) {
		$this->pin = $val;
	}
	function setid($val) {
		$this->id = $val;
	}
	function setaction($val) {
		$this->action = $val;
	}
	function setpassword($val) {
		$this->password = $val;
	}
	function setamt($val) {
		$this->amt = $val;
	}
	function settrackId($val) {
		$this->trackId = $val;
	}
	function setudf1($val) {
		$this->udf1 = $val;
	}
	function setudf2($val) {
		$this->udf2 = $val;
	}
	function setudf3($val) {
		$this->udf3 = $val;
	}
	function setudf4($val) {
		$this->udf4 = $val;
	}
	function setudf5($val) {
		$this->udf5 = $val;
	}
	function setudf6($val) {
		$this->udf6 = $val;
	}
	function setudf7($val) {
		$this->udf7 = $val;
	}
	function setudf8($val) {
		$this->udf8 = $val;
	}
	function setcurrencyCode($val) {
		$this->currencyCode = $val;
	}
	function setmember($val) {
		$this->member = $val;
	}
	function setcardType($val) {
		$this->cardType = $val;
	}
	function setexpMonth($val) {
		$this->expMonth = $val;
	}
	function setexpYear($val) {
		$this->expYear = $val;
	}
	function setcardNo($val) {
		$this->cardNo = $val;
	}
	function setpaymentData($val) {
		$this->paymentData = $val;
	}
	function setpaymentMethod($val) {
		$this->paymentMethod = $val;
	}
	function settransactionIdentifier($val) {
		$this->transactionIdentifier = $val;
	}	
	function setresponseURL($val) {
		$this->responseURL = $val;
	}
	function seterrorURL($val) {
		$this->errorURL = $val;
	}
	function setkey($val) {
		$this->key = $val;
	}
	function setstatus($val) {
		$this->status = $val;
	}
	function setresult($val) {
		$this->result = $val;
	}
	function seterror($val) {
		$this->error = $val;
	}
	function seterrorText($val) {
		$this->errorText = $val;
	}
	function settrandata($val) {
		$this->trandata = $val;
	}
	function settranDate($val) {
		$this->tranDate=$val;
	}
	function setauthRespCode($val) {
		$this->authRespCode=$val;
	}
	function setauthCode($val) {
		$this->authCode=$val;
	}
	function settransId($val) {
		$this->transId=$val;
	}
	function settranId($val) {
		$this->tranId=$val;
	}
	function setref($val) {
		$this->ref=$val;
	}
	function setpaymentId($val) {
		$this->paymentId=$val;
	}
	function setticketNo($val) {
		$this->ticketNo=$val;
	}
	function setbookingId($val) {
		$this->bookingId=$val;
	}
	function settransactionDate($val) {
		$this->transactionDate=$val;
	}
	function settransUpdateTime($val) {
		$this->transUpdateTime=$val;
	}
	
	
	
	
	function isEncryptedPin($val){
		$this->isEncryptedPin = $val;
	}
	
	
	
	
	
	
	function createRequestData(){
		$FinalData = ""; 
		if($this->isEncryptedPin == true && $this->pin != ""){
			$this->pin = urlencode($this->pin);
		}
		$trandataObj = array(array(
		'amt' => $this->amt,
		'action' => $this->action,
		'password' => $this->password,
		'id' => $this->id,
		'currencycode' => $this->currencyCode,
		'trackId' => $this->trackId,
		'udf1' => $this->udf1,
		'udf2' => $this->udf2,
		'udf3' => $this->udf3,
		'udf4' => $this->udf4,
		'udf5' => $this->udf5,
		'udf6' => $this->udf6,
		'udf7' => $this->udf7,
		'udf8' => $this->udf8,
		'expYear' => $this->expYear,
		'expMonth' => $this->expMonth,
		'member' => $this->member,
		'cardNo' => $this->cardNo,
		'cardType' => $this->cardType,
		'paymentData' => $this->paymentData,
		'paymentMethod' => $this->paymentMethod,
		'transactionIdentifier' => $this->transactionIdentifier,
		'responseURL' => $this->responseURL,
		'errorURL' => $this->errorURL,
		'transId' => $this->transId,
		'pin' => $this->pin,
		'ticketNo' => $this->ticketNo,
		'bookingId' => $this->bookingId,
		'transactionDate' => $this->transactionDate,
		'authCode' => $this->authCode,
		'ref' => $this->ref,
		'paymentId' => $this->paymentId,
		));
		
		$trandataObj[0] = array_filter($trandataObj[0]);
		
		// var_dump($trandataObj[0]);
		
		$FinalData = array(array(
			'id' => $this->id,
			'trandata' => $this->encrypt($trandataObj,$this->key,$this->iv)
		));
		// var_dump($FinalData);
		return $FinalData;
	}
	
	function encrypt($data,$key,$iv) {
		$encrypted = openssl_encrypt(json_encode($data,true), 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
		$encrypted=unpack('C*', ($encrypted));
		$encrypted=$this->byteArray2Hex($encrypted);
		$encrypted  = urlencode($encrypted);
	  return $encrypted;
	}

	function byteArray2Hex($byteArray) {
		$result = '';
		$HEX_DIGITS = "0123456789abcdef";
		foreach ($byteArray as $value) {
			$result.= $HEX_DIGITS[$value >> 4];
			$result.= $HEX_DIGITS[$value& 0xf];
		}
		return $result;
	}
	
	
	function decryptData($data,$key,$iv) {
		$code =  $this->hex2ByteArray(trim($data));
		$code=$this->byteArray2String($code);
		$code = base64_encode($code);
		$decrypted = openssl_decrypt($code, 'AES-256-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
		return $this->pkcs5_unpad($decrypted);
	}

	
	function hex2ByteArray($hexString) {
	  $string = hex2bin($hexString);
	  return unpack('C*', $string);
	}


	function byteArray2String($byteArray) {
	  $chars = array_map("chr", $byteArray);
	  return join($chars);
	}


	function pkcs5_unpad($text) {
		$pad = ord($text[strlen($text)-1]);
		if ($pad > strlen($text)) {
			return false;	
		}
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad) {
			return false;
		}
		return substr($text, 0, -1 * $pad);
	}

	function performeTransaction(){
		$data = $this->createRequestData();
		$options = array(
		  'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'  => "Content-Type: application/json\r\nAccept: application/json\r\n",
			'timeout' => 3000
			)
		);
		$context  = stream_context_create( $options );
		$requestResult = file_get_contents( $this->endPoint, false, $context );
		$response = json_decode($requestResult, true);
		if($response === false){
			return 0;
		}
		else{
			if(count($response) >0){
				$response = $response[0];
				$this->status = $response['status'];
				if($this->status != 1){
					$this->error = $response['error'];
					$this->errorText = $response['errorText'];
					return 0;
				}
				else{
					$this->result = $response['result'];
					if(isset($response['trandata'])){
						$this->trandata = $response['trandata'];
						if($this->trandata !=""){
							$this->parseResponseTrandata();
						}
					}
					return 1;
				}
			}
			else{
				return 0;
			}
		}
	}
	
	
	function performeInquiry(){
		$data = $this->createRequestData();
		
		$options = array(
		  'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'  => "Content-Type: application/json\r\n"."Accept: application/json\r\n",
			'timeout' => 3000
			)
		);
		$context  = stream_context_create( $options );
		$requestResult = file_get_contents( $this->endPoint, false, $context );
		$response = json_decode($requestResult, true);
		var_dump($response);
		if($response === false){
			return 0;
		}
		else{
			if(count($response) >0){
				$response = $response[0];
				$this->status = $response['status'];
				if($this->status != 1){
					$this->error = $response['error'];
					$this->errorText = $response['errorText'];
					return 0;
				}
				else{
					$this->trandata = $response['trandata'];
					$this->result = $response['tranid'];
					
					return $this->parseResponseTrandata();
				}
			}
			else{
				return 0;
			}
		}
	}
	
	
	function performeUpdate(){
		$data = $this->createRequestData();
		
		$options = array(
		  'http' => array(
			'method'  => 'POST',
			'content' => json_encode( $data ),
			'header'  =>  "Content-Type: application/json\r\nAccept: application/json\r\n",
			'timeout' => 3000
			)
		);
		$context  = stream_context_create( $options );
		$requestResult = file_get_contents( $this->endPoint, false, $context );
		$response = json_decode($requestResult, true);

		if($response === false){
			return 0;
		}
		else{
			if(count($response) >0){
				$response = $response[0];

				$this->status = $response['status'];
				if($this->status != 1){
					$this->error = $response['error'];
					$this->errorText = $response['errorText'];
					return 0;
				}
				else{
					$this->trandata = $response['trandata'];
					$this->result = $response['tranid'];
					
					return $this->parseResponseTrandata();
				}
			}
			else{
				return 0;
			}
		}
	}

	
	function parseResponseTrandata(){
		try{
			$ClearData = $this->decryptData($this->trandata,$this->key,$this->iv);
			
			$obj = json_decode(urldecode($ClearData), true)[0];			
			

			$this->transUpdateTime=isset($obj["transUpdateTime"]) ? $obj["transUpdateTime"] : $this->transUpdateTime;
			$this->authRespCode=isset($obj["authRespCode"]) ? $obj["authRespCode"] : $this->authRespCode;
			$this->transId=isset($obj["transId"]) ? $obj["transId"] : $this->transId;
			$this->trackId=isset($obj["trackId"]) ? $obj["trackId"] : $this->trackId;
			$this->udf1=isset($obj["udf1"]) ? $obj["udf1"] : $this->udf1;
			$this->udf2=isset($obj["udf2"]) ? $obj["udf2"] : $this->udf2;
			$this->udf3=isset($obj["udf3"]) ? $obj["udf3"] : $this->udf3;
			$this->udf4=isset($obj["udf4"]) ? $obj["udf4"] : $this->udf4;
			$this->udf5=isset($obj["udf5"]) ? $obj["udf5"] : $this->udf5;
			$this->udf6=isset($obj["udf6"]) ? $obj["udf6"] : $this->udf6;
			$this->udf7=isset($obj["udf7"]) ? $obj["udf7"] : $this->udf7;
			$this->udf8=isset($obj["udf8"]) ? $obj["udf8"] : $this->udf8;
			$this->result=isset($obj["result"]) ? $obj["result"] : $this->result;
			$this->ref=isset($obj["ref"]) ? $obj["ref"] : $this->ref;
			$this->paymentId=isset($obj["paymentId"]) ? $obj["paymentId"] : $this->paymentId;
			$this->tranDate=isset($obj["date"]) ? $obj["date"] : $this->tranDate;
			$this->authCode=isset($obj["authCode"]) ? $obj["authCode"] : $this->authCode;
			$this->amt=isset($obj["amt"]) ? $obj["amt"] : $this->amt;
			return 1;
		}
		catch(Exception $ex){
			$this->errorText = $ex->getMessage();
			return 0;
		}
		return 0;
	}
	
}

?>