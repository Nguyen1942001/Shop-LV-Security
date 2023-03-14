<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Aviato | E-commerce template</title>

    <!-- Mobile Specific Metas
    ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Construction Html5 Template">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Themefisher Constra HTML Template v1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../upload/favicon.png" />

    <!-- Fontawsome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free-5.11.2-web/css/all.min.css">

    <!-- Themefisher Icon font -->
    <link rel="stylesheet" href="public/plugins/themefisher-font/style.css">
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="public/plugins/bootstrap/css/bootstrap.min.css">

    <!-- Animate css -->
    <link rel="stylesheet" href="public/plugins/animate/animate.css">
    <!-- Slick Carousel -->
    <link rel="stylesheet" href="public/plugins/slick/slick.css">
    <link rel="stylesheet" href="public/plugins/slick/slick-theme.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <section class="signin-page account">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="block text-center">

                        <a class="logo" href="index.php">
                            <img src="../upload/Logo LV Web.jpg" alt="" style="width: 102px; height: 30px;">
                        </a>
                        
                        <h2 class="text-center">Chào Mừng Đã Quay Trở Lại</h2>
        
                        <form class="text-left clearfix" action="index.php?c=login&a=form" method="POST">
                            <div class="form-group">
                                <input type="email" name="email" class="form-control"  placeholder="Email" required>
                            </div>
        
                            <div class="form-group">
                                <input type="password" name="password" class="form-control" placeholder="Mật Khẩu" required>
                            </div>
        
                            <div class="text-center">
                                <button type="submit" class="btn btn-main text-center" >Đăng Nhập</button>
                            </div>
                        </form>
        
                        <p class="mt-20">Bạn là người mới ?<a href="index.php?c=account&a=signUp"> <b>Hãy Tạo Tài Khoản Mới</b></a></p>
        
                        <a class="mt-20" href="index.php?c=account&a=forgetPassword">Quên mật khẩu</a>

                        <br>

                        <!-- Google login -->
        
                        <?php 
                            //init configuration
                            $clientID = GOOGLE_CLIENT_ID;
                            $clientSecret = GOOGLE_CLIENT_SECRET;
                            $redirectUri =  get_domain() . $_SERVER['PHP_SELF'] . "?c=auth&a=loginGoogle";
                                    
                            // create Client Request to access Google API
                            $client = new Google_Client();
                            $client->setClientId($clientID);
                            $client->setClientSecret($clientSecret);
                            $client->setRedirectUri($redirectUri);
                            $client->addScope("email");
                            $client->addScope("profile");
                            $loginUrl = $client->createAuthUrl();
                        ?>
                        
                        <br>
        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
    Essential Scripts
    =====================================-->

    <!-- Main jQuery -->
    <script src="public/plugins/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.1 -->
    <script src="public/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- Bootstrap Touchpin -->
    <script src="public/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
    <!-- Instagram Feed Js -->
    <script src="public/plugins/instafeed/instafeed.min.js"></script>
    <!-- Video Lightbox Plugin -->
    <script src="public/plugins/ekko-lightbox/dist/ekko-lightbox.min.js"></script>
    <!-- Count Down Js -->
    <script src="public/plugins/syo-timer/build/jquery.syotimer.min.js"></script>

    <!-- slick Carousel -->
    <script src="public/plugins/slick/slick.min.js"></script>
    <script src="public/plugins/slick/slick-animation.min.js"></script>

    <!-- Google Mapl -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
    <script type="text/javascript" src="public/plugins/google-map/gmap.js"></script>

    <!-- Main Js File -->
    <script src="public/js/script.js"></script>
</body>
</html>