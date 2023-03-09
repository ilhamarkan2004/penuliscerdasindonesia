<style>
  .blok {
    width: 71%;
    height: 12px;
    background-color: #6BD1FF;
    z-index: -1;
    left: 0px;
    right: 0px;
    top: 31px;
    margin: auto;
  }

  img {
    width: 855px;
  }

  .alert {
    position: relative;
    top: 10;
    left: 0;
    width: auto;
    height: auto;
    padding: 10px;
    margin: 10px;
    line-height: 1.8;
    border-radius: 5px;
    cursor: hand;
    cursor: pointer;
    font-family: sans-serif;
    font-weight: 400;
  }

  .alertCheckbox {
    display: none;
  }

  :checked+.alert {
    display: none;
  }

  .alertText {
    display: table;
    margin: 0 auto;
    text-align: center;
    font-size: 16px;
  }

  .alertClose {
    float: right;
    padding-top: 5px;
    font-size: 10px;
  }

  .clear {
    clear: both;
  }


  .success {
    background-color: #EFE;
    border: 1px solid #DED;
    color: #9A9;
  }

  .notice {
    background-color: #EFF;
    border: 1px solid #DEE;
    color: #9AA;
  }

  .error {
    background-color: #FEE;
    border: 1px solid #EDD;
    color: #A66;
  }
</style>


<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="<?php echo base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />




<div class=" flex justify-center">
  <div class="main flex container flex justify-center py-16 px-9 md:px-16">

    <div class="mx-auto border border-2 rounded-lg w-full lg:w-1/3 p-9">
      <?php if ($this->session->flashdata('message_success')) : ?>
        <label>
          <input type="checkbox" class="alertCheckbox" autocomplete="off" />
          <div class="alert success">
            <span class="alertClose">X</span>
            <span class="alertText"><?= $this->session->flashdata('message_success') ?>
              <br class="clear" /></span>
          </div>
        </label>
      <?php endif; ?>
      <?php if ($this->session->flashdata('message_error')) : ?>
        <label>
          <input type="checkbox" class="alertCheckbox" autocomplete="off" />
          <div class="alert error">
            <span class="alertClose">X</span>
            <span class="alertText"><?= $this->session->flashdata('message_error') ?>
              <br class="clear" /></span>
          </div>
        </label>
      <?php endif; ?>
      <div class="p-5">

        <p style="font-size: 21px;">Selamat datang di <br> <a href="<?= base_url() ?>" style="color: #1089C0; font-weight: 600; text-decoration: none;">Penulis Cerdas Indonesia</a></p>
        <h2 style="font-size: 55px; font-weight: 500; margin-bottom: 35px;">Login</h2>

        <form id="f_login">
          <label for="email" class="form-label">Email</label>
          <input type="text" class="block w-full border border-1 border-gray-300 rounded-lg text-[14px] px-3 py-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="email" name="email" placeholder="Masukkan Email">
          <small id="emailError" class="text-danger"></small>
          <label for="password" class="mt-4"> Password</label>
          <div class="flex mt-2">
            <input type="password" class="block w-full border border-1 text-[14px] border-gray-300 rounded-bl-lg rounded-tl-lg py-3 px-3 block focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="password" id="password" placeholder="Masukkan Password" />
            <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnPw" onclick="change()">
              <i class="fa fa-eye fa-lg"></i>
            </button>
          </div>
          <small id="passError" class="text-danger"></small>
          <a href="<?= base_url('auth/forgot') ?>" class="d-block my-1 ms-auto text-end" style="font-size: 13px; text-decoration: none;">Forgot Password?</a>
        </form>

        <button class="text-white rounded-lg w-full py-3 px-3 mt-4 bg-[#1089C0] hover:bg-sky-700" type="button" id="btnLogin" name="btnLogin">Login</button>
        <p class="text-center text-[13px] text-[#808080] mt-3">Belum punya akun? <a class="text-[#4285F4]" id="" href="<?= base_url('auth/registrasi') ?>">Daftar</a></p>
      </div>

    </div>
  </div>
</div>

<script src="assets/boottrap/js/bootstrap.bundle.min.js"></script>



<!-- SweetAlert -->

<script type="text/javascript" src="">
  // ALERT REGISTRASI BERHASIL
  $(document).ready(function() {
    const flashData = $('.flash-data').data('set_flashdata');
    if (flashData) {
      Swal({
        title: 'Selamat',
        text: 'Registrasi Akun Anda Berhasil',
        type: 'success'
      });
    }
  });
</script>

<script>
  $("#btnLogin").off("click");
  $(document).on("click", "#btnLogin", function(e) {
    e.preventDefault();

    var data = $("#f_login").serialize();
    $.ajax({
      method: "post",
      url: "<?= base_url() ?>auth/login",
      data: data,
      cache: false,
      dataType: "json",
      success: function(data) {
        // console.log(data);
        var message = data.message;

        Swal.fire({
          // position: 'top-end',
          icon: message.icon,
          title: message.title,
          text: message.text,
          showConfirmButton: false,
          timer: 3000,
        });
        if (data.success) {
          setTimeout(function() {

            window.location = '<?= base_url() ?>';
          }, 3000);
        }

      },
    });
  });
</script>

<script>
  function change() {
    var x = document.getElementById('password').type;
    if (x == 'password') {
      document.getElementById('password').type = 'text';

      document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
    } else {
      document.getElementById('password').type = 'password';

      document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
    }
  }
</script>