<?php 
class DashboardController {
    function list() {
        $customerRepository = new CustomerRepository();
        $customers = $customerRepository->getAll();
        $numberCustomer = count($customers);

        $productRepository = new ProductRepository();
        $products = $productRepository->getAll();
        $numberProduct = count($products);

        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getAll();
        $revenue = 0;
        foreach ($orders as $order) {
            $revenue += $order->getTotalPrice();
        }
        require "view/dashboard/list.php";
    }
}

?>