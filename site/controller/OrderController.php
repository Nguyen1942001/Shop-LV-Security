<?php 
class OrderController {
    function index() {
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($_SESSION["email"]);

        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getByCustomerId($customer->getId());
        require "view/order/index.php";
    }

    // Lấy ra các sản phẩm của đơn hàng tương ứng
    function orderDetail() {
        $order_id = $_GET["order_id"];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);
        $orderItems = $order->getOrderItems();
        require "view/order/orderDetail.php";
    }
}

?>