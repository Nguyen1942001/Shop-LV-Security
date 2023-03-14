<?php require "layout/header.php" ?>

<!-- Slider -->
<div class="hero-slider">
    <div class="slider-item th-fullpage hero-area" style="background-image: url(../upload/slider/slider-1.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-center">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PHƯƠNG CHÂM</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Đồng hành cùng đẳng <br>
                        cấp thời trang.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                        href="index.php?c=product">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-item th-fullpage hero-area" style="background-image: url(../upload/slider/slider-2.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-left">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PHƯƠNG CHÂM</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Đồng hành cùng đẳng <br>
                        cấp thời trang.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                        href="index.php?c=product">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
    <div class="slider-item th-fullpage hero-area" style="background-image: url(../upload/slider/slider-3.jpg);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-right">
                    <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">PHƯƠNG CHÂM</p>
                    <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">Đồng hành cùng đẳng <br>
                        cấp thời trang.</h1>
                    <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn"
                        href="index.php?c=product">Mua Ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Slider -->

<section class="product-category section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title text-center">
                    <h2>Danh Mục Sản Phẩm Nổi Trội</h2>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box">
                    <a href="index.php?c=product&category_id=1">
                        <img src="../upload/shop/category/category-1.PNG" alt="" />
                        <div class="content">
                            <h3>Trang Phục</h3>
                            <p>Các Mẫu Hot Nhất Hiện Nay</p>
                        </div>
                    </a>
                </div>
                <div class="category-box">
                    <a href="index.php?c=product&category_id=5">
                        <img src="../upload/shop/category/category-2.PNG" alt="" />
                        <div class="content">
                            <h3>Đồng Hồ</h3>
                            <p>Đa Dạng Về Lựa Chọn</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="category-box category-box-2">
                    <a href="index.php?c=product&category_id=3">
                        <img src="../upload/shop/category/category-3.PNG" alt="" />
                        <div class="content">
                            <h3>Trang Sức</h3>
                            <p>Thiết Kế Thời Thượng, Sang Trọng</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products section bg-gray">
    <div class="container">
        <div class="row">
            <div class="title text-center">
                <h2>Các Sản Phẩm Nổi Bật</h2>
            </div>
        </div>
        <div class="row equal">
            <?php foreach ($featuredProducts as $featuredProduct): ?>
            <div class="col-md-4 col-sm-6">
                <div class="product-item">
                    <div class="product-thumb">
                        <img class="img-responsive" src="../upload/<?=$featuredProduct->getFeaturedImage()?>"
                            alt="product-img" />
                        <div class="preview-meta">
                            <ul>
                                <li>
									<a href="index.php?c=product&a=show&id=<?=$featuredProduct->getId()?>"><i class="tf-ion-ios-search"></i></a>
								</li>

                                <?php if ($featuredProduct->getTotalQty() > 0): ?>
                                    <li>
                                        <a product-id="<?=$featuredProduct->getId()?>" <?=$featuredProduct->getCategory()->getId() == 1 || $featuredProduct->getCategory()->getId() == 4 ? 'size="S"' : 'size=""'?> class="buy"><i class="tf-ion-android-cart"></i></a>
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
                        <h4><a href="index.php?c=product&a=show&id=<?=$featuredProduct->getId()?>"><?=$featuredProduct->getName()?></a></h4>
                        <p class="price"><?=number_format($featuredProduct->getPrice())?></p>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</section>







<?php require "layout/footer.php" ?>