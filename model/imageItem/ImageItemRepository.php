<?php
class ImageItemRepository{
	protected function fetchAll($condition = null)
	{
		global $conn;
		$imageItems = array();
		$sql = "EXEC SP_SEL_IMAGE_ITEM_BY_CONDITION";

		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql);
		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))  
			{
				$imageItem = new ImageItem($row["ID"], $row["NAME"], $row["PRODUCT_ID"]);
				$imageItems[] = $imageItem;
			}
		}

		return $imageItems;




		// global $conn;
		// $imageItems = array();
		// $sql = "SELECT * FROM image_item";
		// if ($condition) 
		// {
		// 	$sql .= " WHERE $condition";
		// }

		// $result = $conn->query($sql);

		// if ($result->num_rows > 0) 
		// {
		// 	while ($row = $result->fetch_assoc()) 
		// 	{
		// 		$imageItem = new ImageItem($row["ID"], $row["NAME"], $row["PRODUCT_ID"]);
		// 		$imageItems[] = $imageItem;
		// 	}
		// }

		// return $imageItems;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function getByProductId($product_id) {
		global $conn; 
		$condition = "@PRODUCT_ID = $product_id";
		$imageItems = $this->fetchAll($condition);
		return $imageItems;
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$imageItems = $this->fetchAll($condition);
		$imageItem = current($imageItems);
		return $imageItem;
	}

	function save($data) {
		global $conn;
		$name = $data["name"];
		$product_id = $data["product_id"];
		$sql = "INSERT INTO image_item (PRODUCT_ID, NAME) VALUES ($product_id, '$name')";
		if ($conn->query($sql) === TRUE) {
			return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function update(ImageItem $imageItem) {
		global $conn;
		$name = $imageItem->getName();
		$id = $imageItem->getId();
		$product_id = $imageItem->getProductId();
		$sql = "UPDATE image_item SET name='$name', product_id=$product_id WHERE id=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete(ImageItem $imageItem) {
		global $conn;
		$id = $imageItem->getId();
		$sql = "DELETE FROM image_item WHERE id=$id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}
}