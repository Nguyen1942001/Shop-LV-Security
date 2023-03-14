<?php
class ActionRepository extends BaseRepository{

	protected function fetchAll($condition = null)
	{
		global $conn;
		$actions = array();
		$sql = "EXEC SP_SEL_ACTION_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql); 

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$action = new action($row["id"], $row["name"], $row["description"]);
				$actions[] = $action;
			}
		}

		return $actions; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$actions = $this->fetchAll($condition);
		$action = current($actions);
		return $action;
	}

	function findByName($name) {
		global $conn; 
		$condition = "@NAME = '$name'";
		$actions = $this->fetchAll($condition);
		$action = current($actions);
		return $action;
	}

	function update($action) {
		global $conn;
		$name = $action->getName();
		$id = $action->getId();
		$description = $action->getDescription();
		$sql = "UPDATE action SET name='$name', description='$description' WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}