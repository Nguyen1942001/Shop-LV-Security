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
                        <h3 class="card-title">Thêm sản phẩm mới</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=product&a=save" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="form-group">
                                <label for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" placeholder="Nhập tên sp" name="name" required>
                            </div>

                            <div class="form-group">
                                <label for="price">Giá sản phẩm</label>
                                <input type="number" class="form-control" id="price" placeholder="Giá" name="price" required>
                            </div>

                            <div class="form-group">
                                <div>
                                    <label for="image">Hình ảnh sản phẩm</label><br>
                                    <img src="" id="image" alt="" style="width: 120px;">
                                </div>

                                <label for="exampleInputFile">Chọn hình ảnh</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image" onchange="loadFile(event)" required>
                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục sản phẩm</label>
                                <select class="form-control select2" name="category_id" style="width: 100%;">
                                    <?php foreach($categories as $category): ?>
                                        <option value="<?=$category->getId()?>"><?=$category->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <input type="text" class="form-control" name="size1" value="S" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="qty">Số lượng</label>
                                        <input type="number" class="form-control" id="qty" name="qty1" placeholder="Số lượng" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <input type="text" class="form-control" name="size2" value="M" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="qty">Số lượng</label>
                                        <input type="number" class="form-control" id="qty" name="qty2" placeholder="Số lượng" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <input type="text" class="form-control" name="size3" value="L" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="qty">Số lượng</label>
                                        <input type="number" class="form-control" id="qty" name="qty3" placeholder="Số lượng" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Size sản phẩm</label>
                                        <input type="text" class="form-control" name="size4" value="XL" disabled>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="qty">Số lượng</label>
                                        <input type="number" class="form-control" id="qty" name="qty4" placeholder="Số lượng" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="featured">Nổi bật</label><br>
                                <input name="featured" id="featured" type="checkbox" value="1">
                            </div>

                            <div class="form-group">
                                <label for="short-description">Mô tả tóm tắt</label><br>
                                <textarea name="short_description" id="short-description" rows="4" class="form-control" placeholder="Không quá 50 chữ" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="full-description">Mô tả đầy đủ</label><br>
                                <textarea name="full_description" id="full-description" rows="10" class="form-control" placeholder="Nhập mô tả" required></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm sản phẩm mới</button>
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