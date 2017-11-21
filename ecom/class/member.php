<?php

class Member {

    private $member_id;
    private $member_name;
	private $member_email;
	private $member_birthday;
	private $member_gender;
	private $member_address;
	private $member_postcode;
	private $member_city;
	private $member_province;
	private $member_country;
	private $member_phone;
	// private $member_ic;
    // private $member_username;
    // private $member_password;
    // private $member_wechat_id;
    // private $member_bank_id;
    // private $member_bank_acc_number;
	// private $member_bank_acc_name;
    // private $member_sponsor_id;
    // private $member_level_id;
    // private $member_activation;
	// private $member_type_id;

    // function member($member_id, $member_name, $member_phone, $member_email, $member_username, $member_password, $member_wechat_id, $member_bank_name, $member_bank_account_name, $member_bank_account_number, $member_sponsor_id, $member_level_id, $member_activation, $member_type_id) {
		function member($member_id, $member_name, $member_email, $member_birthday, $member_gender, $member_address, $member_postcode, $member_city, $member_province, $member_country, $member_phone) {
        $this->member_id = $member_id;
		$this->member_name = $member_name;
        $this->member_email = $member_email;
		$this->member_birthday = $member_birthday;
		$this->member_gender = $member_gender;
		$this->member_address = $member_address;
		$this->member_postcode = $member_postcode;
		$this->member_city = $member_city;
		$this->member_province = $member_province;
		$this->member_country = $member_country;
		$this->member_phone = $member_phone;
		// $this->member_ic = $member_ic;
        // $this->member_username = $member_username;
        // $this->member_password = $member_password;
        // $this->member_wechat_id = $member_wechat_id;
        // $this->member_bank_id = $member_bank_id;
        // $this->member_bank_acc_number = $member_bank_acc_number;
		// $this->member_bank_acc_name = $member_bank_acc_name;
        // $this->member_sponsor_id = $member_sponsor_id;
        // $this->member_level_id = $member_level_id;
        // $this->member_activation = $member_activation;
		// $this->member_type_id = $member_type_id;
    }

    function getMember_id() {
        return $this->member_id;
    }

    function getMember_name() {
        return $this->member_name;
    }

    function getMember_email() {
        return $this->member_email;
    }
	
	function getMember_birthday(){
		return $this->member_birthday;
	}
	
	function getMember_gender(){
		return $this->member_gender;
	}

	function getMember_address(){
		return $this->member_address;
	}
	
	function getMember_postcode(){
		return $this->member_postcode;
	}
	
	function getMember_city(){
		return $this->member_city;
	}
	
	function getMember_province(){
		return $this->member_province;
	}
	
	function getMember_country(){
		return $this->member_country;
	}
	
	function getMember_phone(){
		return $this->member_phone;
	}
	// function getMember_ic() {
		// return $this->member_ic;
	// }
    // function getMember_username() {
        // return $this->member_username;
    // } 

    // function getMember_wechat_id() {
        // return $this->member_wechat_id;
    // }

    // function getMember_bank_id() {
        // return $this->member_bank_id;
    // }

	// function getMember_bank_acc_number() {
        // return $this->member_bank_acc_number;
    // }
	
    // function getMember_bank_acc_name() {
        // return $this->member_bank_acc_name;
    // }

    // function getMember_sponsor_id() {
        // return $this->member_sponsor_id;
    // }

    // function getMember_level_id() {
        // return $this->member_level_id;
    // }

    // function getMember_activation() {
        // return $this->member_activation;
    // }
	
	// function getMember_type_id() { 
        // return $this->member_type_id;
    // }

}

?>