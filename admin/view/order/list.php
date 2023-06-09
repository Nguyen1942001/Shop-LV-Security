<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | DataTables</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="public/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách đơn hàng</h3>
                    </div>
                    <!-- /.card-header -->

                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Mã ĐH</th>
                                    <th>Tên KH</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Ngày giao hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Tổng SL sp</th>
                                    <th>Tổng cộng</th>
                                    <th>Nhân viên phụ trách</th>
                                    <th>Xác nhận</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $decryption = new Decryption();
                                    foreach ($orders as $order): ?>
                                    <tr>
                                        <td><?=$order->getId()?></td>
                                        <td><?=$decryption->decrypt($order->getShippingFullName())?></td>
                                        <td><?=$decryption->decrypt($order->getShippingMobile())?></td>
                                        <td><?=$order->getStatus()->getDescription()?></td>
                                        <td><?=$order->getCreatedDate()?></td>
                                        <td><?=$order->getDeliveredDate()?></td>
                                        <td><?=$order->getPaymentMethod() == 0 ? "COD" : "Bank"?></td>
                                        <td><?=$decryption->decrypt($order->getAddress())?></td>
                                        <td><?=$order->getTotalProductNumber()?></td>
                                        <td><?=$order->getTotalPrice()?></td>
                                        <td><?=!empty($order->getStaffId()) ? $order->getStaff()->getName() : ""?></td>
                                        <td><a href="index.php?c=order&a=confirm&order_id=<?=$order->getId()?>" onclick="return confirm('Bạn muốn xác nhận đơn hàng này?')" class="btn btn-primary btn-sm">Xác nhận</a></td>
                                        <td><a href="index.php?c=order&a=edit&order_id=<?=$order->getId()?>" class="btn btn-warning btn-sm">Sửa</a></td>
                                        <td><a href="index.php?c=order&a=deleteOrder&order_id=<?=$order->getId()?>" onclick="return confirm('Bạn muốn xóa đơn hàng này?')" class="btn btn-danger btn-sm">Xóa</a></td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Mã ĐH</th>
                                    <th>Tên KH</th>
                                    <th>Số điện thoại</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Ngày giao hàng</th>
                                    <th>Phương thức thanh toán</th>
                                    <th>Địa chỉ giao hàng</th>
                                    <th>Tổng số lượng sp</th>
                                    <th>Tổng cộng</th>
                                    <th>Nhân viên phụ trách</th>
                                    <th>Xác nhận</th>
                                    <th>Sửa</th>
                                    <th>Xóa</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
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
<!-- DataTables  & Plugins -->
<script src="public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="public/plugins/jszip/jszip.min.js"></script>
<script src="public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="public/js/adminlte.min.js"></script>
<!-- FIle js cá nhân -->
<script src="public/js/admin.js"></script>

<!-- Page specific script -->
<script>
    $(function () {
        $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
</body>

</html>