<?php 
class Cart {
    protected $items;  // danh sách sp
    protected $total_price;
    protected $total_product_number;

    function __construct($items = array(), $total_price = 0, $total_product_number = 0) {
        $this->items = $items;
        $this->total_price = $total_price;
        $this->total_product_number = $total_product_number;
    }

    function getItems() {
        return $this->items;
    }

    function getTotalPrice() {
        return $this->total_price;
    }

    function getTotalProductNumber() {
        return $this->total_product_number;
    }

    function setItems($items) {
        $this->items = $items;
        return $this;
    }

    function setTotalPrice($total_price) {
        $this->total_price = $total_price;
        return $this;
    }

    function setTotalProductNumber($total_product_number) {
        $this->total_product_number = $total_product_number;
        return $this;
    }
        
    function addProduct($product_id, $size, $qty) {
        $productRepository = new ProductRepository();
        $product = $productRepository->find($product_id);
        $item = array(
            "product_id" => $product_id,
            "name" => $product->getName(),
            "img" => $product->getFeaturedImage(),
            "size" => $size,
            "qty" => $qty,
            "unit_price" => $product->getPrice(),
            "total_price" => $product->getPrice() * $qty
        );

		$this->addItem($item);
    }

    protected function addItem($item) {
        $product_id = $item["product_id"];
        $name = $item["name"];
        $img = $item["img"];
        $size = $item["size"];
        $qty = $item["qty"];
        $unit_price = $item["unit_price"];
        $total_price = $item["total_price"];

        $kt = false;
        foreach ($this->items as $item) {
            if ($product_id == $item["product_id"]) {
                $kt = true;
                break;
            }
        }

        // Trường hợp sản phẩm chưa có trong cart
        if ($kt == false) {
            $this->items[] = array(
                "product_id" => $product_id,
                "name" => $name,
                "img" => $img,
                "size" => $size,
                "qty" => $qty,
                "unit_price" => $unit_price,
                "total_price" => $total_price
            );
        }

        // Trường hợp sản phẩm đã có trong cart
        else {
            $check = false;
            foreach ($this->items as $item) { 
                if ($product_id == $item["product_id"] && $size == $item["size"]) {
                    $check = true;
                }
            }
            
            // Sản phẩm đã có trong cart nhưng size chưa có
            if ($check == false) {
                $this->items[] = array(
                    "product_id" => $product_id,
                    "name" => $name,
                    "img" => $img,
                    "size" => $size,
                    "qty" => $qty,
                    "unit_price" => $unit_price,
                    "total_price" => $total_price
                );
            }

            // Sản phẩm đã có trong cart nhưng size đã có
            else {
                for ($i = 0; $i < count($this->items); $i++) {
                    if ($product_id == $this->items[$i]["product_id"] && $size == $this->items[$i]["size"]) {
                        $this->items[$i]["qty"] += $qty;
			            $this->items[$i]["total_price"] = $this->items[$i]["qty"] * $unit_price;
                        break;
                    }
                }
            }
        }

        $this->total_price += $unit_price * $qty;
		$this->total_product_number += $qty;
    }

    function deleteProduct($product_id, $size) {
        // Dành cho sp không có size
        if ($size == null) {
            for ($i = 0; $i < count($this->items); $i++) {
                if ($product_id == $this->items[$i]["product_id"]) {
                    unset($this->items[$i]);
                }
            }

        }

        // Dành cho sp có size (quần áo và giày dép)
        else {
            for ($i = 0; $i < count($this->items); $i++) {
                if ($product_id == $this->items[$i]["product_id"] && $size == $this->items[$i]["size"]) {
                    unset($this->items[$i]);
                }
            }
        }

        // Đánh chỉ số từ 0 -> .... cho mảng (hàm unset() xóa phần tử của mảng nhưng không sắp xếp index array)
        $this->items = array_values($this->items);

		// Tính toán lại total_product_number & total_price
		$this->total_price = 0;
		$this->total_product_number = 0;
		foreach ($this->items as $item) {
			$this->total_price += $item["unit_price"] * $item["qty"];
			$this->total_product_number += $item["qty"];
		}
	}

    function convertToArray() {
		$a = array();
		$a["items"] = $this->items;
		$a["total_product_number"] = $this->total_product_number;
		$a["total_price"] = $this->total_price;
		return $a;
	}
}

?>