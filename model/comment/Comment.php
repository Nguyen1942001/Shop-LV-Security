<?php 
class Comment {
	protected $id;
	protected $email;
	protected $fullname;
	protected $created_date;
	protected $description;
	protected $product_id;

	function __construct($id, $email, $fullname, $created_date, $description, $product_id){
		$this->id = $id;
		$this->email = $email;
		$this->fullname = $fullname;
		$this->created_date = $created_date;
		$this->description = $description;
		$this->product_id = $product_id;
		
	}

	function getId() {
		return $this->id;
	}

	function getEmail() {
		return $this->email;
	}

	function getFullname() {
		return $this->fullname;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getDescription() {
		return $this->description;
	}

	function getProductId() {
		return $this->product_id;
	}

	function setEmail($email) {
		$this->email = $email;
		return $this;
	}

	function setFullname($fullname) {
		$this->fullname = $fullname;
		return $this;
	}

	function setCreatedDate($created_date) {
		$this->created_date = $created_date;
		return $this;
	}

	function setDescription($description) {
		$this->description = $description;
		return $this;
	}

	function setProductId($product_id) {
		$this->product_id = $product_id;
		return $this;
	}

	function getProduct() {
		$productRepository = new ProductRepository();
		$product = $productRepository->find($this->product_id);
		return $product;
	}

}
