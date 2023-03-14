<?php require "layout/header.php"?>

<section class="page-header">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="content">
          <h1 class="page-name">Tài Khoản</h1>
          <ol class="breadcrumb">
            <li><a href="index.php">Trang Chủ</a></li>
            <li class="active">Thông Tin Tài Khoản</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="user-dashboard page-wrapper">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ul class="list-inline dashboard-menu text-center">
          <li><a class="active" href="index.php?c=customer&a=info">Thông Tin Tài Khoản</a></li>
          <li><a href="index.php?c=customer&a=shipping">Địa Chỉ Giao Hàng</a></li>
          <li><a href="index.php?c=order">Đơn Đặt Hàng</a></li>
        </ul>

        <form action="index.php?c=customer&a=updateInfo" method="POST" class="form-change-info">
          <div class="dashboard-wrapper dashboard-user-profile">
            <div class="media">
              <div class="row">
                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center label-info-account">
                      <label for="">Họ Tên</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <input type="text" value="<?=$name?>" name="name" required>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center label-info-account">
                      <label for="">Số điện thoại</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <input type="tel" value="<?=$mobile?>" name="mobile" required>
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center label-info-account">
                      <label for="">Mật Khẩu Hiện Tại</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <input type="password" value="" name="current_password">
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center label-info-account">
                      <label for="">Mật Khẩu Mới</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <input type="password" value="" name="new_password">
                    </div>
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 text-center label-info-account">
                      <label for="">Nhập Lại Mật Khẩu Mới</label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                      <input type="password" value="" name="confirmation_password">
                    </div>
                  </div>
                </div>

                <div class="col-lg-12 text-right">
                  <button type="submit" class="btn btn-main mt-20">Cập Nhật</button>
                </div>
              </div>

            </div>
          </div>
      </div>
      </form>

    </div>
  </div>
  </div>
</section>

<?php require "layout/footer.php"?>