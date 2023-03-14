<?php 
class OrderController {
    function list() {
        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getAll();
        require "view/order/list.php";
    }
    
    function add() {
        $customerRepository = new CustomerRepository();
        $customers = $customerRepository->getAll();

        $statusRepository = new StatusRepository();
        $statuses = $statusRepository->getAll();

        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();
        require "view/order/add.php";
    }

    function edit() {
        $order_id = $_GET["order_id"];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);

        $statusRepository = new StatusRepository();
        $statuses = $statusRepository->getAll();

        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();

        $orderItems = $order->getOrderItems();
        require "view/order/edit.php";
    }

    // Cập nhật thông tin khách hàng khi chọn khách hàng
    function getCustomerInfomation() {
        $customer_id = $_GET["customer_id"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($customer_id);

        $data = array();
        $data["shipping_fullname"] = $customer->getName();
        $data["email"] = $customer->getEmail();
		$data["shipping_mobile"] = $customer->getMobile();
        $data["address"] = $customer->getAddress();

        echo json_encode($data);
    }

    // Tìm kiếm sp ở phần thêm vào đơn hàng bằng ajax
    function ajaxSearchProduct () {
        $pattern = $_GET["pattern"];
        $productRepository = new ProductRepository();
        $products = $productRepository->getByPattern($pattern);

        $totalProductArray = [];
        foreach ($products as $product) {
            $totalProductArray[] = $product->convertToArray();
        }
        
        echo json_encode($totalProductArray);
    }

    // Cập nhật sp được chọn vào danh sách sp (phần thêm đơn hàng mới - view/order/add.php)
    function updateProduct() {
        $product_id = $_GET["product_id"];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);
        echo json_encode($product->convertToArray());
    }

    // Cập nhật số lượng tồn khi chọn size của sản phẩm
    function getQtyOfSize() {
        $size = $_GET["size"];
        $product_id = $_GET["product_id"];
        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);
        $arrayProductDetail = $product->getSizeAndQty();

        $qty = 0;
        for ($i = 0; $i < count($arrayProductDetail); $i++) {
            if ($arrayProductDetail[$i]["size"] == $size) {
                $qty = $arrayProductDetail[$i]["qty"];
                break;
            }
        }
        echo $qty;  // trả về số lượng của size
    }

    // function deleteProduct() {
    //     $product_id = $_GET["product_id"];
    //     $order_id = $_GET["order_id"];
    //     $size = $_GET["size"];

    //     $orderItemRepository = new OrderItemRepository();
    //     $orderItem = $orderItemRepository->find($order_id, $product_id, $size);
    //     if ($orderItemRepository->delete($orderItem)) {
    //         $_SESSION["success"] = "Xóa sản phẩm trong đơn hàng thành công";
    //         header("location: index.php?c=order&a=edit&order_id=$order_id");
    //         exit;
    //     }
    // }

    function updateOrder() {
        $encryption = new Encryption();

        $order_id = $_POST["order_id"];
        $shipping_fullname = $encryption->encrypt(htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8") );
        $status_id = $_POST["status_id"];
        $phoneNumber = $encryption->encrypt(htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8") );
        $address = $encryption->encrypt(htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8") );
        $payment_method = $_POST["payment_method"];
        $staff_id = $_POST["staff_id"];

        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);

        $order->setShippingFullName($shipping_fullname);
        $order->setOrderStatusId($status_id);
        $order->setShippingMobile($phoneNumber);
        $order->setAddress($address);
        $order->setPaymentMethod($payment_method);
        $order->setStaffId($staff_id);

        if ($orderRepository->update($order)) {
            $_SESSION["success"] = "Cập nhật thông tin đơn hàng thành công";
            header("location: index.php?c=order");
            exit;
        }

    }

    // Xác nhận đơn hàng
    function confirm(){
        $staffRepository = new StaffRepository();
        // người xác nhận là người có trách nhiệm trên đơn hàng
        $staff = $staffRepository->findUsername($_SESSION["username"]);

		$order_id = $_GET["order_id"];
		$orderRepository = new OrderRepository();
		$order = $orderRepository->find($order_id);
		$order->setOrderStatusId(2);//xác nhận đơn hàng
        $order->setStaffId($staff->getId());
		
		if ($orderRepository->update($order)) {
            $_SESSION["success"] = "Xác nhận đơn hàng thành công";
			header("location: index.php?c=order");
			exit;
		}
	}

    // Xóa đơn hàng
    function deleteOrder() {
        $order_id = $_GET["order_id"];
        $orderRepository = new OrderRepository();
        $order = $orderRepository->find($order_id);

        if ($order->getOrderStatusId() != 1) {
            $_SESSION["error"] = "Đơn hàng này đã được xác nhận. Không được phép xóa";
			header("location: index.php?c=order");
            exit;
        }

        if ($orderRepository->delete($order)) {
            $_SESSION["success"] = "Xóa đơn hàng thành công";
			header("location: index.php?c=order");
			exit;
		}
    }
}

 ?>