<?php 

class InformationController {
	function returnInformation() {
        require "view/information/returnInformation.php";
    }

    function returnFAQ() {
        require "view/information/returnFAQ.php";
    }

    function getInformation() {
        $email = $_POST["email"];
        $mailServer = new MailService();

        $activeUrl = get_domain_site(). "/index.php?c=information&a=activeGetInformation";

        $content = "
            Chào $email <br>
            Vui lòng click vào link bên dưới để xác nhận email này <br>
            Sau khi xác nhận thành công, bạn sẽ nhận được các thông báo về các bộ sưu tập mới nhất <br>
            <a href='$activeUrl'>Xác thực nhận thông báo</a>
        ";
        $mailServer->send($email, "Verify getting of notifications", $content);

        $_SESSION["success"] = "Vui lòng nhấp vào đường link trong email đăng ký nhận thông báo";
        header("location: index.php");
    }

    function activeGetInformation() {
        $_SESSION["success"] = "Bạn sẽ nhận được các thông báo về các bộ sưu tập mới nhất";
        header("location: /");
    }

}