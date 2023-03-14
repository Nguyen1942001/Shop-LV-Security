<?php require "layout/header.php" ?>

<section class="page-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content">
                    <h1 class="page-name">Sản Phẩm</h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Trang Chủ</a></li>
                        <li class="active"><?=$categoryName?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="products section">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="widget">
                    <h4 class="widget-title">Danh Mục Sản Phẩm</h4>
                    <select class="form-control" id="category">
                        <option value="">Tất Cả Sản Phẩm</option>
                        <?php foreach($categories as $category): ?>
                            <option value="<?=$category->getId()?>" <?=$category_id == $category->getId() ? "selected" : ""?>><?=$category->getName()?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="widget">
                    <h4 class="widget-title">Khoảng Giá</h4>

                    <select class="form-control" id="sort-price">
  						<option value="" <?=empty($price_range) ? "selected": ""?>>Mặc Định</option>
  						<option value="0-1000000" <?=$price_range=="0-1000000" ? "selected" :""?>>0 - 1.000.000</option>
  						<option value="1000000-2000000" <?=$price_range=="1000000-2000000" ? "selected" :""?>>1.000.000 - 2.000.000</option>
  						<option value="2000000-3000000" <?=$price_range=="2000000-3000000" ? "selected" :""?>>2.000.000 - 3.000.000</option>
  						<option value="3000000-5000000" <?=$price_range=="3000000-5000000" ? "selected" :""?>>3.000.000 - 5.000.000</option>
  						<option value="5000000-greater" <?=$price_range=="5000000-greater" ? "selected" :""?>>Trên 5.000.000</option>
  					</select>
                </div>

                <div class="widget">
                    <h4 class="widget-title">Sắp Xếp</h4>
                    <select class="form-control" id="sort-select">
                        <option value="" <?=empty($sort) ? "selected": ""?>>Mặc định</option>
                        <option value="price-asc" <?=$sort=="price-asc" ? "selected" :""?>>Giá tăng dần</option>
                        <option value="price-desc" <?=$sort=="price-desc" ? "selected" :""?>>Giá giảm dần</option>
                        <option value="alpha-asc" <?=$sort=="alpha-asc" ? "selected" :""?>>Từ A-Z</option>
                        <option value="alpha-desc" <?=$sort=="alpha-desc" ? "selected" :""?>>Từ Z-A</option>                                
                        <option value="created-asc" <?=$sort=="created-asc" ? "selected" :""?>>Cũ đến mới</option>
                        <option value="created-desc" <?=$sort=="created-desc" ? "selected" :""?>>Mới đến cũ</option>
                    </select>
                </div>
            </div>

            <div class="col-md-9">
                <div class="row equal">
                    <?php foreach($products as $product): ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="product-item">
                                <div class="product-thumb">
                                    <img class="img-responsive" src="../upload/<?=$product->getFeaturedImage()?>"
                                        alt="product-img" />
                                    <div class="preview-meta">
                                        <ul>
                                            <li>
                                                <a href="index.php?c=product&a=show&id=<?=$product->getId()?>"><i class="tf-ion-ios-search"></i></a>
                                            </li>

                                            <?php if ($product->getTotalQty() > 0): ?>
                                                <li>
                                                    <a product-id="<?=$product->getId()?>" <?=$product->getCategory()->getId() == 1 || $product->getCategory()->getId() == 4 ? 'size="S"' : 'size=""'?> class="buy"><i class="tf-ion-android-cart"></i></a>
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
                                    <h4><a href="index.php?c=product&a=show&id=<?=$product->getId()?>"><?=$product->getName()?></a></h4>
                                    <p class="price"><?=number_format($product->getPrice())?>đ</p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require "layout/footer.php" ?>