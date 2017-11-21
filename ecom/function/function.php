<?php

//Update Cookies
function update_cookies() {
    $bm360_id = filter_input(INPUT_COOKIE, "devtest_bm360_id");
    $bm360_auth = filter_input(INPUT_COOKIE, "devtest_bm360_auth");
    if ($bm360_id && $bm360_auth) {
        setcookie('devtest_bm360_id', $bm360_id, time() + 1800, '/');
        setcookie('devtest_bm360_auth', $bm360_auth, time() + 1800, '/');
        return true;
    }
    else {
        return false;
    }
}


//Generate Random String
function rand_string($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    for ($i = 0; $i < $length; $i++) {
        $str .= $chars[rand(0, $size - 1)];
    }
    return $str;
}

// Audit Trail
// FORMAT
// ADD: ADD - DATA - TABLE E.G.: Add - name=tester1@username=12 - Condition - Member
// DELETE: DELETE - DATA - TABLE E.G.: Delete - name=tester1@username=12 - Condition - Member
// UPDATE: UPDATE - DATA - TABLE E.G.: Update - name=tester1@username=12 - Condition - Member
function audit_trail($type,$data,$table,$condition){
	$member = $GLOBALS['member'];
	$mysqli = $GLOBALS['mysqli'];
	$stmt=$mysqli->prepare("INSERT INTO audit_trail_member 
	(member_id,audit_trail_member_type,audit_trail_member_data,audit_trail_member_condition,audit_trail_member_table) 
	VALUES (?,?,?,?,?);");
	$stmt->bind_param("issss",$member->getMember_id(),$type,$data,$condition,$table);
	$stmt->execute();
}

function display_currency($value) {
    if ($_COOKIE['currency_code'] != "") {
        $code = $_COOKIE['currency_code'];
    } else {
        $code = "RMB";
    }
    $mysqli = $GLOBALS['mysqli'];
    $stmt = $mysqli->prepare("select currency_rate,currency_symbol from currency where currency_code=?");
    $stmt->bind_param("s", $code);
    $stmt->execute();
    $stmt->bind_result($currency_rate,$currency_symbol);
    $stmt->fetch();

	return $currency_symbol . " " . number_format(($value * $currency_rate), 2);    
	
}