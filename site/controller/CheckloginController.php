<?php
class CheckloginController
{
    function checkSession()
    {
        $data = array();

        if (isset($_SESSION["email"]) && isset($_SESSION["session_id"])) {

            $email = $_SESSION["email"];
            $session_id = $_SESSION["session_id"];
            $customerRepository = new CustomerRepository();

            $customer = $customerRepository->findEmail($email);

            if ($_SESSION['session_id'] != $customer->getSessionId()) {
                $data['output'] = 'logout';
            } else {
                $data['output'] = 'login';
            }
        }
        echo json_encode($data);
    }
}
