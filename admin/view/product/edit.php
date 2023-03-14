<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | General Form Elements</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="public/css/adminlte.min.css">
    <!-- Css cá nhân -->
    <link rel="stylesheet" href="public/css/admin.css">
</head>

<?php require "layout/header.php"?>

<div class="content-wrapper">

    <!-- Tiêu đề phần nội dung -->
    <section class="content-header">
        <div class="container-fluid">

        </div>
    </section>

    <!-- Nội dung chính -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Sửa thông tin sản phẩm</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=product&a=update" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" name="product_id" value="<?=$product->getId()?>">

                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Nhập tên sp" value="<?=$product->getName()?>" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Giá sản phẩm</label>
                                <input type="number" class="form-control" name="price" id="price" placeholder="Giá" value="<?=$product->getPrice()?>" required>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="image">Hình ảnh sản phẩm</label><br>
                                    <img src="../upload/<?=$product->getFeaturedImage()?>" id="image" alt="" style="width: 120px;">
                                </div>

                                <label for="exampleInputFile">Thay đổi hình ảnh sản phẩm</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image" onchange="loadFile(event)">
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục sản phẩm</label>
                                <select class="form-control select2" name="category_id" style="width: 100%;">
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?=$category->getId()?>" <?=$category->getId() == $product->getCategoryId() ? "selected" : ""?>><?=$category->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <?php 
                                $qty = "qty";
                                $count = 0;
                                for ($i = 0; $i < count($arrayProductDetail); $i++): 
                                    $qty = "qty";
                                    $count++;
                                    $qty .= $count;
                            ?>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Size sản phẩm</label>
                                            <input type="text" class="form-control" value="<?=$arrayProductDetail[$i]["size"]?>" disabled>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="qty">Số lượng</label>
                                            <input type="number" class="form-control" id="qty" placeholder="Số lượng" name="<?=$qty?>" value="<?=$arrayProductDetail[$i]["qty"]?>" required>
                                        </div>
                                    </div>
                                </div>
                            <?php endfor ?>

                            <div class="form-group">
                                <label for="featured">Nổi bật</label><br>
                                <input name="featured" id="featured" type="checkbox" value="1" <?=$product->getFeatured() == 1 ? "checked" : ""?>>
                            </div>

                            <div class="form-group">
                                <label for="short-description">Mô tả tóm tắt</label><br>
                                <textarea name="short_description" id="short-description" rows="4" class="form-control" placeholder="Không quá 50 chữ" required><?=$product->getShortDescription()?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="full-description">Mô tả đầy đủ</label><br>
                                <textarea name="full_description" id="full-description" rows="10" class="form-control" placeholder="Nhập mô tả" required><?=$product->getFullDescription()?></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>

<?php require "layout/footer.php"?>

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="public/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="public/js/adminlte.min.js"></script>
<!-- FIle js cá nhân -->
<script src="public/js/admin.js"></script>

<!-- Page specific script -->
<script>
    $(function () {
        bsCustomFileInput.init();
    });
</script>
</body>

</html>