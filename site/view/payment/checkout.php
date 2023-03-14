<?php require "layout/header.php" ?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Thanh Toán</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Trang Chủ</a></li>
						<li class="active">Thanh Toán</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>
<div class="page-wrapper">
	<div class="checkout shopping">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="block billing-details">
						<h4 class="widget-title">Thông Tin Giao Hàng</h4>
						<form class="checkout-form" method="POST" action="index.php?c=payment&a=order">
							<div class="form-group">
								<?php 
									$decryption = new Decryption();
									$name = "";
									$mobile = "";
									$address = "";
									if ($customer->getName() != "Khách Vãng Lai") {
										$name = $decryption->decrypt($customer->getName());
										$mobile = $decryption->decrypt($customer->getMobile());
										$address = $decryption->decrypt($customer->getAddress());
									}
								?>
								<label for="full_name">Họ Tên</label>
								<input type="text" class="form-control" id="full_name" name="name" value="<?=$name?>" required>
							</div>

							<div class="form-group">
								<label for="user_address">Địa Chỉ</label>
								<input required type="text" class="form-control" id="user_address" name="address" value="<?=$address?>">
							</div>

							<div class="form-group">
								<label for="user_country">Số Điện Thoại</label>
								<input required type="text" class="form-control" id="user_country" name="mobile" value="<?=$mobile?>">
							</div>
							
							<div class="block">
								<h4 class="widget-title">Phương Thức Thanh Toán</h4>

								<div class="">
									<label>
										<input type="radio" name="payment_method" checked value="0"> Thanh toán khi giao hàng
										(COD)
									</label>
									<div></div>
								</div>

								<div class="">
									<label>
										<input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng
									</label>
									<div class="bank-info">STK: 0123456789<br>Chủ TK: Nguyễn Đình Khôi Nguyên. Ngân hàng:
										Vietcombank
										TPHCM <br>
										Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-main mt-20">Đặt Hàng</button>
						</form>
					</div>

					<!-- <div class="block">
						<h4 class="widget-title">Phương Thức Thanh Toán</h4>

						<div class="form-group">
							<label>
								<input type="radio" name="payment_method" checked="" value="0"> Thanh toán khi giao hàng
								(COD)
							</label>
							<div></div>
						</div>

						<div class="form-group">
							<label>
								<input type="radio" name="payment_method" value="1"> Chuyển khoản qua ngân hàng
							</label>
							<div class="bank-info">STK: 0123456789<br>Chủ TK: Nguyễn Đình Khôi Nguyên. Ngân hàng:
								Vietcombank
								TPHCM <br>
								Ghi chú chuyển khoản là tên và chụp hình gửi lại cho shop dễ kiểm tra ạ
							</div>
						</div>
					</div> -->

				</div>
				<div class="col-md-4">
					<div class="product-checkout-details">
						<div class="block">
							<h4 class="widget-title">Tổng Đơn Hàng</h4>

							<?php 
								$items = $cart->getItems();
								foreach ($items as $item):
							?>

							<div class="media product-card">
								<a class="pull-left" href="index.php?c=product&a=show&id=<?=$item["product_id"]?>">
									<img class="media-object" src="../upload/<?=$item["img"]?>" alt="<?=$item["name"]?>" />
								</a>
								<div class="media-body">
									<h4 class="media-heading"><a href="index.php?c=product&a=show&id=<?=$item["product_id"]?>"><?=$item["name"]?></a>
									</h4>
									<p class="price">Size: <?=$item["size"]?></p>
									<p class="price"><?=$item["qty"]?> x <?=number_format($item["unit_price"])?> đ</p>
								</div>
							</div>

							<?php endforeach ?>

							<ul class="summary-prices">
								<li>
									<span>Tổng Số Lượng Sản Phẩm:</span>
									<span class="price"><?=number_format($cart->getTotalProductNumber())?></span>
								</li>
								<li>
									<span>Phí Vận Chuyển:</span>
									<span>Free</span>
								</li>
							</ul>
							<div class="summary-total">
								<span>Tổng Tiền</span>
								<span><?=number_format($cart->getTotalPrice())?> đ</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "layout/footer.php" ?>
