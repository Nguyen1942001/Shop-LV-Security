<?php 
class StatusController {
    function list() {
        $statusRepository = new StatusRepository();
        $statuses = $statusRepository->getAll();
        require "view/status/list.php";
    }

    function edit() {
        $status_id = $_GET["status_id"];
        $statusRepository = new StatusRepository();
        $status = $statusRepository->find($status_id);
        require "view/status/edit.php";
    }

    function update() {
        $status_id = $_POST["status_id"];
        $statusRepository = new StatusRepository();
        $status = $statusRepository->find($status_id);
        $status->setName($_POST["name"]);
        $status->setDescription($_POST["description"]);

        if ($statusRepository->update($status)) {
            $_SESSION["success"] = "Chỉnh sửa trạng thái đơn hàng thành công";
            header("location: index.php?c=status");
            exit;
        }
    }
}
?>