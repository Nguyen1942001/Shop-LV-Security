<?php 
class PermissionController {
    function listRole() {
        $roleRepository = new RoleRepository();
        $roles = $roleRepository->getAll();
        require "view/permission/listRole.php";
    }

    function addRole() {
        require "view/permission/addRole.php";
    }

    function editRole() {
        $role_id = $_GET["role_id"];
        $roleRepository = new RoleRepository();
        $role = $roleRepository->find($role_id);
        require "view/permission/editRole.php";
    }

    function listAction() {
		$actionRepository = new ActionRepository();
		$actions = $actionRepository->getAll();
        require "view/permission/listAction.php";
    }

    function updateRole() {
		$name = $_POST["name"];
		$role_id = $_POST["role_id"];
		$roleRepository = new RoleRepository();

		//kiểm tra có bị trùng name không
		$currentRole = $roleRepository->getByName($name);
		if ($currentRole && $currentRole->getId() != $role_id) {
			$_SESSION["error"] = "Lỗi: Vai trò $name đã tồn tại";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}

		$role = $roleRepository->find($role_id);
		$role->setName($name);
		if ($roleRepository->update($role)) {
			$_SESSION["success"] = "Cập nhật thành công";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}
		echo $roleRepository->getError();
	}

    function saveRole() {
		$name = $_POST["name"];
		$data = [];
		$data["name"] = $name;
		$roleRepository = new RoleRepository();

		//kiểm tra có bị trùng name không
		if ($roleRepository->getByName($name)) {
			$_SESSION["error"] = "Lỗi: Vai trò $name đã tồn tại";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}

		if ($roleRepository->save($data)) {
			$_SESSION["success"] = "Tạo vai trò mới thành công";
			header("location: index.php?c=permission&a=listRole");
			exit;
		}
		echo $roleRepository->getError();
	}


    // =================== Xóa Vai Trò ===================

    // Kiểm tra xem vai trò muốn xóa có tác vụ và có tài khoản nhân viên đang sử dụng vai trò đó ko
    function checkDeleteRole(){
		//remove later
		$role_id = $_GET["role_id"];
		$roleRepository = new RoleRepository();
		$role = $roleRepository->find($role_id);
		$roleActions = $role->getActions();
		if (count($roleActions) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Vai trò {$role->getName()} có tác vụ, không thể xóa"]);
			return;
		}

		$staffs = $role->getStaffs();
		if (count($staffs) > 0) {
			//không xóa được
			echo json_encode(["can_delete" => 0, "message" => "Vai trò {$role->getName()} có nhân viên đang sử dụng, không thể xóa"]);
			return;
		}
		//xóa được
		echo json_encode(["can_delete" => 1, "message" => "OK"]);
		return;

	}

	function deleteRole() {
		$role_id = $_GET["role_id"];
        $roleRepository = new RoleRepository();
		$role = $roleRepository->find($role_id);

		if($roleRepository->delete($role)) {
			$_SESSION["success"] = "Vai trò {$role->getName()} đã xóa thành công";
            header("location: index.php?c=permission&a=listRole");
			exit;
		}
	}

}
?>