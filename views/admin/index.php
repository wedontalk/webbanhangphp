<?php
  include('header.php');
?>

    <!-- Layout container -->
    <div class="layout-page">
      
    <?php include('menusearch.php')?>
      <!-- Navbar -->

      <!-- / Navbar -->

      <!-- Content wrapper -->
      <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
          <div class="row">
            <!-- Thông báo admin -->
            <div class="col-lg-8 mb-4 order-0">
              <div class="card">
                <div class="d-flex align-items-end row">
                  <div class="col-sm-7">
                    <div class="card-body">
                      <h5 class="card-title text-primary">Xin Chào <?php echo Session::get('adminName')?> 🎉</h5>
                      <p class="mb-4">
                        Chào mừng <span class="fw-bold"><?php echo Session::get('adminName')?></span> đã đến với trang quản trị
                      </p>

                      <a href="javascript:;" class="btn btn-sm btn-outline-primary">Thông tin</a>
                    </div>
                  </div>
                  <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                      <img
                        src="<?=showlinkimage()?>/public/admin/assets/img/illustrations/man-with-laptop-light.png"
                        height="140"
                        alt="View Badge User"
                        data-app-dark-img="illustrations/man-with-laptop-dark.png"
                        data-app-light-img="illustrations/man-with-laptop-light.png"
                      />
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end thông báo -->
          </div>
        </div>
        <!-- / Content -->
        
    </div>
    <!-- end layout container -->
<?php
  include('footer.php');
?>
