<?php 
class PaymentController {
    function cartDetail() {
        $cartStorage = new CartStorage();
        $cart = $cartStorage->fetch();
        require "view/payment/cart.php";
    }


    function checkout() {
        $cartStorage = new CartStorage();
        $cart = $cartStorage->fetch();

        $email = "khachvanglai@gmail.com";
        if (!empty($_SESSION["email"])) {
            $email = $_SESSION["email"];
        }
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        require "view/payment/checkout.php";
    }


    function order() {
        $encryption = new Encryption();

        $cartStorage = new CartStorage();
        $cart = $cartStorage->fetch();

        // Kiểm tra số lượng sp trước khi đặt hàng
        $items = $cart->getItems();  // Láy danh sách các sp trong cart
        $productRepository = new ProductRepository();

        foreach($items as $item) {
            $product_id = $item["product_id"];
            $product = $productRepository->find($product_id);

            // Kiểm tra từng sp xem size và số lượng đó còn hàng không
            for ($i = 0; $i < count($product->getSizeAndQty()); $i++) {
                if ($product->getSizeAndQty()[$i]["size"] == $item["size"] && $product->getSizeAndQty()[$i]["qty"] < $item["qty"]) {
                    $size = $product->getSizeAndQty()[$i]["size"];
                    if ($product->getSizeAndQty()[$i]["size"] == null) {
                        $size = "Không";
                    }
                    $_SESSION["error"] = "{$product->getName()}, kích cỡ: {$size}, chỉ còn {$product->getSizeAndQty()[$i]["qty"]} sản phẩm, bạn đã đặt {$item["qty"]} sản phẩm";
                    header("location: index.php");
                    exit;
                }
            }
        }

        // Đặt đơn hàng
        $email = "khachvanglai@gmail.com";
        if (!empty($_SESSION["email"])) {
            $email = $_SESSION["email"];
        }

        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        $data = array();
        $data["created_date"] = date("Y-m-d H:i:s");
        $data["order_status_id"] = 1;
        $data["staff_id"] = null;
        $data["customer_id"] = $customer->getId();
        $data["shipping_fullname"] = $encryption->encrypt(htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8"));
        $data["shipping_mobile"] = $encryption->encrypt(htmlspecialchars($_POST["mobile"], ENT_QUOTES, "UTF-8"));
        $data["payment_method"] = $_POST["payment_method"];
        $data["address"] = $encryption->encrypt(htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8"));
        $data["delivered_date"] = date("Y-m-d H:i:s", strtotime("+3 days"));

        $orderRepository = new OrderRepository();
        $orderItemRepository = new OrderItemRepository();

        if ($orderId = $orderRepository->save($data)) {
            $items = $cart->getItems(); // Lấy các sản phẩm trong đơn hàng để lưu vào chi tiết đơn hàng (orderItem)
            foreach ($items as $item) {
                $dataItem = array();
                $dataItem["product_id"] = $item["product_id"];
                $dataItem["order_id"] = $orderId;
                $dataItem["qty"] = $item["qty"];
                $dataItem["size"] = $item["size"];
                $dataItem["unit_price"] = $item["unit_price"];
                $dataItem["total_price"] = $item["total_price"];
                $orderItemRepository->save($dataItem);

                // Cập nhật lại số lượng sp trong kho hàng
                $product = $productRepository->find($dataItem["product_id"]);
                for ($i = 0; $i < count($product->getSizeAndQty()); $i++) {
                    if ($product->getSizeAndQty()[$i]["size"] == $item["size"]) {
                        $updatedInventoryQty = $product->getSizeAndQty()[$i]["qty"] - $item["qty"];
                        break;
                    }
                }
                $productDetailRepository = new ProductDetailRepository();
                $productDetailRepository->updateQty($dataItem["product_id"], $dataItem["size"], $updatedInventoryQty);
            }
            $_SESSION["success"] = "Bạn đã đặt hàng thành công";
            $cartStorage->clear();
        }
        else {
            $_SESSION["error"] = $orderRepository->getError();
        }
        header("location: index.php?c=confirmation");

    }
}

?>