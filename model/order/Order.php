<?php 
class Order {
    protected $id;
    protected $created_date;
    protected $order_status_id;
    protected $staff_id;
    protected $customer_id;
    protected $shipping_fullname;
    protected $shipping_mobile;
    protected $payment_method;
    protected $address;
    protected $delivered_date;

    function __construct($id, $created_date, $order_status_id, $staff_id, $customer_id, $shipping_fullname, $shipping_mobile, $payment_method, $address, $delivered_date) {
        $this->id = $id;
        $this->created_date = $created_date;
        $this->order_status_id = $order_status_id;
        $this->staff_id = $staff_id;
        $this->customer_id = $customer_id;
        $this->shipping_fullname = $shipping_fullname;
        $this->shipping_mobile = $shipping_mobile;
        $this->payment_method = $payment_method;
        $this->address = $address;
        $this->delivered_date = $delivered_date;
    }

    function getId() {
        return $this->id;
    }

    function getCreatedDate() {
        return $this->created_date;
    }

    function getOrderStatusId() {
        return $this->order_status_id;
    }

    function getStaffId() {
        return $this->staff_id;
    }

    function getCustomerId() {
        return $this->customer_id;
    }

    function getShippingFullName() {
        return $this->shipping_fullname;
    }

    function getShippingMobile() {
        return $this->shipping_mobile;
    }

    function getPaymentMethod() {
        return $this->payment_method;
    }

    function getAddress() {
        return $this->address;
    }

    function getDeliveredDate() {
        return $this->delivered_date;
    }

    function setCreatedDate($created_date) {
        $this->created_date = $created_date;
        return $this;
    }

    function setOrderStatusId($order_status_id) {
        $this->order_status_id = $order_status_id;
        return $this;
    }

    function setStaffId($staff_id) {
        $this->staff_id = $staff_id;
        return $this;
    }

    function setCustomerId($customer_id) {
        $this->customer_id = $customer_id;
        return $this;
    }

    function setShippingFullName($shipping_fullname) {
        $this->shipping_fullname = $shipping_fullname;
        return $this;
    }

    function setShippingMobile($shipping_mobile) {
        $this->shipping_mobile = $shipping_mobile;
        return $this;
    }

    function setPaymentMethod($payment_method) {
        $this->payment_method = $payment_method;
        return $this;
    }

    function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    function setDeliveredDate($delivered_date) {
        $this->delivered_date = $delivered_date;
        return $this;
    }

    // Lấy danh sách sản phẩm trong đơn hàng
    function getOrderItems() {
        $orderItemRepository = new OrderItemRepository();
        $orderItems = $orderItemRepository->getByOrderId($this->id);
        return $orderItems;
    }

    // Lấy tổng số lượng sản phẩm
    function getTotalProductNumber() {
        $totalProductNumber = 0;
        $orderItems = $this->getOrderItems();
        foreach ($orderItems as $orderItem) {
            $totalProductNumber += $orderItem->getQty();
        }
        return $totalProductNumber;
    }

    // Lấy tổng giá trị của đơn hàng
    function getTotalPrice() {
		$totalPrice = 0;
		$orderItems = $this->getOrderItems();
        foreach($orderItems as $orderItem) {
            $totalPrice += $orderItem->getTotalPrice();
        }
        return $totalPrice;
	}

    function getCustomer() {
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->find($this->customer_id);
        return $customer;
    }

    function getStatus() {
		$statusRepository = new StatusRepository();
		$status = $statusRepository->find($this->order_status_id);
		return $status;
	}

	function getStaff() {
		if (empty($this->staff_id)) return null;
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($this->staff_id);
		return $staff;
	}
    
}
?>