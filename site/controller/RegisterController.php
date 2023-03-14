<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class RegisterController
{
    function create()
    {
        // Verify registering by google recapcha
        $secret = GOOGLE_RECAPTCHA_SECRET;
        $remoteIp = "127.0.0.1";
        $gRecaptchaResponse = $_POST["g-recaptcha-response"];
        $recaptcha = new \ReCaptcha\ReCaptcha($secret);
        $resp = $recaptcha->setExpectedHostname(get_host_name())
                        ->verify($gRecaptchaResponse, $remoteIp);
        if (!$resp->isSuccess()) {
            // Verified!
            $errors = $resp->getErrorCodes();
            var_dump($errors);
            exit;
        }

        $encryption = new Encryption();

        $name = '';
        $mobile = '';
        $email = '';
        $password = '';
        $password_confirmation = '';

        if (isset($_POST["name"]) && preg_match('~^[^\s][^0-9-_!@#\$%\^\(\)-\+]{4,}[^\s]$~u', $_POST["name"])) {
            $name = $encryption->encrypt(htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8"));
        }

        if (isset($_POST["mobile"]) && preg_match('/^0([0-9]{9,9})$/', $_POST["mobile"])) {
            $mobile = $encryption->encrypt(htmlspecialchars($_POST["mobile"], ENT_QUOTES, "UTF-8"));
        }

        if (isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = md5(htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8"));
        }

        if (isset($_POST["password"]) && preg_match('~^(?=.*[A-Z])(?=.*[0-9].*[0-9])(?=.*[a-z].*[a-z])(?=.*[!@#\$%\^\*\(\)-\+]).{8,}$~', $_POST["password"])) {
            $password = password_hash(htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8"), PASSWORD_BCRYPT);
        }

        if (isset($_POST['password_confirmation']) && isset($_POST['password_confirmation']) == $_POST["password"]) {
            $password_confirmation = $_POST['password_confirmation'];
        }

        if ($name && $mobile && $email && $password && $password_confirmation) {
            $data = [
                "name" => $name,
                "mobile" => $mobile,
                "email" => $email,
                "password" => $password,
                "login_by" => "form",
                "is_active" => 0,
                "address" => ""
            ];

            $customerRepository = new CustomerRepository();
            if ($customerRepository->save($data)) {
                $_SESSION["success"] = "Đã tạo tài khoản thành công";

                // Gửi email để kích hoạt tài khoản
                $email = $_POST["email"];
                $mailServer = new MailService();

                // JWT
                $key = JWT_KEY;
                $payload = array("email" => $data["email"]);
                $code = JWT::encode($payload, $key, 'HS256');

                $activeUrl = get_domain_site() . "/index.php?c=register&a=active&code=$code";
                $content = "
                Chào $email <br>
                Vui lòng click vào link bên dưới để kích hoạt tài khoản <br>
                <a href='$activeUrl'>Active Account</a>
            ";
                $mailServer->send($email, "Active account", $content);
            } else {
                $_SESSION["error"] = $customerRepository->getError();
            }
        }

        header("location: index.php");
    }

    function active()
    {
        $decryption = new Decryption();

        $code = $_GET["code"];
        try {
            $decoded = JWT::decode($code, new Key(JWT_KEY, 'HS256'));
            $email = $decoded->email;

            $customerRepository = new CustomerRepository();
            $customer = $customerRepository->findEmail($email);

            if (!$customer) {
                $_SESSION["error"] = "Email $email không tồn tại";
                header("location: /");
            }
            $customer->setIsActive(1);
            $customerRepository->update($customer);
            $_SESSION["success"] = "Tài khoản của bạn đã được active";

            // Sau khi kích hoạt email thành công thì đăng nhập luôn cho khách hàng
            $_SESSION["email"] = $email;
            $_SESSION["name"] = $decryption->decrypt($customer->getName());

            // Lưu session id mới vào csdl sau khi đăng nhập
            session_regenerate_id();
            $customer->setSessionId(md5(session_id()));
            $customerRepository->update($customer);
            $_SESSION['session_id'] = md5(session_id());

            header("location: /");
        } catch (Exception $e) {
            echo "You tried to hack!!";
        }
    }

    // Check email đã được đăng ký chưa ngay lúc người dùng điền email vào form đăng ký
    function notExistingEmail()
    {
        $email = $_GET["email"];
        $customerRepository = new CustomerRepository();
        $customer = $customerRepository->findEmail($email);
        if (!$customer) {
            echo "true";
            return;
        } else {
            echo "false";
            return;
        }
    }
}
