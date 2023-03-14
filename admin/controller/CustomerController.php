<?php 
class CustomerController {
    function list() {
        $customerRepository = new CustomerRepository();
        $customers = $customerRepository->getAll();
        require "view/customer/list.php";
    }

    function add() {
        require "view/customer/add.php";
    }

    function edit() {
        $customerRepository = new CustomerRepository();
        $customer_id = $_GET["customer_id"];
        $customer = $customerRepository->find($customer_id);
        require "view/customer/edit.php";
    }

    function update() {
        $encryption = new Encryption();
        
        $customer_id = $_POST["customer_id"];
        $fullname = $encryption->encrypt(htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8"));
        $phoneNumber = $encryption->encrypt(htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8"));
        $address = $encryption->encrypt(htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8"));
        $is_active = $_POST["is_active"]; // 0 hoặc 1

        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($customer_id);
        $customer->setName($fullname);
        $customer->setMobile($phoneNumber);
        $customer->setAddress($address);
        $customer->setIsActive($is_active);

        if ($customerRepository->update($customer)) {
            $_SESSION["success"] = "Cập nhật thông tin khách hàng thành công";
            header("location: index.php?c=customer");
			exit;
        }
    }

    function save() {
        $encryption = new Encryption();

        $fullname = $encryption->encrypt(htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8"));
        $emai = $encryption->encrypt(htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8"));
        $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
        $phoneNumber = $encryption->encrypt(htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8"));
        $address = $encryption->encrypt(htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8"));
        $is_active = $_POST["is_active"]; // 0 hoặc 1

        $data = array();
        $data["fullname"] = $fullname;
        $data["email"] = $emai;
        $data["password"] = password_hash($password, PASSWORD_BCRYPT); 
        $data["phoneNumber"] = $phoneNumber;
        $data["address"] = $address;
        $data["is_active"] = $is_active;
        $data["login_by"] = "form";  // Tự mặc định là form

        $customerRepository = new CustomerRepository();
        if ($customerRepository->save($data)) {
            $_SESSION["success"] = "Thêm khách hàng mới thành công";
            header("location: index.php?c=customer");
			exit;
        }
    }

    // Kiểm tra xem khách hàng đã có đơn đặt hàng chưa, nếu chưa thì cho phép xóa, nếu có thì ngăn chặn xóa
    function checkDelete() {
        $decryption = new Decryption();

        $customer_id = $_GET["customer_id"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($customer_id);

        $orderRepository = new OrderRepository();
        $orders = $orderRepository->getByCustomerId($customer_id); // Lấy các đơn hàng đã đặt của khách hàng

        if (count($orders) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Khách hàng {$decryption->decrypt($customer->getName())} có đơn hàng đã đặt, không thể xóa"]);
			return;
		}
		//xóa được
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
		return;
    }

    function delete() {
        $customerRepository = new CustomerRepository();
        $customer_id = $_GET["customer_id"];
        $customer = $customerRepository->find($customer_id);
        
        if ($customerRepository->delete($customer)) {
            $_SESSION["success"] = "Xóa khách hàng thành công";
            header("location: index.php?c=customer");
			exit;
        }
    }
}
?>