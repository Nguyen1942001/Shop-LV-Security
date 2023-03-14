<?php 
require '..\vendor\autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if (empty($_SESSION["username"])) {
	if (!empty($_COOKIE["token"])) {
		//giải mã
		$key = JWT_KEY;
		try {
			$payload = JWT::decode($_COOKIE["token"], new Key($key, 'HS256'));

			$_SESSION["username"] = $payload->username;
			$_SESSION["name"] = $payload->name;
		} catch(Exception $e) {
			echo "You try to hack!!!";
			exit;
		}
	}
	else {
		header("location: login.php");
		exit;
	}
	
}
?>