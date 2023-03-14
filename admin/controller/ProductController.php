<?php 
class ProductController {
    function list() {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        require "view/product/list.php";
    }
    
    function add() {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        require "view/product/add.php";
    }

    function edit() {
        $product_id = $_GET["product_id"];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);

        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();

        $arrayProductDetail = $product->getSizeAndQty();
        require "view/product/edit.php";
    }

    function save() {
        $imageService = new ImageService();

        // $filename là tên của hình ảnh (VD: abc.jbg)
		$filename = $imageService->getCorrectImage($_FILES["image"]["name"]);

        $data = [];
        $data["name"] = $_POST["name"];
		$data["price"] = $_POST["price"];
		$data["featured_image"] = $filename;
		$data["created_date"] = date("Y-m-d H:i:s");
		$data["short_description"] = $_POST["short_description"];
		$data["full_description"]= $_POST["full_description"];
        if (!empty($_POST["featured"])) {
            $data["featured"] = 1;
        }
		else {
            $data["featured"] = 0;
        }
		$data["category_id"] = $_POST["category_id"];

        $arraySize = ["S", "M", "L", "XL"];
        $arrayQty = [$_POST["qty1"], $_POST["qty2"], $_POST["qty3"], $_POST["qty4"]];

        $productRepository = new ProductRepository();
        $productDetailRepository = new ProductDetailRepository();

        $last_id = 0;
        if ($last_id = $productRepository->save($data)) {
            $src = $_FILES["image"]["tmp_name"];  // Đường dẫn lưu file tạm do PHP tự tạo khi mình upload hình ảnh
			$des = "../upload/$filename";   // thư mục muốn lưu hình trong project
			move_uploaded_file($src, $des);

            if ($productDetailRepository->save($arraySize, $arrayQty, $last_id)) {
                $_SESSION["success"] = "Thêm sản phẩm mới thành công";
                header("location: index.php?c=product");
                exit;
            }
        }
    }

    function update() {
		$product_id = $_POST["product_id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);

		//set giá trị mới
		$product->setName($_POST["name"]);
		$product->setPrice($_POST["price"]);
        if (!empty($_POST["featured"])) {
            $product->setFeatured($_POST["featured"]);
        }
        else {
            $product->setFeatured(0);
        }
		$product->setCategoryId($_POST["category_id"]);
		$product->setShortDescription($_POST["short_description"]);
		$product->setFullDescription($_POST["full_description"]);


		if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {

			// 1. Delete hình trước
			$oldFile = "../upload/" . $product->getFeaturedImage();
			if (file_exists($oldFile)) {
				unlink($oldFile);
			}

			// 2. Move hình mới vô
			$imageService = new ImageService();
			$correctFileName = $imageService->getCorrectImage($_FILES["image"]["name"]);
			$newFile = "../upload/" . $correctFileName;
			move_uploaded_file($_FILES["image"]["tmp_name"], $newFile);

			// 3. Cập nhật setFeaturedImage để lưu xuống database là tên mới
			$product->setFeaturedImage($correctFileName);
		}

        // Lấy size và số lượng của sp
        $arraySize = ["S", "M", "L", "XL"];
        $arrayQty = [$_POST["qty1"], $_POST["qty2"], $_POST["qty3"], $_POST["qty4"]];
        $productDetailRepository = new ProductDetailRepository();


		if ($productRepository->update($product)) {
            for ($i = 0; $i < count($arraySize); $i++) {
                $productDetailRepository->updateQty($product_id, $arraySize[$i], $arrayQty[$i]);
            }
            $_SESSION["success"] = "Cập nhật thông tin sản phẩm thành công";
			header("location: index.php?c=product");
			exit();
		}
	}

    function delete() {
		$product_id = $_GET["product_id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);
		$file = "../upload/" . $product->getFeaturedImage();
		unlink($file); // xóa hình của sp

        $productDetailRepository = new ProductDetailRepository();
		if ($productDetailRepository->delete($product_id)) {
            if($productRepository->delete($product)) {
                $_SESSION["success"] = "Xóa sản phẩm thành công";
                header("location: index.php?c=product");
                exit();
            }
        }
	}
}

 ?>