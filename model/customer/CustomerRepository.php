<?php 
class CustomerRepository extends BaseRepository {
    protected function fetchAll($condition = null) {
        global $conn;
        $customers = [];
        $sql = "EXEC SP_SEL_CUSTOMER_BY_CONDITION";

        if ($condition) {
            $sql .= " $condition";
        }

        $result = sqlsrv_query($conn, $sql); 
        if ($result) {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $customer = new Customer($row["ID"], $row["NAME"], $row["PASSWORD"], $row["EMAIL"], $row["LOGIN_BY"], $row["MOBILE"], $row["ADDRESS"], $row["IS_ACTIVE"], $row["SESSION_ID"], $row["FAIL_LOGIN"]);
                $customers[] = $customer;
            }
        }

        return $customers;


        // global $conn;
        // $customers = [];
        // $sql = "SELECT * FROM customer";

        // if ($condition) {
        //     $sql .= " WHERE $condition";
        // }

        // $result = $conn->query($sql);
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $customer = new Customer($row["ID"], $row["NAME"], $row["PASSWORD"], $row["EMAIL"], $row["LOGIN_BY"], $row["MOBILE"], $row["ADDRESS"], $row["IS_ACTIVE"]);
        //         $customers[] = $customer;
        //     }
        // }

        // return $customers;
    }

    function getAll() {
        return $this->fetchAll();
    }

    function save($data) {
        global $conn;
        $name = $data["name"];
        $password = $data["password"];
        $email = $data["email"];
        $login_by = $data["login_by"];
        $mobile = $data["mobile"];
        $address = $data["address"];
        $is_active = $data["is_active"];

        if (empty($is_active)) {
            $is_active = 0;
        }

        $sql = "EXEC SP_INSERT_CUSTOMER N'$name', '$password', '$email', '$login_by', '$mobile', N'$address', '$is_active'";
        $result = sqlsrv_query($conn, $sql); 

        if ($result) {
            return true;
        }

        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;


        // $sql = "INSERT INTO customer (NAME, PASSWORD, EMAIL, LOGIN_BY, MOBILE, ADDRESS, IS_ACTIVE) VALUES ('$name', '$password', '$email', '$login_by', '$mobile', '$address', '$is_active')";

        // if ($conn->query($sql) === TRUE) {
        //     $last_id = $conn->insert_id;
        //     return $last_id;
        // }

        // $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        // return false;
    }

    function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$customers = $this->fetchAll($condition);
		$customer = current($customers);
		return $customer;
	}

    function findEmail($email) {
        global $conn;
        $condition = "@EMAIL = '$email'";
        $customers = $this->fetchAll($condition);
        $customer = current($customers);
        return $customer;
    }

    function findEmailAndSessionId($email, $session_id) {
        global $conn;
        $condition = "@EMAIL = '$email', @SESSION_ID = '$session_id'";
        $customers = $this->fetchAll($condition);
        $customer = current($customers);
        return $customer;
    }

    function update($customer) {
        global $conn;
        $id = $customer->getId();
        $name = $customer->getName();
        $password = $customer->getPassword();
        $email = $customer->getEmail();
        $login_by = $customer->getLoginBy();
        $mobile = $customer->getMobile();
        $address = $customer->getAddress();
        $is_active = $customer->getIsActive();
        $session_id = $customer->getSessionId();
        $fail_login = $customer->getFailLogin();

        if (empty($is_active)) {
            $is_active = 0;
        }

        $sql = "EXEC SP_UPDATE_CUSTOMER $id, N'$name', '$password', '$email', '$login_by', '$mobile', N'$address', '$is_active', '$session_id', $fail_login";
        $result = sqlsrv_query($conn, $sql); 

        if ($result) {
            return true;
        }
        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;


        // $sql = "UPDATE customer SET NAME = '$name', PASSWORD = '$password', EMAIL = '$email', LOGIN_BY = '$login_by', MOBILE = '$mobile', ADDRESS = '$address', IS_ACTIVE = '$is_active' WHERE ID = $id";

        // if ($conn->query($sql) === TRUE) {
        //     return true;
        // }
        // $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		// return false;
    }

    function delete($customer) {
		global $conn;
		$id = $customer->getId();
		$sql = "DELETE FROM customer WHERE ID = $id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}

?>