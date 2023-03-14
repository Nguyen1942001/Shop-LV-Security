<?php 
class HomeController {
    function index() {
        $productRepository = new ProductRepository();
        $conds = "@FEATURED = 1";
        $sorts = [];
        $featuredProducts = $productRepository->getFetchAll($conds);

        require "view/home/index.php";
    }
}
?>