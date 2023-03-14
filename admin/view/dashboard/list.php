<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="public/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="public/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="public/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/css/adminlte.min.css">
    <!-- Css cá nhân -->
    <link rel="stylesheet" href="public/css/admin.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="public/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="public/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="public/plugins/summernote/summernote-bs4.min.css">
</head>

<?php require "layout/header.php"?>

<div class="content-wrapper">

    <!-- Tiêu đề phần nội dung -->
    <section class="content-header">
        <div class="container-fluid">
            <!-- Xuất hiện thông báo -->
            <?php 
                $message = "";  // Khởi tạo biến bằng rỗng để hàm if kiểm tra biến không bị lỗi
                if (!empty($_SESSION["success"])) {
                    $message = $_SESSION["success"];
                    $messageClass = "alert-success";
                    // Xóa phần tử dựa vào key
                    unset($_SESSION["success"]);
                }
                else if (!empty($_SESSION["error"])) {
                    $message = $_SESSION["error"];
                    $messageClass = "alert-danger";
                    // Xóa phần tử dựa vào key
                    unset($_SESSION["error"]);
                }
            ?>

            <?php if ($message): ?>
                <div class="alert <?=$messageClass?>">
                    <?=$message?>
                </div>
            <?php else: ?>
                <div class="alert alert-1" style="display: none;">
                    
                </div>
            <?php endif ?>
            

            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
    </section>

    <!-- Nội dung chính -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?=number_format($revenue)?>đ</h3>

                        <p>Doanh Thu</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="index.php?c=order" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?=$numberCustomer?></h3>

                        <p>Khách Hàng</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="index.php?c=customer" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-4">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?=$numberProduct?></h3>

                        <p>Số Lượng Sản Phẩm</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="index.php?c=product" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </section>
</div>

<?php require "layout/footer.php"?>

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="public/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="public/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="public/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="public/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="public/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="public/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="public/plugins/moment/moment.min.js"></script>
<script src="public/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="public/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="public/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="public/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="public/js/adminlte.js"></script>
<!-- FIle js cá nhân -->
<script src="public/js/admin.js"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="public/js/pages/dashboard.js"></script>
</body>

</html>