 <?php 
class ContactController {
    function form() {
        require "view/contact/form.php";
    }

    function send() {
        // send email to shop owner
        $mailService = new MailService();
        $to = SHOP_OWNER;
        $subject = "Shop_LV: Khách hàng liên hệ";
        $site = get_domain();
        
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
        $email = htmlspecialchars($_POST["email"], ENT_QUOTES, "UTF-8");
        $mobile = htmlspecialchars($_POST["mobile"], ENT_QUOTES, "UTF-8");
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES, "UTF-8");

        if ($name && $email && $mobile && $message) {
            $content = "
            Hi shop owner, <br>
            Customer contact info: <br>
            Name: $name <br>
            Email: $email <br>
            Mobile: $mobile <br>
            Message: $message <br>
            ========xxx======== <br>
            Sent from: $site
            ";
            $mailService->send($to, $subject, $content);
        }
        else {
            echo 'Điền đầy đủ thông tin trước khi gửi mail';
        }
        
    }
}
?>