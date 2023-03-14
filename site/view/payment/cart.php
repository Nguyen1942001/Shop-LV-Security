<?php require "layout/header.php" ?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="content">
					<h1 class="page-name">Giỏ Hàng</h1>
					<ol class="breadcrumb">
						<li><a href="index.phhp">Trang Chủ</a></li>
						<li class="active">Giỏ Hàng</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="page-wrapper">
	<div class="cart shopping">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="block">
						<div class="product-list">
							<form method="post">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Hình Ảnh</th>
												<th>Tên Sản Phẩm</th>
												<th>Size</th>
												<th>Giá</th>
												<th>Số Lượng</th>
												<th>Hành Động</th>
											</tr>
										</thead>

										<tbody>
											<?php 
												$items = $cart->getItems();
												foreach ($items as $item):
													$id = $item["product_id"];
													$size = $item["size"];
											?>

											<tr class="">
												<td><img width="80" src="../upload/<?=$item["img"]?>" title="<?=$item["name"]?>"/></td>
												<td class="">
													<div class="product-info">
														<a href="index.php?c=product&a=show&id=<?=$item["product_id"]?>"><?=$item["name"]?></a>
													</div>
												</td>
												
												<td><?=$item["size"]?></td>
												<td class=""><?=number_format($item["unit_price"])?></td>
												<td><input type="number" value="<?=$item["qty"]?>" onchange="updateProductInCart(this,<?=$id?>,`<?=$size?>`)"></td>
												<td class="">
													<a class="product-remove" product-id="<?=$item["product_id"]?>" size="<?=$item["size"]?>" href="javascript:void(0)">Xóa</a>
												</td>
											</tr>

											<?php endforeach ?>
										</tbody>
									</table>
								</div>
								<a href="index.php?c=payment&a=checkout" class="btn btn-main pull-right">Thanh Toán</a>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php require "layout/footer.php" ?>