  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0   shadow-none" id="navbarBlur" navbar-scroll="true" style="flex-direction:column; align-items:flex-start;  ">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active2" aria-current="page"><?= $title ?></li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0"><?= $title ?></h6>
        </nav>

        <div class=" mt-sm-0 mt-2 me-md-0 me-sm-0" id="navbar" style="margin-top: 0px;">
          <div class="ms-md-auto pe-md-0 d-flex align-items-center" style="float: right;">
            <a href="" class="nav-link text-white font-weight-bold px-0" style="margin-right: 69px;">
              <i class="fa-solid fa-coins"></i>
              <span class="d-sm-inline text-white d-none"><?= $user['point'] ?> points</span>
            </a>
          </div>
        </div>


      </div>
      <div style="padding-left:13px;">
        <h3 style="color: #FFBC10;"><?= $sub_title ?></h3>
      </div>

    </nav>
    <!-- Akhir Navbar -->
    <!-- End Navbar -->

    <!-- Jquery DataTable -->
    <script src="<?php echo base_url() ?>assets/js/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/js/datatables.min.js"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>