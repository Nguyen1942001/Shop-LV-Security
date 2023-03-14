<?php
class StatusRepository {
	protected $error;

	protected function fetchAll($condition = null)
	{
		global $conn;
		$statuses = array();
		$sql = "EXEC SP_SEL_STATUS_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql); 

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$status = new Status($row["id"], $row["name"], $row["description"]);
				$statuses[] = $status;
			}
		}

		return $statuses; // This is array 
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$statuses = $this->fetchAll($condition);
		$status = current($statuses);
		return $status;
	}

	function update($status) {
		global $conn;
		$id = $status->getId();
		$name = $status->getName();
		$description = $status->getDescription();
		$sql = "EXEC SP_UPDATE_STATUS $id, '$name', N'$description'";

		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getError() {
		return $this->error;
	}
}