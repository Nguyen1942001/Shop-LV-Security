<?php
class RoleRepository extends BaseRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$roles = array();
		$sql = "EXEC SP_SEL_ROLE_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql); 

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$role = new Role($row["id"], $row["name"]);
				$roles[] = $role;
			}
		}

		return $roles;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$roles = $this->fetchAll($condition);
		$role = current($roles);
		return $role;
	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$sql = "INSERT INTO role (name) VALUES ('$name')";
		if ($conn->query($sql) === TRUE) {
			$last_id = $conn->insert_id;//chỉ cho auto increment
		    return $last_id;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($role) {
		global $conn;
		$name = $role->getName();
		$id = $role->getId();
		$sql = "UPDATE role SET name='$name' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($role) {
		global $conn;
		$id = $role->getId();
		$sql = "DELETE FROM role WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getByName($name) {
		global $conn; 
		$condition = "@NAME = N'$name'";
		$roles = $this->fetchAll($condition);
		$role = current($roles);
		return $role;
	}
}