<?php

class admin {

    private $admin_id;
    private $admin_name;
    private $admin_phone;
    private $admin_email;
    private $admin_username; 

    function admin($admin_id, $admin_name, $admin_phone, $admin_email, $admin_username) {
        $this->admin_id = $admin_id;
        $this->admin_name = $admin_name;
        $this->admin_phone = $admin_phone;
        $this->admin_email = $admin_email;
        $this->admin_username = $admin_username; 
    }

    function getadmin_id() {
        return $this->admin_id;
    }

    function getadmin_name() {
        return $this->admin_name;
    }

    function getadmin_phone() {
        return $this->admin_phone;
    }

    function getadmin_email() {
        return $this->admin_email;
    }

    function getadmin_username() {
        return $this->admin_username;
    }  
}
