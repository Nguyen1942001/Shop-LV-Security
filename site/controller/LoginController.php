<?php 
class LoginController {
    function form() {
        $decryption = new Decryption();
        $customerRepository = new CustomerRepository();

        $email = md5(htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8"));
        $password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");

        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);

        if ($customer) {
            $encodePassword = $customer->getPassword();
            if (password_verify($password, $encodePassword)) {
                if ($customer->getIsActive() == 1) {
                    $_SESSION["success"] = "Đăng nhập thành công";
                    $_SESSION["email"] = $email;
                    $_SESSION["name"] = $decryption->decrypt($customer->getName());

                    // Lưu session id mới vào csdl sau khi đăng nhập
                    session_regenerate_id();
                    $customer->setSessionId(md5(session_id()));
                    $customer->setFailLogin(0);  // cập nhật lại số lần đăng nhập sai
                    $customerRepository->update($customer);
                    $_SESSION['session_id'] = md5(session_id());
                }
                else {
                    $_SESSION["error"] = "Vui lòng nhấp vào link trong email để kích hoạt tài khoản";
                }

                header("location: index.php");
                exit;
            }
            else {
                if ($customer->getFailLogin() >= 2) {
                    $customer->setIsActive(0);
                    $customerRepository->update($customer);
                    $_SESSION["error"] = "Tài khoản của bạn đã bị khóa vì đăng nhập sai";
                }
                else {
                    $customer->setFailLogin($customer->getFailLogin() + 1);
                    $customerRepository->update($customer);
                    $_SESSION["error"] = "Vui lòng nhập lại email hoặc mật khẩu";
                }
                header("location: index.php");
                exit;
            }
        }
        
        $_SESSION["error"] = "Vui lòng nhập lại email hoặc mật khẩu";
        header("location: index.php"); 
    }

    function logout() {
        session_id($_SESSION['session_id']);
        session_destroy();
        header("location: index.php");
    }
}
?>