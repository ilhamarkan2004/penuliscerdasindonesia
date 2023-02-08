<style>
  .flex {
    display: flex;
  }

  .justify-center {
    justify-content: center;
  }

  .mt-5 {
    margin-top: 5rem;
  }

  .text-tengah {
    text-align: center;
  }

  @media (min-width: 768px) {
    .lg-sideNavDiv {
      display: block;
    }

    .lg-justify-left {
      justify-content: left;
    }

    .lg-absolute {
      position: absolute;
    }

    .lg-relative {
      position: relative;
    }

    .lg-text-left {
      text-align: left;
    }

    .lg-flex {
      display: flex;
    }

    .items-center {
      align-items: center;
    }

    .lg-px-3 {
      padding-left: 3rem;
      padding-right: 3rem;
    }

    .lg-pl-30 {
      padding-left: 250px;
    }

  }
</style>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <div class="navbar navbar-main navbar-expand-lg px-0 mx-0 lg-relative  shadow-none" id="navbarBlur" navbar-scroll="true" style="flex-direction:column; align-items:flex-start; ">
    <a id="edit-profile" type='submit' href="<?= base_url('user/profile') ?>">
      <img src="<?= base_url() ?>assets/assets/vector/cog.svg" style="margin-right: 3px;">
      <h6 class="" style="margin-top:4px;color:white;">Edit Profil</h6>
    </a>
    <div class="flex justify-center lg-justify-left lg-absolute w-100">
      <div id="profile" class=" lg-flex lg-px-3">
        <div class="flex justify-center ">
          <img src="<?= base_url() ?>assets/assets/img/index/default.png" class="img-circle">
        </div>
        <div class="w-auto flex items-center lg-px-3">
          <h3 class="" style="color:white;"><?= $user['name'] ?></h3>
        </div>
      </div>
    </div>
  </div>
  <h6 class="text-tengah lg-text-left lg-pl-30"><?= $user['email'] ?></h6>

  <div class="flex justify-center text-white">
    <div class="lg-flex gap-3">
      <?php foreach ($cards as $card) : ?>
        <div style="background-color: <?=$card['bg-color']?>;" class="cardDashboard mt-5 flex align-center">
          <div class="subCardDash">
            <p class="text-bold fs-5"><?= $card['titleCard'] ?></p>
            <p style="display: inline;" class="fs-6 text-bold"><?= $card['isi'] ?></p>
          </div>
          <div style="position:absolute;right:0px;top:0px">
            <i class="<?= $card['icon'] ?>" style="transform: rotate(-10deg); opacity: 50%; font-size: 5em;"></i>
  
          </div>
        </div>
        <?php endforeach;?>
    </div>
  </div>