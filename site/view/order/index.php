<?php require "layout/header.php" ?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Tài Khoản</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Trang Chủ</a></li>
						<li class="active">Đơn Đặt Hàng</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>


<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a href="index.php?c=customer&a=info">Thông Tin Tài Khoản</a></li>
					<li><a href="index.php?c=customer&a=shipping">Địa Chỉ Giao Hàng</a></li>
					<li><a class="active" href="index.php?c=order">Đơn Đặt Hàng</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="total-order mt-20">
						<h4>Tất Cả Các Đơn Hàng</h4>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Mã Đơn Hàng</th>
										<th>Ngày Đặt</th>
										<th>SL Sản Phẩm</th>
										<th>Tổng Giá Trị Đơn Hàng</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($orders as $order): ?>
										<tr>
											<td><a href="index.php?c=order&a=orderDetail&order_id=<?=$order->getId()?>">#<?=$order->getId()?></a></td>
											<td><?=$order->getCreatedDate()?></td>
											<td><?=$order->getTotalProductNumber()?></td>
											<td><?=number_format($order->getTotalPrice())?></td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require "layout/footer.php" ?>