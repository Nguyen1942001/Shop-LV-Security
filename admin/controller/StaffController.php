<?php 
class StaffController {
    function list() {
        $staffRepository = new StaffRepository();
        $staffs = $staffRepository->getAll();
        require "view/staff/list.php";
    }

    function add() {
        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();
        require "view/staff/add.php";
    }

    function edit() {
        $staff_id = $_GET["staff_id"];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($staff_id);

        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();
        require "view/staff/edit.php";
    }

    function update() {
        $staff_id = $_POST["staff_id"];
        $staffRepository = new StaffRepository();
        $staff = $staffRepository->find($staff_id);

        $staff->setName(htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8") );
        $staff->setUsername(htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8") );
        if (!empty($_POST["password"])) {
			$staff->setPassword(md5(htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8")));
		}
        $staff->setMobile(htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8") );
        $staff->setEmail(htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8") );
        $staff->setRoleId($_POST["role_id"]);
        $staff->setIsActive(0);
		if (!empty($_POST["is_active"])) {
			$staff->setIsActive(1);
		}

        if ($staffRepository->update($staff)) {
            $_SESSION["success"] = "Chỉnh sửa thông tin nhân viên thành công";
            header("location: index.php?c=staff");
			exit;
        }
    }

    function save() {
        $data = [];
        $data["name"] = htmlspecialchars($_POST["fullname"], ENT_QUOTES, "UTF-8");
		$data["password"] = md5(htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8"));
		$data["username"] = htmlspecialchars($_POST["username"], ENT_QUOTES, "UTF-8");
		$data["mobile"] = htmlspecialchars($_POST["phoneNumber"], ENT_QUOTES, "UTF-8");
		$data["email"] = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
		$data["role_id"] = $_POST["role_id"];
        if (!empty($_POST["is_active"])) {
			$data["is_active"] = 1;
		} 
        else {
			$data["is_active"] = 0;
        }

        $staffRepository = new StaffRepository();
        if ($staffRepository->save($data)) {
            $_SESSION["success"] = "Thêm nhân viên mới thành công";
            header("location: index.php?c=staff");
			exit;
        }
    }

    function disable() {
		$staff_id = $_GET["staff_id"];
		if ($this->activeOrDisable($staff_id, 0)) {
            $_SESSION["success"] = "Vô hiệu hóa tài khoản nhân viên thành công";
			header("location: index.php?c=staff");
			exit;
		}
        else {
            $_SESSION["error"] = "Không thể vô hiệu hóa tài khoản quản trị";
			header("location: index.php?c=staff");
			exit;
        }
	}

    // Kiểm tra xem là quyền admin hay là quyền thông thường
	protected function activeOrDisable($staff_id, $is_active) {
		
		$staffRepository = new StaffRepository();
		$staff = $staffRepository->find($staff_id);
		if ($staff->getRoleId() == 1) {//quản trị viên
			return false;
		}
		$staff->setIsActive($is_active);
		return $staffRepository->update($staff);
	}
}
?>