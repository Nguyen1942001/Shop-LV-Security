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
                        <h3 class="card-title">Sửa thông tin đơn hàng</h3>
                    </div>
                    <!-- /.card-header -->

                    <!-- form start -->
                    <form method="POST" action="index.php?c=order&a=updateOrder">
                        <div class="card-body">
                            <?php $decryption = new Decryption() ?>

                            <input type="hidden" name="order_id" value="<?=$order->getId()?>">

                            <div class="form-group">
                                <label for="text">Tên khách hàng</label>
                                <input type="text" class="form-control" id="text" value="<?=$decryption->decrypt($order->getShippingFullName())?>" name="fullname" placeholder="Tên KH" required>
                            </div>

                            <div class="form-group">
                                <label>Cập nhật trạng thái đơn hàng</label>
                                <select class="form-control select2" name="status_id" style="width: 100%;">
                                    <?php foreach ($statuses as $status): ?>
                                        <option value="<?=$status->getId()?>" <?=$status->getId() == $order->getOrderStatusId() ? "selected" : ""?>><?=$status->getDescription()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phoneNumber">Số điện thoại</label>
                                <input type="tel" class="form-control" id="phoneNumber" value="<?=$decryption->decrypt($order->getShippingMobile())?>" placeholder="Nhập số điện thoại" name="phoneNumber"
                                    required value="">
                            </div>

                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" id="address" placeholder="Nhập địa chỉ"
                                    required name="address" value="<?=$decryption->decrypt($order->getAddress())?>"> 
                            </div>

                            <div class="form-group">
                                <label>Hình thức thanh toán</label>
                                <select class="form-control select2" style="width: 100%;" name="payment_method">
                                    <option value="0" <?=$order->getPaymentMethod() == 0 ? "selected" : ""?>>COD</option>
                                    <option value="1" <?=$order->getPaymentMethod() == 1 ? "selected" : ""?>>Bank</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhân viên phụ trách</label>
                                <select class="form-control select2" style="width: 100%;" name="staff_id">
                                    <option value="">Chọn nhân viên</option>
                                    <?php foreach($staffs as $staff): ?>
                                        <option value="<?=$staff->getId()?>" <?=$staff->getId() == $order->getStaffId() ? "selected" : ""?>><?=$staff->getName()?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Danh Sách Sản Phẩm Đã Đặt</h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>Mã SP</th>
                                                <th>Tên SP</th>
                                                <th>Giá</th>
                                                <th>Số lượng</th>
                                                <th>Size</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orderItems as $orderItem): ?>
                                                <tr>
                                                    <td><p><?=$orderItem->getProductId()?></p></td>
                                                    <td><p><?=$orderItem->getProduct()->getName()?></p></td>
                                                    <td><p><?=number_format($orderItem->getProduct()->getPrice())?>đ</p></td>
                                                    <td><p><?=$orderItem->getQty()?></p></td>
                                                    <td>
                                                        <select class="form-control select2" style="width: 100%;" name="size" disabled>
                                                            <option <?=!$orderItem->getSize() ? "selected" : ""?> value="">No Size</option>
                                                            <option <?=$orderItem->getSize() == "S" ? "selected" : ""?> value="S">S</option>
                                                            <option <?=$orderItem->getSize() == "M" ? "selected" : ""?> value="M">M</option>
                                                            <option <?=$orderItem->getSize() == "L" ? "selected" : ""?> value="L">L</option>
                                                            <option <?=$orderItem->getSize() == "XL" ? "selected" : ""?> value="XL">XL</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Sửa thông tin đơn hàng</button>
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