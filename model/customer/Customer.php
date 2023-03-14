<?php 
class Customer {
    protected $id;
    protected $name;
    protected $password;
    protected $email;
    protected $login_by;
    protected $mobile;
    protected $address;
    protected $is_active;
    protected $session_id;
    protected $fail_login;

    function __construct($id, $name, $password, $email, $login_by, $mobile, $address, $is_active, $session_id, $fail_login) {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
        $this->email = $email;
        $this->login_by = $login_by;
        $this->mobile = $mobile;
        $this->address = $address;
        $this->is_active = $is_active;
        $this->session_id = $session_id;
        $this->fail_login = $fail_login;
    }

    function getId() {
        return $this->id;
    }

    function getName() {
        return $this->name;
    }

    function getPassword() {
        return $this->password;
    }

    function getEmail() {
        return $this->email;
    }

    function getLoginBy() {
        return $this->login_by;
    }

    function getMobile() {
        return $this->mobile;
    }

    function getAddress() {
        return $this->address;
    }

    function getIsActive() {
        return $this->is_active;
    }

    function getSessionId() {
        return $this->session_id;
    }

    function getFailLogin() {
        return $this->fail_login;
    }

    function setName($name){
		$this->name = $name;
		return $this;
	}

	function setPassword($password) {
		$this->password = $password;
		return $this;
	}

	function setMobile($mobile) {
		$this->mobile = $mobile;
		return $this;
	}

	function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	function setLoginBy($login_by) {
		$this->login_by = $login_by;
		return $this;
	}

    function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    function setIsActive($is_active) {
		$this->is_active = $is_active; 
		return $this;
	}

    function setSessionId($session_id) {
		$this->session_id = $session_id; 
		return $this;
	}

    function setFailLogin($fail_login) {
		$this->fail_login = $fail_login; 
		return $this;
	}

}

?>