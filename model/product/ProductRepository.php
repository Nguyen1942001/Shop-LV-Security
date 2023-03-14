<?php 
class ProductRepository {
    protected function fetchAll($condition = null, $sort = null) {  
		global $conn;
		$products = array();
		$sql = "EXEC SP_SEL_PRODUCT_BY_CONDITION";

		if ($condition) {
			$sql .= " $condition";
		}

		if ($sort) {
			$sql .= " $sort";
		}

		$result = sqlsrv_query($conn, $sql); 

        if ($result) {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $product = new Product(
                    $row["ID"], $row["NAME"], $row["PRICE"], $row["FEATURED_IMAGE"],
                    $row["CATEGORY_ID"], $row["CREATED_DATE"],
                    $row["SHORT_DESCRIPTION"], $row["FULL_DESCRIPTION"], $row["FEATURED"]
                );
                $products[] = $product;
            }
        }
        return $products;



        // global $conn;
        // $products = array();

        // $sql = "SELECT * FROM product";
        // if ($condition) {
        //     $sql .= " WHERE $condition";
        // }

        // if ($sort) {
        //     $sql .= " $sort";
        // }

        // $result = $conn->query($sql);

        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $product = new Product(
        //             $row["ID"], $row["NAME"], $row["PRICE"], $row["FEATURED_IMAGE"],
        //             $row["CATEGORY_ID"], $row["CREATED_DATE"],
        //             $row["SHORT_DESCRIPTION"], $row["FULL_DESCRIPTION"], $row["FEATURED"]
        //         );
        //         $products[] = $product;
        //     }
        // }
        // return $products;
    }

	function getFetchAll($conds) {
		return $this->fetchAll($conds);
	}

	function getAll() {
		return $this->getBy();
	}


    function getBy($array_conds = array(), $array_sorts = array()) {
		$condition = "";
		foreach($array_conds as $param => $value) {
			$condition .= "$param = $value,";
		}

		return $this->fetchAll(rtrim($condition, ","));
		



		// $temp = array();
		// foreach($array_conds as $column => $cond) {
		// 	$type = $cond['type'];
		// 	$val = $cond['val'];
		// 	$str = "$column $type ";  // price BETWEEN 100000 and 200000
		// 	if (in_array($type, array("BETWEEN", "LIKE"))) {
		// 		$str .= "$val"; //name LIKE '%abc%'
		// 	}
		// 	else {
		// 		$str .= "'$val'";
		// 	}
		// 	// Mảng $temp chứa các phần tử là các điều kiện khác nhau
		// 	$temp[] = $str;
		// }
		// $condition = null;

		// if (count($array_conds)) {
		// 	//name LIKE '%abc%' 
		// 	//create_date='2020-08-07'
		// 	// => name LIKE '%abc%'  AND create_date='2020-08-07'
		// 	// $condition là biến chứa một chuỗi các điều kiện liên kết với nhau theo phép AND
		// 	$condition = implode(" AND ", $temp);
		// }

		// $temp = array();
		// foreach($array_sorts as $key => $sort) {
		// 	$temp[] = "$key $sort";
		// }
		// $sort = null;

		// if (count($array_sorts)) {
		// 	//name asc
		// 	//created_date desc 
		// 	//=> ORDER BY name asc, created_date desc 
		// 	$sort = "ORDER BY ". implode(" , ", $temp);
		// }

		// // Trả về danh sách các sản phẩm từ hàm fetchAll()
		// return $this->fetchAll($condition, $sort);
	}

	function find($id) {
		global $conn;
		$condition = "@ID = $id";
		$products = $this->fetchAll($condition);
		$product = current($products);
		return $product;
	}

	function update(Product $product) {
		global $conn;
		
		$id = $product->getId();
		$name = $product->getName();
		$price = $product->getPrice();
		$featured_image = $product->getFeaturedImage();
		$created_date = $product->getCreatedDate();
		$short_description = $product->getShortDescription();
		$full_description = $product->getFullDescription();
		$featured = $product->getFeatured();
		$category_id = $product->getCategoryId();
		$sql = "EXEC SP_UPDATE_PRODUCT $id, '$name', $price, '$featured_image', $category_id, '$short_description', '$full_description', $featured";

		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            return true;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function save($data) {
		$products = array();
		global $conn;
		$name = $data["name"];
		$price = $data["price"];
		$featured_image = $data["featured_image"];
		$created_date = $data["created_date"];
		$short_description = $data["short_description"];
		$full_description = $data["full_description"];
		$featured = $data["featured"];
		$category_id = $data["category_id"];

		$sql = "EXEC SP_INSERT_PRODUCT '$name', '$price', '$featured_image', '$created_date', '$short_description', '$full_description', $featured, $category_id";

		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            $products = $this->fetchAll();
			$last_id = array_pop($products)->getId();

            return $last_id;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function delete(Product $product) {
		global $conn;
		$id = $product->getId();
		$sql = "EXEC SP_DELETE_PRODUCT $id";
		
		$result = sqlsrv_query($conn, $sql); 
		if ($result) {
            return true;
        } 
		echo "Error: " . $sql . PHP_EOL . $conn->error;
		return false;
	}

	function getByPattern($pattern) {
		$condition = "NAME like '%$pattern%'";
		return $this->fetchAll($condition);
	}

}

?>