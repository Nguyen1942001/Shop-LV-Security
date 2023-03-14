<?php 
class Encryption {
    function encrypt($plain_text) {
        $cipher_algo = "AES-256-CTR";
        $option = 0;
        $encryption_iv = '1234567890123456';
        $encryption_key = "antoanwebvacosodulieu";
        $cipher_text = openssl_encrypt($plain_text, $cipher_algo, $encryption_key, $option, $encryption_iv);
        return $cipher_text;
    }
}


?>