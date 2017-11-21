<?php

//Update Cookies
function update_cookies() {
    $admin_bm360_id = filter_input(INPUT_COOKIE, "devtest_admin_bm360_id");
    $admin_bm360_auth = filter_input(INPUT_COOKIE, "devtest_admin_bm360_auth");
    if ($admin_bm360_id && $admin_bm360_auth) {
        setcookie('devtest_admin_bm360_id', $admin_bm360_id, time() + 1800, '/');
        setcookie('devtest_admin_bm360_auth', $admin_bm360_auth, time() + 1800, '/');
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
	$admin = $GLOBALS['admin'];
	$mysqli = $GLOBALS['mysqli'];
	$stmt=$mysqli->prepare("INSERT INTO audit_trail_admin 
	(admin_id,audit_trail_admin_type,audit_trail_admin_data,audit_trail_admin_condition,audit_trail_admin_table) 
	VALUES (?,?,?,?,?);");
	$stmt->bind_param("issss",$admin->getAdmin_id(),$type,$data,$condition,$table);
	$stmt->execute();
}

function select_name($id,$column_id,$column,$table,$mysqli){
	$stmt = $mysqli->prepare("SELECT ".$column." FROM ".$table." WHERE ".$column_id."=?");
	$stmt ->bind_param('i',$id);
	$stmt ->execute();
	$stmt ->store_result();
	$stmt ->bind_result($value);
	$stmt ->fetch();
	return $value;
}

function generate_prefix($length, $strength) {
    $vowels = 'aeuy';
    $consonants = 'bdghjmnpqrstvz';
    if ($strength & 1) {
        $consonants .= 'AEIUYBDGHJLMNPQRSTVWXZ';
    }
    if ($strength & 4) {
        $consonants .= '123456789';
    }
    if ($strength & 8) {
        $consonants .= '@#$%';
    }
    $password = '';
    $alt = time() % 2;
    for ($i = 0; $i < $length; $i++) {
        if ($alt == 1) {
            $password .= $consonants[(rand() % strlen($consonants))];
            $alt = 0;
        } else {
            $password .= $vowels[(rand() % strlen($vowels))];
            $alt = 1;
        }
    }
    return $password;
}

function gw_send_sms($sms_to, $sms_msg) {
    // $query_string = "xmlgateway.php?command=sendRandom&email=fruitskingdom.gwg@gmail.com&password=7639";
    // $query_string .= "&customer=" . $sms_to . "&text=" . urlencode(stripslashes($sms_msg));
    // $url = "https://www.sms123.net/" . $query_string;

    // $fd = @implode('', file($url));

    // return $fd;
	return 1111;
}

function oversea_send_sms($sms_to, $sms_msg) {
    // $query_string = "xmlgateway.php?command=sendLongCode&email=fruitskingdom.gwg@gmail.com&password=7639";
    // $query_string .= "&customer=" . $sms_to . "&text=" . urlencode(stripslashes($sms_msg));
    // $url = "https://www.sms123.net/" . $query_string;

    // $fd = @implode('', file($url));

    // return $fd;
	return 1111;
}

?>