<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class CustomerController
{
    function forgotPassword()
    {
        $email = $_POST["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail(md5($email));

        if (!$customer) {
            $_SESSION["error"] = "$email không tồn tại";
            header("location: index.php");
            exit;
        }

        $mailServer = new MailService();
        $key = JWT_KEY;
        $payload = array("email" => $email);
        $code = JWT::encode($payload, $key, 'HS256');

        $activeUrl = get_domain_site() . "/index.php?c=customer&a=resetPassword&code=$code";
        $content = "
            Chào $email <br>
            Vui lòng click vào link bên dưới để thiết lập lại password <br>
            <a href='$activeUrl'>Reset Password</a>
        ";
        $mailServer->send($email, "Reset Password", $content);
        $_SESSION["success"] = "Vui lòng check email để reset password";
        header("location: index.php");
    }

    function resetPassword()
    {
        $code = $_GET["code"];
        try {
            $decoded = JWT::decode($code, new Key(JWT_KEY, 'HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail(md5($email));
            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            require "view/customer/resetPassword.php";
        } catch (Exception $e) {
            echo "You tried to hack!";
        }
    }

    function updatePassword()
    {
        $code = $_POST["code"];
        try {
            $decoded = JWT::decode($code, new Key(JWT_KEY, 'HS256'));
            $email = $decoded->email;
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail(md5($email));
            $newPassword = $_POST["password"];
            $hashNewPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $customer->setPassword($hashNewPassword);
            $customerRepository->update($customer);
            $_SESSION["success"] = "Reset mật khẩu thành công";
            header("location: index.php");
        } catch (Exception $e) {
            echo "You tried to hack!";
        }
    }


    // Thông tin tài khoản
    function info()
    {
        $decryption = new Decryption();
        $email = $_SESSION["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        $name = $decryption->decrypt($customer->getName());
        $mobile = $decryption->decrypt($customer->getMobile());
        require "view/customer/info.php";
    }


    // Cập nhật thông tin tài khoản
    function updateInfo()
    {
        $encryption = new Encryption();
        $decryption = new Decryption();

        // Validate form by PHP
        $name = '';
        $mobile = '';

        
        $name = $encryption->encrypt(htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8"));
        $mobile = $encryption->encrypt(htmlspecialchars($_POST["mobile"], ENT_QUOTES, "UTF-8"));

        if ($name && $mobile) {
            $email = $_SESSION["email"];
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);

            $customer->setName($name);
            $customer->setMobile($mobile);

            $dbPassword = $customer->getPassword();
            $currentPassword = htmlspecialchars($_POST["current_password"], ENT_QUOTES, "UTF-8");
            $newPassword = htmlspecialchars($_POST["new_password"], ENT_QUOTES, "UTF-8");
            $confirmationPassword = htmlspecialchars($_POST["confirmation_password"], ENT_QUOTES, "UTF-8");

            if ($currentPassword && $newPassword) {
                if ($newPassword == $confirmationPassword) {
                    if (password_verify($currentPassword, $dbPassword)) {
                        $encodePassword = password_hash($newPassword, PASSWORD_BCRYPT);
                        $customer->setPassword($encodePassword);
                    } else {
                        $_SESSION["error"] = "Mật khẩu hiện tại không đúng";
                        header("location: index.php?c=customer&a=info");
                        exit;
                    }
                } else {
                    $_SESSION["error"] = "Xác nhận mật khẩu mới không đúng";
                    header("location: index.php?c=customer&a=info");
                    exit;
                }
            }

            if ($customerRepository->update($customer)) {
                $_SESSION["name"] = $decryption->decrypt($customer->getName());
                $_SESSION["success"] = "Đã cập nhật thông tin tài khoản thành công";
            } else {
                $_SESSION["error"] = $customerRepository->getError();
            }
        } else {
            $_SESSION["error"] = "Nhập sai định dạng";
        }

        header("location: index.php?c=customer&a=info");
    }


    // Địa chỉ giao hàng mặc định
    function shipping()
    {
        $decryption = new Decryption();
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($_SESSION["email"]);
        $name = $decryption->decrypt($customer->getName());
        $mobile = $decryption->decrypt($customer->getMobile());
        $address = $decryption->decrypt($customer->getAddress());
        require "view/customer/shipping.php";
    }

    function updateShipping()
    {
        $encryption = new Encryption();
        $decryption = new Decryption();

        // Validate form by PHP
        $name = '';
        $mobile = '';
        $address = '';

        if (isset($_POST["name"]) && preg_match('~^[^\s][^0-9-_!@#\$%\^\(\)-\+]{4,}[^\s]$~u', $_POST["name"])) {
            $name = $encryption->encrypt(htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8"));
        }

        if (isset($_POST["mobile"]) && preg_match('/^0([0-9]{9,9})$/', $_POST["mobile"])) {
            $mobile = $encryption->encrypt(htmlspecialchars($_POST["mobile"], ENT_QUOTES, "UTF-8"));
        }

        if (isset($_POST["address"])) {
            $address = $encryption->encrypt(htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8"));
        }

        if ($name && $mobile && $address) {
            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($_SESSION["email"]);

            $customer->setName($name);
            $customer->setAddress($address);
            $customer->setMobile($mobile);

            if ($customerRepository->update($customer)) {
                $_SESSION["name"] = $decryption->decrypt($customer->getName());
                $_SESSION["success"] = "Đã cập nhật địa chỉ giao hàng thành công";
            } else {
                $_SESSION["error"] = $customerRepository->getError();
            }
        } 
        else {
            $_SESSION["error"] = 'Nhập sai định dạng';
        }

        header("location: index.php?c=customer&a=shipping");
    }
}
