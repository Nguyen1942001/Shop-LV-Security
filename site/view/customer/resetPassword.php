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

<body id="body">

<section class="forget-password-page account">
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="block text-center">
          <a class="logo" href="index.php">
            <img src="../upload/logo.png" alt="">
          </a>
          <h2 class="text-center">Lấy lại Mật Khẩu</h2>
          <form class="text-left clearfix form-forget-password" action="index.php?c=customer&a=updatePassword" method="POST">
              <input type="hidden" name="code" value="<?=$code?>">

              <div class="form-group">
                <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Nhập mật khẩu của bạn">
              </div>

              <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputEmail1" placeholder="Nhập lại mật khẩu">
              </div>

              <br>

              <div class="text-center">
                <button type="submit" class="btn btn-main text-center">Cập nhật</button>
              </div>
          </form>
          <p class="mt-20"><a href="index.php?c=account&a=signIn">Quay trở lại đăng nhập</a></p>
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

    <!-- Main Js File -->
    <script src="public/js/script.js"></script>
    


  </body>
  </html>