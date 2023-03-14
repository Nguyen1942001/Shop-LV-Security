<?php 
class AccountController {
    function signIn() {
        require "view/login/login.php";
    }

    function signUp() {
        require "view/login/signUp.php";
    }

    function forgetPassword() {
        require "view/login/forgetPassword.php";
    }
}
?>