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
            <!-- Xuất hiện thông báo -->
            <?php 
                $message = "";  // Khởi tạo biến bằng rỗng để hàm if kiểm tra biến không bị lỗi
                if (!empty($_SESSION["success"])) {
                    $message = $_SESSION["success"];
                    $messageClass = "alert-success";
                    // Xóa phần tử dựa vào key
                    unset($_SESSION["success"]);
                }
                else if (!empty($_SESSION["error"])) {
                    $message = $_SESSION["error"];
                    $messageClass = "alert-danger";
                    // Xóa phần tử dựa vào key
                    unset($_SESSION["error"]);
                }
            ?>

            <?php if ($message): ?>
                <div class="alert <?=$messageClass?>">
                    <?=$message?>
                </div>
            <?php else: ?>
                <div class="alert alert-1" style="display: none;">
                    
                </div>
            <?php endif ?>
        </div>
    </section>

    <!-- Nội dung chính -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Thêm danh mục sản phẩm mới</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=category&a=save">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="newCategory">Tên danh mục</label>
                                <input type="text" class="form-control" id="newCategory"
                                    placeholder="Nhập tên danh mục" name="category_name">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Thêm</button>
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