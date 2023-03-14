<?php require "layout/header.php"?>

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Tài Khoản</h1>
					<ol class="breadcrumb">
						<li><a href="index.php">Trang Chủ</a></li>
						<li class="active">Địa Chỉ Giao Hàng</li>
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
          <li><a href="index.php?c=customer&a=info">Thông Tin Tài Khoản</a></li>
          <li><a class="active" href="index.php?c=customer&a=shipping">Địa Chỉ Giao Hàng</a></li>
          <li><a href="index.php?c=order">Đơn Đặt Hàng</a></li>
        </ul>
        <div class="dashboard-wrapper user-dashboard">
          <form action="index.php?c=customer&a=updateShipping" method="POST">
            <div class="table-responsive">
                  <table class="table">
                    <thead>
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          <th>Phone</th>
                          <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                          <td><input type="text" name="name" value="<?=$name?>"></td>
                          <td><input type="text" name="address" value="<?=$address?>"></td>
                          <td><input type="tel" name="mobile" value="<?=$mobile?>"></td>
                        </tr>
                    </tbody>
                  </table>
            </div>
              <div class="text-right">
                <button type="submit" class="btn btn-main mt-20">Cập Nhật</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require "layout/footer.php"?>
