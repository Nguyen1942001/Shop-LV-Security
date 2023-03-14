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
                        <h3 class="card-title">Sửa thông tin khách hàng</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=customer&a=update">
                        <div class="card-body">
                            <?php $decryption = new Decryption() ?>
                            <input type="hidden" name="customer_id" value="<?=$customer->getId()?>">

                            <div class="form-group">
                                <label for="fullname">Họ tên</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Nhập họ tên" name="fullname" value="<?=$decryption->decrypt($customer->getName())?>" required>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phoneNumber" placeholder="Nhập số điện thoại" name="phoneNumber" value="<?=$decryption->decrypt($customer->getMobile())?>" required>
                            </div>

                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ" name="address" value="<?=$decryption->decrypt($customer->getAddress())?>" required>
                            </div>

                            <div class="form-group">
                                <label>Kích hoạt tài khoản</label>
                                <select class="form-control select2" name="is_active" style="width: 100%;">
                                    <option selected="selected" value="1">Kích hoạt</option>
                                    <option value="0">Không kích hoạt</option>
                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa thông tin khách hàng</button>
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