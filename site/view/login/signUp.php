<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
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

<body id="body">

<section class="signin-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">

          <a class="logo" href="index.php">
            <img src="../upload/Logo LV Web.jpg" alt="" style="width: 102px; height: 30px;">
          </a>

          <h2 class="text-center">Tạo Tài Khoản</h2>

          <form class="text-left clearfix form-register" action="index.php?c=register&a=create" method="POST">
              <div class="form-group">
                <input type="text" class="form-control"  placeholder="Họ Tên" name="name"> 
              </div>

              <div class="form-group">
                <input type="tel" class="form-control"  placeholder="Số Điện Thoại" name="mobile">
              </div>

              <div class="form-group">
                <input type="email" class="form-control"  placeholder="Email" name="email">
              </div>

              <div class="form-group">
                <input type="password" class="form-control"  placeholder="Mật Khẩu" name="password">
              </div>

              <div class="form-group">
                <input type="password" class="form-control"  placeholder="Nhập Lại Mật Khẩu" name="password_confirmation" autocomplete="off" autosave="off">
              </div>

              <div class="form-group g-recaptcha" data-sitekey=<?=GOOGLE_RECAPTCHA_SITE?>></div>

              <!-- dummy input -->
              <input type="text" name="hiddenRecaptcha" style="opacity: 0; position: absolute; top: 0; left: 0; height: 1px; width: 1px;">

              <input type="hidden" name="reference" value="">

              <div class="text-center">
                <button type="submit" class="btn btn-main text-center">Đăng Ký</button>
              </div>

          </form>

          <p class="mt-20">Đã có tài khoản ?<a href="index.php?c=account&a=signIn"> Đăng Nhập</a></p>

          <p><a href="index.php?c=account&a=forgetPassword"> Quên Mật Khẩu?</a></p>
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

    <!-- Jquery Validation -->
    <script src="public/plugins/jquery-validation-1.19.3/dist/jquery.validate.min.js"></script>

    <!-- Xác thực google recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Main Js File -->
    <script src="public/js/script.js"></script>
    
</body>
</html>