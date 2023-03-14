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
					<li><a href="index.php?c=order">Đơn Đặt Hàng</a></li>
					<li><a class="active" href="#">Chi Tiết Đơn Đặt Hàng</a></li>
					<li><a href="index.php?c=customer&a=shipping">Địa Chỉ Giao Hàng</a></li>
					<li><a href="index.php?c=customer&a=info">Thông Tin Tài Khoản</a></li>
				</ul>
				<div class="dashboard-wrapper user-dashboard">
					<div class="total-order mt-20">
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Hình Ảnh</th>
										<th>Tên Sản Phẩm</th>
										<th>Size</th>
										<th>Số Lượng Sản Phẩm</th>
										<th>Giá Tiền</th>
										<th>Giá Tổng</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($orderItems as $orderItem): ?>
										<tr>
											<td><a href="index.php?c=product&a=show&id=<?=$orderItem->getProductId()?>"><img src="../upload/<?=$orderItem->getProduct()->getFeaturedImage()?>" alt=""></a></td>
											<td><?=$orderItem->getProduct()->getName()?></td>
											<td><?=$orderItem->getSize()?></td>
											<td><?=$orderItem->getQty()?></td>
											<td><?=number_format($orderItem->getUnitPrice())?></td>
											<td><?=number_format($orderItem->getTotalPrice())?></td>
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