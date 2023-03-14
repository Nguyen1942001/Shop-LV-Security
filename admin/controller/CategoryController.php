<?php
class CategoryController
{
    function list() {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->getAll();
        require "view/category/list.php";
    }

    function add() {
        require "view/category/add.php";
    }

    function edit() {
        $categoryRepository = new CategoryRepository();
        $category_id = $_GET["category_id"];
        $category = $categoryRepository->find($category_id);
        require "view/category/edit.php";
    }

    function update() {
        $category_id = $_POST["category_id"];
        $category_name = $_POST["category_name"];

        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($category_id);
        $oldName = "../upload/product/" . $category->getName();  // đường dẫn thư mục cũ

        $category->setName($category_name);  // Lưu tên danh mục mới
        $newName = "../upload/product/" . $category_name;  // đường dẫn thư mục mới

        // Kiểm tra xem đã tồn tại tên danh mục này chưa
        if (count($categoryRepository->getAll("NAME = '$category_name'")) > 0) {
            $_SESSION["error"] = "Tên danh mục này đã tồn tại";
            header("location: index.php?c=category");
            exit;
        }
        
        if ($categoryRepository->update($category)) {
            if (file_exists($oldName)) {
                if (rename($oldName, $newName)) {
                    $_SESSION["success"] = "Đổi tên danh mục thành công";
                    header("location: index.php?c=category");
                    exit;
                }
            }
        }
    }

    function delete() {
        $categoryRepository = new CategoryRepository();
        $category_id = $_GET["category_id"];
        $category = $categoryRepository->find($category_id);

        $dir = "../upload/product/" . $category->getName();

        // Thư mục có sẵn
        if (file_exists($dir)) {
            if (rmdir($dir)) {
                if ($categoryRepository->delete($category)) {
                    $_SESSION["success"] = "Xóa danh mục thành công";
                    header("location: index.php?c=category");
                    exit;
                }
            }
        }

        // Không có thư mục
        else {
            if ($categoryRepository->delete($category)) {
                $_SESSION["success"] = "Xóa danh mục thành công";
                header("location: index.php?c=category");
                exit;
            }
        }
    }

    // Kiểm tra xem danh mục sp đã có sp chưa, nếu chưa thì cho phép xóa, nếu có thì ngăn chặn xóa
    function checkDelete() {
        $category_id = $_GET["category_id"];
        $categoryRepository = new CategoryRepository();
        $category = $categoryRepository->find($category_id);
        $products = $category->getProducts();

        if (count($products) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Danh mục {$category->getName()} có sản phẩm, không thể xóa"]);
			return;
		}
		//xóa được
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
		return;
    }

    function save() {
        $category_name = $_POST["category_name"];
        $categoryRepository = new CategoryRepository();
        $data = [];
		$data["category_name"] = $category_name;
        if (count($categoryRepository->getAll("@NAME = N'$category_name'")) > 0) {
            $_SESSION["error"] = "Tên danh mục này đã tồn tại";
            header("location: index.php?c=category");
            exit;
        }

		if ($last_id = $categoryRepository->save($data)) {
            $category = $categoryRepository->find($last_id);
            $dir = "../upload/product/" . $category->getName();

            // Thư mục chưa có
            if (!file_exists($dir)) {
                if (mkdir($dir)) {
                    $_SESSION["success"] = "Thêm danh mục mới thành công";
                    header("location: index.php?c=category");
                    exit;
                }
            }
		}
    }
}
