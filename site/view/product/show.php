<?php require "layout/header.php" ?>

<section class="single-product">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<ol class="breadcrumb">
					<li><a href="index.php">Trang Chủ</a></li>
					<li><a href="index.php?c=product">Sản Phẩm</a></li>
					<li class="active"><?=$product->getCategory()->getName()?></li>
				</ol>
			</div>
		</div>
		<div class="row mt-20">
			<div class="col-md-5">
				<div class="single-product-slider">
					<div id='carousel-custom' class='carousel slide' data-ride='carousel'>
						<div class='carousel-outer'>
							<!-- me art lab slider -->
							<div class='carousel-inner '>
								<div class='item active'>
									<img src='../upload/<?=$product->getFeaturedImage()?>' alt='' data-zoom-image="../upload/<?=$product->getFeaturedImage()?>" />
								</div>

								<?php foreach ($product->getImageItems() as $imageItem): ?>
									<div class='item'>
										<img src='../upload/product/<?=$product->getCategory()->getName()?>/<?=$product->getName()?>/<?=$imageItem->getName()?>' alt='' data-zoom-image="../upload/product/<?=$product->getCategory()->getName()?>/<?=$product->getName()?>/<?=$imageItem->getName()?>" />
									</div>
								<?php endforeach ?>
							</div>
							
							<!-- sag sol -->
							<a class='left carousel-control' href='#carousel-custom' data-slide='prev'>
								<i class="tf-ion-ios-arrow-left"></i>
							</a>
							<a class='right carousel-control' href='#carousel-custom' data-slide='next'>
								<i class="tf-ion-ios-arrow-right"></i>
							</a>
						</div>
						
						<!-- thumb -->
						<ol class='carousel-indicators mCustomScrollbar meartlab'>
							<li data-target='#carousel-custom' data-slide-to='0' class='active'>
								<img src='../upload/<?=$product->getFeaturedImage()?>' alt='' />
							</li>
							
							<?php $i = 0 ?>
							<?php foreach ($product->getImageItems() as $imageItem): ?>
								<li data-target='#carousel-custom' data-slide-to='<?=++$i?>'>
									<img src='../upload/product/<?=$product->getCategory()->getName()?>/<?=$product->getName()?>/<?=$imageItem->getName()?>' alt='' />
								</li>
							<?php endforeach ?>
							
						</ol>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="single-product-details">
					<h2><?=$product->getName()?></h2>
					<p class="product-price"><?=number_format($product->getPrice())?>đ</p>
					
					<p class="product-description mt-20">
						<?=$product->getShortDescription()?>
					</p>

					<?php if (strcmp($category_id, '1') == 0 || strcmp($category_id, '4') == 0): ?>
						<div class="product-size">
							<span>Kích Thước:</span>
							<select class="form-control">
								<option value="S" <?=$product->getSizeAndQty()[0]["size"] == "S" && $product->getSizeAndQty()[0]["qty"] > 0 ? "" : 'disabled="disabled"'?>>S</option>
								<option value="M" <?=$product->getSizeAndQty()[1]["size"] == "M" && $product->getSizeAndQty()[1]["qty"] > 0 ? "" : 'disabled="disabled"'?>>M</option>
								<option value="L" <?=$product->getSizeAndQty()[2]["size"] == "L" && $product->getSizeAndQty()[2]["qty"] > 0 ? "" : 'disabled="disabled"'?>>L</option>
								<option value="XL" <?=$product->getSizeAndQty()[3]["size"] == "XL" && $product->getSizeAndQty()[3]["qty"] > 0 ? "" : 'disabled="disabled"'?>>XL</option>
							</select>
						</div>
					<?php endif ?>

					<div class="product-quantity">
						<span>Số Lượng:</span>
						<div class="product-quantity-slider">
							<input id="product-quantity" type="number" value="1" name="product-quantity">
						</div>
					</div>
					<?php if ($product->getTotalQty() > 0): ?>
						<a class="btn btn-main mt-20 buy" product-id="<?=$product->getId()?>">Thêm Vào Giỏ Hàng</a>
					<?php else: ?>
						<a class="btn btn-main mt-20" href="javascript:void(0)">Hết Hàng</a>
					<?php endif ?>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12">
				<div class="tabCommon mt-20">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#details" aria-expanded="true">Mô Tả Chi Tiết</a></li>
						<li class=""><a data-toggle="tab" href="#show_reviews" aria-expanded="false">Đánh Giá (<?=count($product->getComments())?>)</a></li>
						<li class=""><a data-toggle="tab" href="#reviews" aria-expanded="false">Viết Đánh Giá</a></li>
					</ul>
					<div class="tab-content patternbg">

						<div id="details" class="tab-pane fade active in">
							<h4>Mô Tả Sản Phẩm</h4>
							<p><?=$product->getFullDescription()?></p>
						</div>

						<div id="show_reviews" class="tab-pane fade comment-list">
							<?php $comments = $product->getComments(); ?>
						<?php require "layout/comment.php" ?>
						</div>

						<div id="reviews" class="tab-pane fade">
							<form class="form-comment" action="index.php?c=product&a=storeComment" method="POST" role="form">
								<?php require "create_csrf_token.php" ?>

								<input type="hidden" name='csrf_token' value="<?=$token?>">

                                <label>Đánh giá của bạn</label>

                                <div class="form-group">
                                    <input type="hidden" name="product_id" value="<?=$product->getId()?>">
                                    <input type="text" class="form-control" id="" name="fullname" placeholder="Tên *" value="" required>
                                    <input type="email" name="email" class="form-control" id="" placeholder="Email *" value="" required>
                                    <textarea name="description" id="input" class="form-control" rows="3" value="" required placeholder="Nội dung *"></textarea>
                                </div>

                            	<button type="submit" class="btn btn-primary">Gửi</button>

								<div class="alert mt-4 review-success">

								</div>
                            </form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="products related-products section">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Bạn Cũng Có Thể Thích</h2>
			</div>
		</div>
		<div class="row">
			<?php $count = 0 ?>
			<?php foreach($relatedProducts as $relatedProduct): ?>
				<?php 
					if ($count == 4) {
						break;
					}
				?>
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="product-item">
						<div class="product-thumb">
							<img class="img-responsive" src="../upload/<?=$relatedProduct->getFeaturedImage()?>" alt="product-img" />
							<div class="preview-meta">
								<ul>
									<li>
										<a href="index.php?c=product&a=show&id=<?=$relatedProduct->getId()?>"><i class="tf-ion-ios-search"></i></a>
									</li>

									<?php if ($relatedProduct->getTotalQty() > 0): ?>
										<li>
											<a product-id="<?=$relatedProduct->getId()?>" <?=$relatedProduct->getCategory()->getId() == 1 || $relatedProduct->getCategory()->getId() == 4 ? 'size="S"' : 'size=""'?> class="buy"><i class="tf-ion-android-cart"></i></a>
										</li>
									<?php else: ?>
										<li>
											<a href="javascript:void(0)" class="out-of-stock" title="Hết Hàng"><i class="tf-ion-android-cart"></i></a>
										</li>
									<?php endif ?>
								</ul>
                        	</div>
						</div>
						<div class="product-content">
							<h4><a href="index.php?c=product&a=show&id=<?=$relatedProduct->getId()?>"><?=$relatedProduct->getName()?></a></h4>
							<p class="price"><?=number_format($relatedProduct->getPrice())?></p>
						</div>
					</div>
				</div>
				<?php $count++ ?>
			<?php endforeach ?>
		</div>
	</div>
</section>

<?php require "layout/footer.php" ?>