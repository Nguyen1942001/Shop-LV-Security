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
                        <h3 class="card-title">Sửa thông tin nhân viên</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=staff&a=update">
                        <div class="card-body">
                            <input type="hidden" name="staff_id" value="<?=$staff->getId()?>">

                            <div class="form-group">
                                <label for="fullname">Họ tên</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Nhập họ tên" name="fullname" value="<?=$staff->getName()?>" required>
                            </div>

                            <div class="form-group">
                                <label for="text">Tên đăng nhập</label>
                                <input type="text" class="form-control" id="text" placeholder="Nhập tên đăng nhập" name="username" value="<?=$staff->getUsername()?>" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Nhập password" name="password">
                            </div>     
                            
                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phoneNumber" placeholder="Nhập số điện thoại" name="phoneNumber" value="<?=$staff->getMobile()?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Nhập địa chỉ" name="email" value="<?=$staff->getEmail()?>" required>
                            </div>

                            <div class="form-group">
                                <label>Vai trò</label>
                                <select class="form-control select2" name="role_id" style="width: 100%;">
                                    <?php foreach($roles as $role): ?>
                                        <option value="<?=$role->getId()?>" <?=$staff->getRole()->getId() == $role->getId() ? "selected" : ""?>><?=$role->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="active">Kích hoạt</label><br>
                                <input name="is_active" id="active" type="checkbox" value="1" <?=$staff->getIsActive() == 1 ? "checked" : ""?>>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa thông tin nhân viên</button>
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