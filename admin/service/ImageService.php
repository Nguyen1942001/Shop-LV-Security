<?php 
// File này dùng để tìm kiếm hình ảnh sp muốn thêm mới đã có trong thư mục upload hình ảnh của dự án chưa

class ImageService {
	function getCorrectImage($filename, $dir = null) {
		if ($dir) {
			$images = scandir($dir);
		}
		else {
			$images = scandir("../upload");  // quét tất cả các ảnh có trong thư mục upload
		}
		
		foreach ($images as $image) {
			if ($image == $filename) {   // Kiểm tra xem hình mới thêm vào có bị trùng không
				$new_file = time() . "_". $filename; // Nếu hình ảnh mới đã bị trùng thì thêm tiền tố thời gian để lưu hình hợp lệ
				return $new_file;
			}
		}
		return $filename;
	}
}
?>