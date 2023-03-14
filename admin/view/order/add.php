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
                        <h3 class="card-title">Thêm đơn hàng mới</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form>
                        <div class="card-body">

                            <div class="form-group">
                                <label>Tên khách hàng</label>
                                <select class="form-control select2 chosen-customer" name="customer_id" style="width: 100%;">
                                    <option value="">Chọn khách hàng</option>
                                    <?php foreach($customers as $customer): ?>
                                        <option value="<?=$customer->getId()?>"><?=$customer->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select class="form-control select2" name="status_id" style="width: 100%;">
                                    <?php foreach ($statuses as $status): ?>
                                        <option value="<?$status->getId()?>"><?=$status->getDescription()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control email" id="email" name="email" disabled>
                            </div>


                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input type="tel" class="form-control shipping_mobile" id="phoneNumber" name="shipping_mobile" placeholder="Nhập số điện thoại"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control address" id="address" name="address" placeholder="Nhập địa chỉ"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Hình thức thanh toán</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <option value="0">COD</option>
                                    <option value="1">Bank</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhân viên phụ trách</label>
                                <select class="form-control select2" style="width: 100%;">
                                    <?php foreach($staffs as $staff): ?>
                                        <option value="<?=$staff->getId()?>"><?=$staff->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <!-- Chỗ này sẽ dùng ajax để seacch tên sp, có nút lưu để lưu sp muốn chọn vào danh sách sp -->
                            <div class="form-group search-product">
                                <label for="product-name">Nhập tên sản phẩm cần tìm</label>
                                <input type="search" class="form-control search" id="product-name" name="search" value="" placeholder="Nhập từ khóa" required>

                                <div class="search-result">
                                    <!-- <div class="row">
                                        <div class="col-1">
                                            <span><img src="../upload/ALMA BB.jpg" style="width: 80px" alt=""></span>
                                        </div>

                                        <div class="col-8">
                                            <span>Tên sản phẩm</span>
                                        </div>

                                        <div class="col-2">
                                            <span>Giá sp</span>
                                        </div>
    
                                        <div class="col-1">
                                            <a href="" class="btn btn-primary btn-sm">Lưu</a>
                                        </div>
                                    </div> -->
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh Sách Sản Phẩm</h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap list-product">
                                        <thead>
                                            <tr>
                                                <th>Mã SP</th>
                                                <th>Tên SP</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Size</th>
                                                <th>SL tồn</th>
                                                <th>Xóa</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="form-group">
                                <label for="total-price">Tổng cộng</label>
                                <input type="number" class="form-control" id="total-price" name="total_price" value=""
                                    disabled>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" onclick="alert('Chức năng này chưa làm xong !!')">Thêm đơn hàng mới</button>
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