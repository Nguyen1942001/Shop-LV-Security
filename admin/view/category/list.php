<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Simple Tables</title>

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh Mục Sản Phẩm</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Mã Danh Mục</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($categories as $category): ?>
                                    <tr>
                                        <td><?=$category->getId()?></td>
                                        <td><?=$category->getName()?></td>
                                        <td><a href="index.php?c=category&a=edit&category_id=<?=$category->getId()?>" class="btn btn-warning btn-sm">Sửa</a>
                                        </td>
                                        <td><a data="<?=$category->getId()?>" href="index.php?c=category&a=delete&category_id=<?=$category->getId()?>" class="btn btn-danger btn-sm btn-delete-category">Xóa</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
</div>


<!-- /.row -->

<?php require "layout/footer.php"?>

<!-- jQuery -->
<script src="public/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="public/js/adminlte.min.js"></script>
<!-- FIle js cá nhân -->
<script src="public/js/admin.js"></script>
</body>

</html>