<?php 
class CartStorage {
    function store($cart) {
        $_SESSION["cart"] = serialize($cart);
        setcookie("cart", serialize($cart), time() + 24 * 60 * 60); // giữ giỏ hàng trong 1 ngày
    }


    function fetch() {
        if (empty($_SESSION["cart"])) {
            if (empty($_COOKIE["cart"])) {
                $cart = new Cart();
                return $cart;
            }
            $_SESSION["cart"] = $_COOKIE["cart"];
        }   
        $cart = unserialize($_SESSION["cart"]);
        return $cart;
    }


    // Xóa giỏ hàng được lưu trong SESSON và COOKIE sau khi đặt hàng xong
    function clear() {
		session_id() || session_start();
		unset($_SESSION["cart"]);
		setcookie("cart", null,  time()-24*60*60);
	}
}
?>