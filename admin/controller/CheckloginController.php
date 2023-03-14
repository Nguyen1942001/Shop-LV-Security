<?php
class CheckloginController
{
    function checkSession()
    {
        $data = array();

        if (isset($_SESSION["username"]) && isset($_SESSION["session_id"])) {

            $username = $_SESSION["username"];
            $session_id = $_SESSION["session_id"];
            $staffRepository = new StaffRepository();

            $staff = $staffRepository->findUsername($username);

            if ($_SESSION['session_id'] != $staff->getSessionId()) {
                $data['output'] = 'logout';
            } else {
                $data['output'] = 'login';
            }
        }
        echo json_encode($data);
    }
}
