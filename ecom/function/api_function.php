<?php
//1.login request
function login_request($phone,$password){
	$query_string = "user_login.php";
    $query_string .= "?phone=".$phone."&password=".$password;
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}	
//2.reload product
function reload_product(){
	$query_string = "reload_products.php";
    $query_string .= "?code=all";
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}	
//3.reload request (not done)
function reload_request(){
	$url = 'http://103.51.41.134/localuser/wp_services/reload.php';
	$data = array('prodId' => $prodId, 'login_uid' => $login_uid , 'txtAmt' => $txtAmt, 'txtMobile' => $txtMobile, 'txtEmail' => $txtEmail, 'ExtID' => $ExtID);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	return $result;
}
//4.reload status request
function reload_status_request($reload_id){
	$query_string = "reload_status.php";
    $query_string .= "?reload_id=".$reload_id;
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}

//5.product(device) list
function device_list(){
	$query_string = "products_devices.php";
    $query_string .= "?devices=all";
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}

//6.buy product request
function buy_product_request($name,$phone,$ship_address,$productID,$productQty,$invoiceEmail,$userID,$ExtID){
	$url = 'http://103.51.41.134/localuser/wp_services/product_purchase.php';
	$data = array('name' => $name, 'phone' => $phone , 'ship_address' => $ship_address, 'productID' => $productID, 'productQty' => $productQty, 'invoiceEmail' => $invoiceEmail,'userID' =>$userID ,'ExtID' => $ExtID);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	
	// $query_string = "product_purchase.php";
    // $query_string .= "?name=".$name."&phone=".$phone."&shipAddress".$ship_address."&productID".$productID."&productQty".$productQty;
	// $query_string .= "&invoiceEmail".$invoiceEmail."&userID".$userID."&ExtID".$ExtID;
    // $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    // $fd = @implode('', file($url));

    return $result;
}

//7.account balance request
function account_balance_request($user_id){
	$query_string = "user_balance_info.php";
    $query_string .= "?user_id=".$user_id;
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}

//8.register user request
function register_user_request($name,$phone,$upline_id,$email){
	$url = 'http://103.51.41.134/localuser/wp_services/user_register_request.php';
	$data = array('name' => $name, 'phone' => $phone , 'upline_id' => $upline_id, 'email' => $email);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

    return $result;
}

//9.credit transfer
function credit_transfer($user_id,$password,$transferTo,$transferAmt,$transferType){
	$url = 'http://103.51.41.134/localuser/wp_services/credit_transfer.php';
	$data = array('user_id' => $user_id, 'password' => $password , 'transferTo' => $transferTo, 'transferAmt' => $transferAmt, 'transferType' => $transferType);

	// use key 'http' even if you send the request to https://...
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

    return $result;
}

//10.transaction report
function transaction_report($user_id,$status,$start_date,$end_date){
	$query_string = "report_transaction.php";
    $query_string .= "?user_id=".$user_id."&status=".$status."&start_date=".$start_date."&end_date=".$end_date;
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
} 

//11.incentive report
function incentive_report($user_id,$start_date,$end_date){
	$query_string = "report_incentives.php";
    $query_string .= "?user_id=".$user_id."&start_date=".$start_date."&end_date=".$end_date;
    $url = "http://103.51.41.134/localuser/wp_services/" . $query_string;

    $fd = @implode('', file($url));

    return $fd;
}
?>