<?php 
class ImageItemController {
    function detail() {
        //Liệt kê những hình ảnh chụp ở những khía cạnh khác nhau của product
		$product_id = $_GET["product_id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);
		include "view/imageItem/detail.php";
    }

    function save(){
		$product_id = $_GET["product_id"];
        $productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);

		if (!empty($_FILES["image"]["name"]) && $_FILES["image"]["error"] == 0) {

            // Tạo thư mục để lưu các hình ảnh phụ (Trường hợp: khi mới thêm hình ảnh phụ lần đầu)
            $dir = "../upload/product/" . $product->getCategory()->getName() . "/" . $product->getName();

			$imageService = new ImageService();

            // Tên file hình ảnh sau khi quét qua thư mục xem có bị trùng không
			$correctFileName = $imageService->getCorrectImage($_FILES["image"]["name"], $dir);  
			$data = [];
			$data["name"] = $correctFileName;  // Tên file hình ảnh
			$data["product_id"] = $product_id;

            // if đầu tiên là thư mục chưa có
            if (!file_exists($dir)) {
                // Tạo một thư mục mới
                if (mkdir($dir)) {
                    $imageItemRepository = new ImageItemRepository();
                    if ($imageItemRepository->save($data)) {
                        //Move file vào upload
                        $newFile = "../upload/product/" . $product->getCategory()->getName() . "/" . $product->getName() . "/" . $correctFileName;
                        move_uploaded_file($_FILES["image"]["tmp_name"], $newFile);
        
                        $_SESSION["success"] = "Thêm hình ảnh phụ của sản phẩm {$product->getName()} thành công";
                        header("location: index.php?c=imageItem&a=detail&product_id=$product_id");
                        exit();
                    }
                } 
            } 

            // else là thư mục đã có sẵn, ko cần tạo mới
            else {
                $imageItemRepository = new ImageItemRepository();
                if ($imageItemRepository->save($data)) {
                    //Move file vào upload
                    $newFile = "../upload/product/" . $product->getCategory()->getName() . "/" . $product->getName() . "/" . $correctFileName;
                    move_uploaded_file($_FILES["image"]["tmp_name"], $newFile);
        
                    $_SESSION["success"] = "Thêm hình ảnh phụ của sản phẩm {$product->getName()} thành công";
                    header("location: index.php?c=imageItem&a=detail&product_id=$product_id");
                    exit();
                }
            }
		}
	}

    function delete() {
        $imageItem_id = $_GET["imageItem_id"];
        $imageItemRepository = new ImageItemRepository();
        $imageItem = $imageItemRepository->find($imageItem_id);
        $filename = $imageItem->getName();

        $product_id = $_GET["product_id"];
        $productRepository = new ProductRepository();
		$product = $productRepository->find($product_id);

        if ($imageItemRepository->delete($imageItem)) {
            $removedPath = "../upload/product/" . $product->getCategory()->getName() . "/" . $product->getName() . "/" . $filename;
			if (file_exists($removedPath)) {
				if (unlink($removedPath)) {
                    $_SESSION["success"] = "Xóa hình ảnh phụ của sản phẩm {$product->getName()} thành công";
                    header("location: index.php?c=imageItem&a=detail&product_id=$product_id");
                    exit();
                }
			}
        }
    }
}
?>