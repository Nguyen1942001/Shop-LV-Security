<?php
class StaffRepository extends BaseRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$staffs = array();
		$sql = "EXEC SP_SEL_STAFF_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql);
		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$staff = new Staff($row["id"], $row["name"], $row["mobile"], $row["username"], $row["password"], $row["email"], $row["role_id"], $row["is_active"], $row["session_id"]);
				$staffs[] = $staff;
			}
		}

		return $staffs;


		// global $conn;
		// $staffs = array();
		// $sql = "SELECT * FROM staff";
		// if ($condition) 
		// {
		// 	$sql .= " WHERE $condition";
		// }
		// $result = $conn->query($sql);

		// if ($result->num_rows > 0) 
		// {
		// 	while ($row = $result->fetch_assoc()) 
		// 	{
		// 		$staff = new Staff($row["id"], $row["name"], $row["mobile"], $row["username"], $row["password"], $row["email"], $row["role_id"], $row["is_active"]);
		// 		$staffs[] = $staff;
		// 	}
		// }

		// return $staffs;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function findUsername($username) {
		global $conn; 
		$condition = "@USERNAME = '$username'";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function findUsernameAndPassword($username, $password) {
		global $conn; 
		$condition = "@USERNAME='$username', @PASSWORD='$password'";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$staffs = $this->fetchAll($condition);
		$staff = current($staffs);
		return $staff;
	}

	function save($data) {
		$staffs = array();
		global $conn;
		$name = $data["name"];
		$password = $data["password"];
		$username = $data["username"];
		$mobile = $data["mobile"];
		$email = $data["email"];
		$role_id = $data["role_id"];
		$is_active = isset($data["is_active"]) ? $data["is_active"] : 1;

		$sql = "EXEC SP_INSERT_STAFF N'$name', '$username', '$password', '$mobile', '$email', '$role_id', '$is_active'";

		$result = sqlsrv_query($conn, $sql);
		if ($result) {
            $staffs = $this->fetchAll();
			$last_id = array_pop($staffs)->getId();

            return $last_id;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($staff) {
		global $conn;
		$name = $staff->getName();
		$id = $staff->getId();
		$password = $staff->getPassword();
		$mobile = $staff->getMobile();
		$email = $staff->getEmail();
		$username = $staff->getUsername();
		$role_id = $staff->getRoleId();
		$is_active = $staff->getIsActive();
		$session_id = $staff->getSessionId();

		$sql = "EXEC SP_UPDATE_STAFF $id, $role_id, N'$name', '$username', '$password', '$mobile', '$email',  $is_active, '$session_id'";

		$result = sqlsrv_query($conn, $sql);

		if ($result) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($staff) {
		global $conn;
		$id = $staff->getId();
		$sql = "DELETE FROM staff WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}	

	function getByRoleId($role_id) {
		$condition = "@ROLE_ID = $role_id";
		return $this->fetchAll($condition);
	}

	function getActionNames($staff) {
		global $conn;
		$actionNames = [];
		$role_id = $staff->getRoleId();
		$sql = "EXEC SP_SEL_PERMISSIONS $role_id";
		$result = sqlsrv_query($conn, $sql);

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$actionNames[] = $row["name"];
			}
		}
		return $actionNames;
	}
}