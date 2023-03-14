<?php 
class CommentController {
    function list() {
        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        require "view/comment/list.php";
    }

    function detail() {
        $product_id = $_GET["product_id"];
        $commentRepository = new CommentRepository();
        $comments = $commentRepository->getByProductId($product_id);
        require "view/comment/detail.php";
    }

    function delete() {
        $product_id = $_GET["product_id"];
        $comment_id = $_GET["comment_id"];
        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($comment_id);

        if ($commentRepository->delete($comment)) {
            $_SESSION["success"] = "Xóa đánh giá thành công";
            header("location: index.php?c=comment&a=detail&product_id=$product_id");
            exit;
        }

    }
}
?>