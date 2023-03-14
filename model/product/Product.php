<?php 
class Product {
    protected $id;
    protected $name;
    protected $price;
    protected $featured_image;
    protected $category_id;
    protected $created_date;
    protected $short_description;
    protected $full_description;
    protected $featured;

    function __construct($id, $name, $price, $featured_image, $category_id, $created_date, $short_description, $full_description, $featured) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->featured_image = $featured_image;
        $this->category_id = $category_id;
        $this->created_date = $created_date;
        $this->short_description = $short_description;
        $this->full_description = $full_description;
        $this->featured = $featured;
    }

    function getId() {
		return $this->id;
	}

	function getName() {
		return $this->name;
	}

	function getPrice() {
		return $this->price;
	}

	function getFeaturedImage() {
		return $this->featured_image;
	}

    function getCategoryId() {
		return $this->category_id;
	}

	function getCreatedDate() {
		return $this->created_date;
	}

	function getShortDescription() {
		return $this->short_description;
	}

    function getFullDescription() {
		return $this->full_description;
	}

	function getFeatured() {
		return $this->featured;
	}

	function setName($name) {
		$this->name = $name;
		return $this;
	}

	function setPrice($price) {
		$this->price = $price;
		return $this;
	}

	function setFeaturedImage($featured_image) {
		$this->featured_image = $featured_image;
		return $this;
	}

    function setCategoryId($category_id) {
		$this->category_id = $category_id;
		return $this;
	}

	function setCreatedDate($created_date) {
		$this->created_date = $created_date;
		return $this;
	}

	function setShortDescription($short_description) {
		$this->short_description = $short_description;
		return $this;
	}

    function setFullDescription($full_description) {
		$this->full_description = $full_description;
		return $this;
	}

    function setFeatured($featured) {
		$this->featured = $featured;
		return $this;
	}


	// ================ Các hàm riêng lẻ ================

	function getCategory() {
		$categoryRepository = new CategoryRepository();
		$category = $categoryRepository->find($this->category_id);
		return $category;
	}

	function getImageItems() {
		$imageItemRepository = new ImageItemRepository();
		$imageItems = $imageItemRepository->getByProductId($this->id);
		return $imageItems;
	}

	function getComments() {
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($this->id);
		return $comments;
	}

	function getSizeAndQty() {
		$productDetailRepository = new ProductDetailRepository();
		$arrayProductDetail = $productDetailRepository->getByProductId($this->id);
		return $arrayProductDetail;
	}

	// Lấy tổng số lượng sp trong kho (bất kể size nào)
	function getTotalQty() {
		$arrayProductDetail = $this->getSizeAndQty();
		$totalQty = 0;
		foreach ($arrayProductDetail as $productDetail) {
			$totalQty += $productDetail["qty"];
		}
		return $totalQty;
	}

	// Lấy tổng số lượng đánh giá của sp
	function getTotalComment() {
		$commentRepository = new CommentRepository();
		$comments = $commentRepository->getByProductId($this->id);  // danh sách các đánh giá của sp
		$totalComment = count($comments);
		return $totalComment;
	}

	// Chuyển đối tượng product thành mảng
	function convertToArray() {
		$a = array();
		$a["product_id"] = $this->id;
		$a["name"] = $this->name;
		$a["featured_image"] = $this->featured_image;
		$a["price"] = $this->price;
		// $a["qty_of_size"] 
		return $a;
	}
}
?>