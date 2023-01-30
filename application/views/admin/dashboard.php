<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <div class="navbar navbar-main navbar-expand-lg px-0 mx-0  shadow-none" id="navbarBlur" navbar-scroll="true" style="flex-direction:column; align-items:flex-start; ">
    <a id="edit-profile" type='submit' href="<?= base_url('user/profile') ?>">
      <img src="<?= base_url() ?>assets/assets/vector/cog.svg" style="margin-right: 3px;">
      <h6 class="" style="margin-top:4px;color:white;">Edit Profil</h6>
    </a>
    <div id="profile" style="position:absolute; display:flex;align-items:center">
      <img src="<?= base_url() ?>assets/assets/img/index/default.png" class="img-circle" style="margin-left:25px">
      <div style="margin-left: 21px;">
        <h3 style="color:white;"><?= $user['name'] ?></h3>
        <h6><?= $user['email'] ?></h6>
      </div>
    </div>
  </div>