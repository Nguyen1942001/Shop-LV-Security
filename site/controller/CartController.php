<?php 
class CartController {
    protected $cartStorage;

    function __construct() {
		$this->cartStorage = new CartStorage();
	}

    function add() {
        $product_id = $_GET["product_id"];
		$size = $_GET["size"];
        $qty = $_GET["qty"];

		$cart = $this->cartStorage->fetch();
        $cart->addProduct($product_id, $size, $qty);
        $this->cartStorage->store($cart);

        echo json_encode($cart->convertToArray());
    }

    function delete() {
		$product_id = $_GET["product_id"];
		$size = $_GET["size"];
		$cart = $this->cartStorage->fetch();

		$cart->deleteProduct($product_id, $size);

		$this->cartStorage->store($cart);

		echo json_encode($cart->convertToArray());
	}

    function display() {
		$cart = $this->cartStorage->fetch();
		echo json_encode($cart->convertToArray());
	}

	function update() {
		$product_id = $_GET["product_id"];
		$qty = $_GET["qty"];
		$size = $_GET["size"];
		$cart = $this->cartStorage->fetch();

		$cart->deleteProduct($product_id, $size);
		$cart->addProduct($product_id, $size, $qty);

		$this->cartStorage->store($cart);

		echo json_encode($cart->convertToArray());
	}
}
?>