<?php 
   $menu = include (__DIR__.'./../../config/menuadmin.php');
   include(__DIR__.'./../../lib/session.php');
  
   Session::checkSession();
   $page_title = "admin dashboard";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title><?=$page_title?></title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="./public/admin/assets/img/favicon/favicon.ico" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="<?=showlinkimage()?>/public/admin/assets/vendor/libs/apex-charts/apex-charts.css" />
    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <!-- Numeral.js -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script> -->

    <!-- Helpers -->
    <script src="<?=showlinkimage()?>/public/admin/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?=showlinkimage()?>/public/admin/assets/js/config.js"></script>
    <style>
    .label-info{
        /* background: linear-gradient(to right, #4b79a1, #283e51); */
        background-color: #000;
    }
    .bootstrap-tagsinput{
        width: 100%;
        padding: 5px;
    }
    .bootstrap-tagsinput .tag{
        border-radius:5px;
        padding:3px 5px 3px 5px;
    }
</style>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.php" class="app-brand-link">
              <span class="app-brand-text demo menu-text fw-bolder ms-2">store Test</span>
            </a>
            <!-- <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a> -->
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <!-- <li class="menu-item active">
              <a href="../index.php" class="menu-link">
              <box-icon name='home' color="#697a8d" size="sm"></box-icon>
                <div data-i18n="Analytics">Trang chủ</div>
              </a>
            </li> -->
            <!-- Layouts -->
            <?php foreach ($menu as $key => $val): 
              $requestUri = $_SERVER['REQUEST_URI'];
              $segments = explode('/', $requestUri);

              $productSegment = $segments[4];
              ?>
              
            <!-- <li class="menu-header small text-uppercase"><span class="menu-header-text">123</span></li> -->
              <li class="menu-item <?=$val['segment'] == $segments[4] ? "active":""?>">
                <a href="<?=$val['link']?>" class="menu-link <?=isset($val['items']) ?"menu-toggle":""?>">
                <box-icon name='<?= $val['icon']?>' color="#697a8d" size="sm" style="margin-right:5px"></box-icon>
                <div data-i18n="<?= $val['label']?>"><?= $val['label']?></div>
              </a>
            <?php if (isset($val['items'])):?>
              <ul class="menu-sub">
                <?php foreach ($val['items'] as $key => $keyitem):?>
                <li class="menu-item">
                  <a href="<?=$keyitem['link']?>" class="menu-link">
                    <div data-i18n="<?=$keyitem['label']?>"><?=$keyitem['label']?></div>
                  </a>
                </li>
                <?php endforeach; ?>
              </ul>
            <?php endif; ?>
            </li>
            <?php endforeach; ?>
          </ul>
        </aside>
        <!-- end menu -->

        
        