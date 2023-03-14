<?php 
class CategoryRepository {
    protected function fetchAll($condition = null)
	{
		global $conn;
		$categories = array();
		$sql = "EXEC SP_SEL_CATEGORY_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition"; 
		}

		$result = sqlsrv_query($conn, $sql); 

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
			{
				$category = new Category($row["ID"], $row["NAME"]);
				$categories[] = $category;
			}
		}
		return $categories;


		// global $conn;
		// $categories = array();
		// $sql = "SELECT * FROM category";
		// if ($condition) 
		// {
		// 	$sql .= " WHERE $condition"; // SELECT * FROM category WHERE id = 1
		// }

		// $result = $conn->query($sql);

		// if ($result->num_rows > 0) 
		// {
		// 	while ($row = $result->fetch_assoc()) 
		// 	{
		// 		$category = new Category($row["ID"], $row["NAME"]);
		// 		$categories[] = $category;
		// 	}
		// }
		// return $categories;
	}

	function getAll($condition = null) {
		return $this->fetchAll($condition);
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$categories = $this->fetchAll($condition);
		$category = current($categories);
		return $category;
	}

	function save($data) {
		$categories = array();
		global $conn;
		$category_name = $data["category_name"];
		$sql = "EXEC SP_INSERT_CATEGORY N'$category_name'";

		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
			$categories = $this->fetchAll();
			$last_id = array_pop($categories)->getId();

            return $last_id;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update($category) {
		global $conn;
		$name = $category->getName();
		$id = $category->getId();
		$sql = "EXEC SP_UPDATE_CATEGORY $id, '$name'";

		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            return true;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($category) {
		global $conn;
		$id = $category->getId();
		$sql = "EXEC SP_DELETE_CATEGORY $id";
		
		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            return true;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}

?>