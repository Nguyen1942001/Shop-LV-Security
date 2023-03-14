<?php 
class ProductDetail {
    protected $id;
    protected $product_id;
    protected $size;
    protected $qty;

    function __construct($id, $product_id, $size, $qty) {
        $this->id = $id;
        $this->product_id = $product_id;
        $this->size = $size;
        $this->qty = $qty;
    }

    function getId() {
        return $this->id;
    }

    function getProductId() {
        return $this->product_id;
    }

    function getSize() {
        return $this->size;
    }

    function getQty() {
        return $this->qty;
    }

    function setProductId($product_id) {
        $this->product_id = $product_id;
        return $this;
    }

    function setSize($size) {
        $this->size = $size;
        return $this;
    }

    function setQty($qty) {
        $this->qty = $qty;
        return $this;
    }
}
?>