<?php 
class OrderItemRepository {
    protected function fetchAll($condition = null) {
        global $conn;
        $orderItems = [];
        $sql = "EXEC SP_SEL_ORDER_ITEM_BY_CONDITION";

        if ($condition) {
            $sql .= " $condition";
        }
        $result = sqlsrv_query($conn, $sql); 
        if ($result) {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $orderItem = new OrderItem($row["PRODUCT_ID"], $row["ORDER_ID"], $row["QTY"], $row["SIZE"], $row["UNIT_PRICE"], $row["TOTAL_PRICE"]);
				$orderItems[] = $orderItem;
            }
        }
        return $orderItems;



        // global $conn;
        // $orderItems = [];
        // $sql = "SELECT * FROM order_item";

        // if ($condition) {
        //     $sql .= " WHERE $condition";
        // }
        // $result = $conn->query($sql);
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $orderItem = new OrderItem($row["PRODUCT_ID"], $row["ORDER_ID"], $row["QTY"], $row["SIZE"], $row["UNIT_PRICE"], $row["TOTAL_PRICE"]);
		// 		$orderItems[] = $orderItem;
        //     }
        // }
        // return $orderItems;
    }

    function getAll() {
        return $this->fetchAll();
    }

    function find($order_id, $product_id, $size) {
		global $conn; 
		$condition = "@ORDER_ID = $order_id, @PRODUCT_ID = $product_id, @SIZE = '$size'";
		$orderItems = $this->fetchAll($condition);
		$orderItem = current($orderItems);
		return $orderItem;
	}

    function save($dataItem) {
        global $conn;
        $product_id = $dataItem["product_id"];
        $order_id = $dataItem["order_id"];
        $qty = $dataItem["qty"];
        $size = $dataItem["size"];
        $unit_price = $dataItem["unit_price"];
        $total_price = $dataItem["total_price"];

        $sql = "EXEC SP_INSERT_ORDER_ITEM $product_id, $order_id, $qty, '$size', $unit_price, $total_price";
        $result = sqlsrv_query($conn, $sql); 

        if ($result) {
            return true;
        }

		return false;




        // $sql = "INSERT INTO order_item (PRODUCT_ID, ORDER_ID, QTY, SIZE, UNIT_PRICE, TOTAL_PRICE) VALUES ('$product_id', '$order_id', '$qty', '$size', '$unit_price', '$total_price')";

        // if ($conn->query($sql) === TRUE) {
		// 	return true;
		// } 
		// echo "Error: " . $sql . PHP_EOL . $conn->error;
		// return false;
    }

    function getByOrderId($order_id) {
		global $conn; 
		$condition = "@ORDER_ID = $order_id";
		$orderItems = $this->fetchAll($condition);
		return $orderItems;
	}

    function delete($orderItem) {
		global $conn;
		$product_id = $orderItem->getProductId();
		$order_id = $orderItem->getOrderId();
        $size = $orderItem->getSize();
		$sql = "EXEC SP_DELETE_ORDER_ITEM $product_id, $order_id, '$size'";
        
		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            return true;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}
?>