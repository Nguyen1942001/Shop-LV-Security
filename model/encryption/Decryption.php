<?php 
class Decryption {
    function decrypt($cipher_text) {
        $cipher_algo = "AES-256-CTR";
        $option = 0;
        $decryption_iv = '1234567890123456';
        $decryption_key = "antoanwebvacosodulieu";
        $plain_text = openssl_decrypt($cipher_text, $cipher_algo, $decryption_key, $option, $decryption_iv);
        return $plain_text;
    }
}


?>