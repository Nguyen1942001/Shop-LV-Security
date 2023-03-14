<?php
class CommentRepository extends BaseRepository{
	
	protected function fetchAll($condition = null, $sort = null)
	{
		global $conn;
		$comments = array();
		$sql = "EXEC SP_SEL_COMMENT_BY_CONDITION";
		if ($condition) 
		{
			$sql .= " $condition";
		}

		$result = sqlsrv_query($conn, $sql);

		if ($result) 
		{
			while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))  
			{
				$comment = new Comment($row["ID"], $row["EMAIL"], $row["FULLNAME"], $row["CREATED_DATE"], $row["DESCRIPTION"], $row["PRODUCT_ID"]);
				$comments[] = $comment;
			}
		}

		return $comments;




		// global $conn;
		// $comments = array();
		// $sql = "SELECT * FROM comment";
		// if ($condition) 
		// {
		// 	$sql .= " WHERE $condition";
		// }

		// if ($sort) {
		// 	$sql .= " $sort";
		// }

		// $result = $conn->query($sql);

		// if ($result->num_rows > 0) 
		// {
		// 	while ($row = $result->fetch_assoc()) 
		// 	{
		// 		$comment = new Comment($row["ID"], $row["EMAIL"], $row["FULLNAME"], $row["CREATED_DATE"], $row["DESCRIPTION"], $row["PRODUCT_ID"]);
		// 		$comments[] = $comment;
		// 	}
		// }

		// return $comments;
	}

	function getAll() {
		return $this->fetchAll();
	}

	function find($id) {
		global $conn; 
		$condition = "@ID = $id";
		$comments = $this->fetchAll($condition);
		$comment = current($comments);
		return $comment;
	}

	function save($data) {
		global $conn;
		$email = $data["email"];
		$fullname = $data["fullname"];
		$created_date = $data["created_date"];
		$description = $data["description"];
		$product_id = $data["product_id"];

		$sql = "EXEC SP_INSERT_COMMENT '$email', N'$fullname', '$created_date', N'$description', $product_id";
		$result = sqlsrv_query($conn, $sql);

		if ($result) {
            return true;
        }

        $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
        return false;


		// $sql = "INSERT INTO comment (EMAIL,
		// FULLNAME, CREATED_DATE,
		// DESCRIPTION, PRODUCT_ID) VALUES ('$email', '$fullname', '$created_date', '$description', $product_id)";
		// if ($conn->query($sql) === TRUE) {
		// 	$last_id = $conn->insert_id;//chỉ cho auto increment
		//     return $last_id;
		// } 
		// $this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		// return false;
	}

	function update($comment) {
		global $conn;
		
		$id = $comment->getId();
		$email = $comment->getEmail();
		$fullname = $comment->getFullname();
		$created_date = $comment->getCreatedDate();
		$description = $comment->getDescription();
		$product_id = $comment->getProductId();
		$sql = "UPDATE comment SET 
			EMAIL='$email',
			FULLNAME='$fullname',
			CREATED_DATE='$created_date',
			DESCRIPTION='$description',
			PRODUCT_ID=$product_id
			WHERE ID=$id";

		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete($comment) {
		global $conn;
		$id = $comment->getId();
		$sql = "DELETE FROM comment WHERE ID = $id";
		if ($conn->query($sql) === TRUE) {
		    return true;
		} 
		$this->error = "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getByProductId($product_id) {
		return $this->fetchAll("@PRODUCT_ID = $product_id");
	}
}