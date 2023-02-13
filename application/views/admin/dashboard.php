<style>
  .cardContainer {
    height: fit-content;
    display: flex;
    flex-wrap: wrap;
    gap: 16px;
    align-items: center;
    justify-content: center;
    padding-bottom: 2px;
  }

  .cardDashboard {
    width: 300px;
    height: 160px;
    position: relative;
    border-radius: 10px;
  }

  .subCardDash {
    display: flex;
    align-items: center;
    padding: 2rem;
  }

  .labelTipe {
    background-color: #d4f5ff;
    position: absolute;
    border: 2px solid #1dacd9;
    color: #1dacd9;
    font-weight: 600;
    border-radius: 7px;
    padding: 3px 7px;
    font-size: smaller;
    margin: 7px 14px;
  }

  .dropdown-toggle::after {
    content: none;
  }

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

  .margin-x-2 {
    margin-left: 2rem;
    margin-right: 2rem;
  }

  .margin-t-2 {
    margin-top: 1rem;
  }

  @media (min-width: 768px) {

    .lg-mb-3 {
      margin-bottom: 1.5rem;
    }

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

    .lg-pt-5 {
      padding-top: 5rem;
    }

    .lg-mx-5 {
      margin-left: 5rem;
      margin-right: 5rem;
    }

  }
</style>

<!-- Modal Data Profile -->
<div class="modal fade " id="ProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content ">
      <div class="modal-header">
        <h5 class="modal-title" id="jdlModelProfile">Edit Profile</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" id="formProfile" enctype="multipart/form-data" method="POST">
          <div>
            <label for="">Nama <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama anda" value="<?= $user['name'] ?>">
            <small class="text-danger" id="errName"></small>
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control" name="desc" id="desc" rows="3"><?= $user['description'] ?></textarea>
            <small id="errDesc" class="text-danger"></small>
          </div>
          <label for="">Telepon <span class="text-danger">*</span></label>
          <div class="input-group">
            <span class="input-group-text text-bold border-end" id="basic-addon1">+62</span>
            <input type="text" class="form-control ms-2" id="telp" name="telp" placeholder="Masukkan nomor telepon anda" value="<?= substr($user['phone'], 2) ?>">
          </div>
          <small class="text-danger" id="errTelp"></small>
          <div>
            <label for="img">Foto Profil</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" name="img_profile" id="img_profile" accept=".jpg, .jpeg, .png">
              <label class="custom-file-label" for="customFile"></label>
            </div>
            <small id="errImg" class="text-danger"></small>
          </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button id="" class="btn btn-primary aksiProfile">Ubah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Data Password -->
<div class="modal fade" id="PassModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="jdlModelPass">Edit Password</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post" id="formPass">
          <div>
            <label for="">Password lama <span class="text-danger">*</span></label>

            <input type="password" class="form-control" id="oldPass" name="oldPass" placeholder="Masukkan password lama">

            <small class="text-danger" id="errOldPass"></small>
          </div>
          <div>
            <label for="">Password baru <span class="text-danger">*</span></label>
            <div class="d-flex">
              <input type="password" class="form-control" id="newPass" name="newPass" placeholder="Masukkan password baru">
              <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnPw" onclick="change()">
                <i class="fa fa-eye fa-lg"></i>
              </button>
            </div>
            <small class="text-danger" id="errNewPass"></small>
          </div>
          <div>
            <label for="">Verifikasi Password <span class="text-danger">*</span></label>
            <div class="d-flex">
              <input type="password" class="form-control" id="verif" name="verif" placeholder="Masukkan verifikasi password">
              <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnPw2" onclick="change2()">
                <i class="fa fa-eye fa-lg"></i>
              </button>
            </div>
            <small class="text-danger" id="errVerif"></small>
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" id="" class="btn btn-primary aksiPass">Tambah</button>

      </div>
    </div>
  </div>
</div>


<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">

  <div class="navbar navbar-main navbar-expand-lg px-0 mx-0 lg-relative  shadow-none" id="navbarBlur" navbar-scroll="true" style="flex-direction:column; align-items:flex-start; ">
    <div id="edit-profile" style="z-index: 5;" class="dropdown">
      <a class="text-white flex items-center dropdown-toggle " href="#" role="button" data-toggle='dropdown' aria-expanded="false">
        <!-- <i class="fa-solid fa-gear text-white"></i> -->
        <h6 class="mx-3" style="color:white;">Settings</h6>
      </a>

      <ul class="dropdown-menu">
        <li><button class="btn pt-2 mx-2" id="edtProfile">Edit profil</button></li>
        <li><button class="btn pt-2 mx-2" id="edtPassword">Ubah Password</button></li>
      </ul>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>


    <div class="flex justify-center lg-justify-left lg-absolute w-100">
      <div id="profile" class=" lg-flex lg-px-3">
        <div class="flex justify-center ">
          <img src="<?= base_url() ?><?= (file_exists('./' . $user['img_profile']) && $user['img_profile'] != '') ? $user['img_profile'] : 'assets/assets/img/index/default.png'; ?>" class="img-circle">
        </div>
        <div class="w-auto flex items-center lg-px-3">
          <h3 class="lg-mb-3" style="color:white;"><?= $user['name'] ?></h3>
        </div>
      </div>
    </div>
  </div>
  <h6 class="text-tengah lg-text-left lg-pl-30"><?= $user['email'] ?></h6>

  <div class="lg-mx-5 lg-pt-5 margin-x-2 margin-t-2 d-flex justify-content-center">
    <i class="fa-solid fa-quote-left"></i>
    <span class="my-2"><?= $user['description'] ?></span>
    <i class="fa-solid fa-quote-right"></i>
  </div>


  <div class="flex justify-center text-white">
    <div class="lg-flex gap-3 cardContainer">
      <?php foreach ($cards as $card) : ?>
        <div style="background-color: <?= $card['bg-color'] ?>;" class="cardDashboard mt-3 flex align-center">
          <div class="subCardDash">
            <div>
              <p class="text-bold fs-5"><?= $card['titleCard'] ?></p>
              <p style="display: inline;" class="fs-6 text-bold"><?= $card['isi'] ?></p>
            </div>
          </div>
          <div style="position:absolute;right:0px;top:0px">
            <i class="<?= $card['icon'] ?>" style="transform: rotate(-10deg); opacity: 50%; font-size: 5em;"></i>

          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>

  <script>
    function change() {
      var x = document.getElementById('newPass').type;
      if (x == 'password') {
        document.getElementById('newPass').type = 'text';

        document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
      } else {
        document.getElementById('newPass').type = 'password';

        document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
      }
    }

    function change2() {
      var x = document.getElementById('verif').type;
      if (x == 'password') {
        document.getElementById('verif').type = 'text';

        document.getElementById('btnPw2').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
      } else {
        document.getElementById('verif').type = 'password';

        document.getElementById('btnPw2').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
      }
    }
  </script>