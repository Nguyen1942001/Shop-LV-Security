<?php require "layout/header.php" ?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Liên Hệ</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Trang Chủ</a></li>
						<li class="active">Liên Hệ</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="page-wrapper">
	<div class="contact-section">
		<div class="container">
			<div class="row">
				<!-- Contact Form -->
				<div class="contact-form col-md-6 ">
					<form class="form-contact" id="contact-form" method="POST" action="index.php?c=contact&a=send" role="form">

						<div class="form-group">
							<input type="text" placeholder="Họ và tên" class="form-control" name="name" id="name">
						</div>

						<div class="form-group">
							<input type="email" placeholder="Email" class="form-control" name="email" id="email">
						</div>

						<div class="form-group">
							<input type="tel" placeholder="Số điện thoại" class="form-control" name="mobile"
								id="subject">
						</div>

						<div class="form-group">
							<textarea rows="6" placeholder="Nội dung" class="form-control" name="message"
								id="message"></textarea>
						</div>

						<div class="form-group">
                            <div class="alert alert-success message hidden"></div>
                        </div>

						<div id="cf-submit">
							<button type="submit" id="contact-submit" class="btn btn-transparent">Gửi</button>
						</div>

					</form>
				</div>
				<!-- ./End Contact Form -->

				<!-- Contact Details -->
				<div class="contact-details col-md-6 ">
					<div class="google-map">
						<iframe
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.5201415508745!2d106.78447601462312!3d10.847986992272936!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752772b245dff1%3A0xb838977f3d419d!2zSOG7jWMgdmnhu4duIEPDtG5nIG5naOG7hyBCQ1ZUIGPGoSBz4bufIHThuqFpIFRQLkhDTQ!5e0!3m2!1svi!2s!4v1652800753579!5m2!1svi!2s"
							width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"></iframe>
					</div>
					<ul class="contact-short-info">
						<li>
							<i class="tf-ion-ios-home"></i>
							<span>97 Man Thiện, Hiệp Phú, TP Thủ Đức, TPHCM</span>
						</li>
						<li>
							<i class="tf-ion-android-phone-portrait"></i>
							<span>Phone: 0333232451</span>
						</li>
						<li>
							<i class="tf-ion-android-mail"></i>
							<span>Email: n19dcat055@student.ptithcm.edu.vn</span>
						</li>
					</ul>
					<!-- Footer Social Links -->
					<div class="social-icon">
						<ul>
							<li>
								<a class="fb-icon" href="https://www.facebook.com" target="blank">
									<i class="tf-ion-social-facebook"></i>
								</a>
							</li>

							<li>
								<a href="https://www.twitter.com" target="blank">
									<i class="tf-ion-social-twitter"></i>
								</a>
							</li>

							<li>
								<a href="https://google.com/" target="blank">
									<i class="tf-ion-social-googleplus-outline"></i>
								</a>
							</li>

							<li>
								<a href="https://pinterest.com/" target="blank">
									<i class="tf-ion-social-pinterest-outline"></i>
								</a>
							</li>
						</ul>
					</div>
					<!--/. End Footer Social Links -->
				</div>
				<!-- / End Contact Details -->
			</div> <!-- end row -->
		</div> <!-- end container -->
	</div>
</section>

<?php require "layout/footer.php" ?>