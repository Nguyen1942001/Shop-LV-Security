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
  <link rel="shortcut icon" type="image/x-icon" href="../upload/favicon1.png" />

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

<!-- Start Top Header Bar -->
<section class="top-header">
	<div class="container">
		<div class="row">
			<!-- col-md-4 col-xs-12 col-sm-4 -->
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<div class="contact-number">
					<i class="tf-ion-ios-telephone"></i>
					<span>0333232451</span>
				</div>
			</div>

			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<!-- Site Logo -->
				<div class="logo text-center">
					<a href="index.php">
						<img src="../upload/Logo LV Web.jpg" alt="" style="width: 150px">
					</a>
				</div>
			</div>

			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<!-- Cart -->
				<ul class="top-menu text-right list-inline">
					<li class="dropdown cart-nav dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-android-cart"></i>GIỎ HÀNG</a>
						<div class="dropdown-menu cart-dropdown">

							<!-- Cart Item -->

							<!-- <div class="media">
								<a class="pull-left" href="#!">
									<img class="media-object" src="../upload/shop/cart/cart-2.jpg" alt="image"/>
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="#!">Ladies Bag</a></h4>
									<div class="cart-price">
										<span>1 x</span>
										<span>1250.00</span>
									</div>
									<h5><strong>$1200</strong></h5>
								</div>
								<a href="#!" class="remove"><i class="tf-ion-close"></i></a>
							</div> -->
							
							<!-- / Cart Item -->

							<!-- <div class="cart-summary">
								<span>Tổng</span>
								<span class="total-price"></span>
							</div>
							<ul class="text-center cart-buttons">
								<li><a href="cart.html" class="btn btn-small">Xem Giỏ Hàng</a></li>
								<li><a href="checkout.html" class="btn btn-small btn-solid-border">Thanh Toán</a></li>
							</ul> -->
						</div>

					</li><!-- / Cart -->

					<!-- Search -->
					<li class="dropdown search dropdown-slide">
						<a href="#!" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"><i
								class="tf-ion-ios-search-strong"></i>TÌM KIẾM</a>
						<ul class="dropdown-menu search-dropdown">
							<li>
								<form action="index.php">
									<input type="search" class="form-control" placeholder="Search..." name="search" value="<?=$search ?? ""?>">
									<button type="submit" class="btn-search"></button>
									<input type="hidden" name="c" value="product">
								</form>
							</li>
						</ul>
					</li><!-- / Search -->

					<!-- Login -->
					<?php if (!empty($_SESSION["email"])): ?>
						
						<?php 
							$tmp = explode(" ", $_SESSION["name"]);
							$lengthArray = count($tmp);
							$firstname = $tmp[$lengthArray - 1];
						?>

						<li>
							<a href="javascript:void(0)" class="btn-account dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">Hello <?=$firstname?></a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu">
                                <li><a href="index.php?c=customer&a=info">Thông tin tài khoản</a></li>
                                <li><a href="index.php?c=customer&a=shipping">Địa chỉ giao hàng</a></li>
                                <li><a href="index.php?c=order">Đơn hàng của tôi</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="index.php?c=login&a=logout">Thoát</a></li>
                            </ul>
						</li>

					<?php else: ?>

						<li class="">
							<a href="index.php?c=account&a=signIn">ĐĂNG NHẬP</a>
						</li>
					
					<?php endif ?>
					<!-- / Login -->

				</ul><!-- / .nav .navbar-nav .navbar-right -->
			</div>
		</div>
	</div>
</section><!-- End Top Header Bar -->


<!-- Main Menu Section -->
<section class="menu">
	<nav class="navbar navigation">
		<div class="container">
			<div class="navbar-header">
				<h2 class="menu-title">Main Menu</h2>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
					aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div><!-- / .navbar-header -->

			<!-- Navbar Links -->
			<div id="navbar" class="navbar-collapse collapse text-center">
				<ul class="nav navbar-nav">

					<!-- Home -->
					<li class="dropdown ">
						<a href="index.php">Trang Chủ</a>
					</li><!-- / Home -->

					<!-- Shop -->
					<li class="dropdown ">
						<a href="index.php?c=product">Sản Phẩm</a>
					</li><!-- / Shop -->


					<!-- About us -->
					<li class="dropdown ">
						<a href="index.php?c=information&a=returnInformation">Thông Tin</a>
					</li><!-- / About us -->


					<!-- Contact -->
					<li class="dropdown ">
						<a href="index.php?c=contact&a=form">Liên Hệ</a>
					</li><!-- / Contact -->

					<!-- FAQ -->
					<li class="dropdown ">
						<a href="index.php?c=information&a=returnFAQ">FAQ</a>
					</li><!-- / FAQ -->
				</ul><!-- / .nav .navbar-nav -->

			</div>
			<!--/.navbar-collapse -->
		</div><!-- / .container -->
	</nav>
</section>


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

    <?php if ($message) { ?>
    <div class="alert <?=$messageClass?> mt-4">
        <?=$message?>
    </div>
    <?php } ?>