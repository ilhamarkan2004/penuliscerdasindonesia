<style>
    .text-danger {
            color: rgb(255, 0, 0);
        }
</style>

<div class=" flex justify-center">
    <div class="main flex container flex justify-center py-16 px-9 md:px-16">
            <!-- <div class="sticky top-0">
                <div class="text-center sticky top-20 hidden lg:block ">
                    <div class="blok absolute"></div>
                    <h1 class="font-bold text-[36px]">Improve your Digital Skill with us</h1>
                    <p>Raih karir sebagai talenta digital melalui program yang kami sediakan</p>
                    <img src="<?= base_url() ?>assets/assets/img/login/jum.svg" alt="">
                </div>
            </div> -->
            <div class="mx-auto border border-2 rounded-lg w-full lg:w-1/3 p-9">
            <div class="p-5">
            <p class="text-primary-100" style="font-size: 21px;">Selamat datang di <br> <a href="<?= base_url() ?>" style=" font-weight: 600; text-decoration: none;">Penulis Cerdas Indonesia</a></p>
            <h2 style="font-size: 55px; font-weight: 500; margin-bottom: 35px;">Register</h2>
  
                    <form action="" method="POST" id="formRegist">
                        <div class="mb-6">
                            <label for="nama" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                            <input type="text" name="nama" id="nama" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="Nama">
                            <small id="name_err" class="text-danger"></small>
                        </div>
                        <div class="mb-6">
                            <label for="nomorHp" class="block mb-2 text-sm font-medium text-gray-900">Nomor HP </label>
                            <span class="text-green-500 text-[12px]">* Pastikan nomor Anda aktif!</span>
                            <div class="flex">
                                <span class="flex items-center mx-2 py-3 px-3 font-semibold text-sm text-white bg-primary-100 border border-gray-300 border-gray-300 rounded-lg">
                                    +62
                                </span>
                                <input type="text" id="nomorHp" name="nohp" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="8xxxxxxxxxx">
                            </div>

                            <small id="nohp_err" class="text-danger"></small>
                            <small id="mustNum" class="text-danger"></small>
                        </div>
                        <div class="mb-6">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                            <input type="text" name="email" id="email" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block focus:outline-none focus:ring-blue-500 focus:border-blue-500  p-2.5" placeholder="example@gmail.com">
                            <small id="email_err" class="text-danger"></small>
                        </div>
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-900"> Password</label>
                        <div class="input-group flex">
                            <input type="password" id="password" name="password" class=" w-full border border-1 border-gray-300 rounded-bl-lg rounded-tl-lg py-3 px-3 block focus:outline-none focus:ring-blue-500 focus:border-blue-500" name="password" id="password" placeholder="Masukkan Password" />
                            <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnPw" onclick="change1()">
                                <i class="fa fa-eye fa-lg"></i>
                            </button>
                        </div>
                        <small id="password_err" class="text-danger"></small>
                       
                        <label for="passConf" class="block mb-2 mt-3 text-sm font-medium text-gray-900">Konfirmasi Password</label>
                        <div class="input-group flex">
                            <input type="password" id="passConf" name="passConf" class=" w-full border border-1 border-gray-300 rounded-bl-lg rounded-tl-lg py-3 px-3 block focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan Password" />
                            <button class="border px-2 rounded-tr-lg rounded-br-lg border-[#ADADAD] block" type="button" id="btnKPw" onclick="change2()">
                                <i class="fa fa-eye fa-lg"></i>
                            </button>
                        </div>
                        <small id="passConf_err" class="text-danger"></small>
                        

                        <div class="mb-6 mt-6">
                            <label for="referral" class="block mb-2 text-sm font-medium text-gray-900">Kode Referral</label>
                            <input type="text" name="referral" id="referral" class="w-full py-3 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block focus:outline-none focus:ring-blue-500 focus:border-blue-500 p-2.5" placeholder="Kode referral">
                            <small id="referral_err" class="text-danger"></small>
                        </div>


                    </form>

                    <div class="mt-2">
                        <button class="text-white w-full rounded-lg py-3 px-3 mt-4 bg-primary-100" id="register" type="button" >Buat Akun</button>
                    </div>
                    <p class="text-center text-[13px] text-[#808080] mt-5">Sudah punya akun? <a class="text-[#4285F4]" id="" href="<?= base_url('auth') ?>">Login</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#register").off("click");
        $(document).on("click", "#register", function() {
            $('#name_err').text('');
            $('#email_err').text('');
            $('#nohp_err').text('');
            $('#password_err').text('');
            $('#passConf_err').text('');
            $("#mustNum").text("");
            var data = $('#formRegist').serialize();
            $.ajax({
                type: "POST",
                url: '<?= base_url('auth/prosesRegist') ?>',
                data: data,
                dataType: "json",
                success: function(response) {
                    var message = response.message
                    if (response.success == false) {
                        $('#name_err').text(message.nama);
                        $('#email_err').text(message.email);
                        $('#nohp_err').text(message.nohp);
                        $('#password_err').text(message.password);
                        $('#passConf_err').text(message.passConf);
                        $('#referral_err').text(message.referral);
                    } else {
                        // setTimeout(function() {
                        //     window.location.href = <?= base_url('auth') ?>;
                        // }, 2000)
                        // window.location.reload();
                        Swal.fire({
                            // position: 'top-end',
                            icon: "success",
                            text: response.message,
                            showConfirmButton: true
                        }).then((result) => {
                            if (result.isConfirmed) {
                                if (result.isConfirmed) {
                                    window.location.href = '<?= base_url('auth') ?>';
                                }
                            }
                        })


                    }
                }
            });
        })
        $("#nomorHp").keyup(function(e) {
            e.preventDefault();

            if (/\D/g.test(this.value)) {
                // Filter non-digits from input value.
                this.value = this.value.replace(/\D/g, "");
                $("#mustNum").text("Hanya dapat diisi menggunakan nomor");
            }else{
                $("#mustNum").text("");
            }

        });

        
  $("#nama").keypress(function (e) {
    if (e.which === 32 && !this.value.length) {
      e.preventDefault();
      $("#name_err").text("Tidak dapat menggunakan spasi diawal nama");
    }
    var inputValue = event.charCode;
    if (
      !(inputValue >= 65 && inputValue <= 122) &&
      inputValue != 32 &&
      inputValue != 0
    ) {
      e.preventDefault();
      $("#name_err").text("Nama hanya dapat menggunakan huruf");
    }else{
        $("#name_err").text("");
    }
  });
    </script>
    <script src="<?php echo base_url('assets/js/') ?>sweetalert2.all.min.js"></script>


    </script>
    <script src="<?= base_url('assets/js/jquery-3.4.1.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>

    <!-- <script type="text/javascript" src="">
        // ALERT REGISTRASI BERHASIL
        $(document).ready(function(){
            if($this->session->userdata('sukses')){
                Swal({
                title: 'Selamat',
                text: 'Registrasi Akun Anda Berhasil',
                type: 'success'
            }).then(function(){
            window.location.href = <?= base_url('auth') ?>
            });
            }
            } 
        });
    </script> -->

    <script type="text/javascript">
        $(document).ready(function() {
            loadkabupaten();
            loadkecamatan();
        });

        function loadkabupaten() {
            $("#prov_id").change(function() {
                var getprovinsi = $(this).val();

                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "<?= base_url(); ?>auth/getdatakab",
                    data: {
                        provinsi: getprovinsi
                    },
                    async: false,
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id + '">' + data[i].nama_kabupaten_kota + '</option>';
                        }
                        $("#kab_id").html(html);
                    }
                });
            });
        }

        function loadkecamatan() {
            $("#kab_id").change(function() {
                var getkabupaten = $(this).val();
                console.log(getkabupaten);
                $.ajax({
                    type: "POST",
                    dataType: "JSON",
                    url: "<?= base_url(); ?>auth/getdatakec",
                    data: {
                        kabupaten: getkabupaten
                    },
                    async: false,
                    success: function(data) {
                        console.log(data);
                        var html = '';
                        var i;
                        for (i = 0; i < data.length; i++) {
                            html += '<option value="' + data[i].id + '">' + data[i].nama_kecamatan + '</option>';
                        }
                        $("#kec_id").html(html);
                    }
                });
            });
        }
    </script>
    <script>
        function change1() {
            var x = document.getElementById('password').type;
            if (x == 'password') {
                document.getElementById('password').type = 'text';

                document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
            } else {
                document.getElementById('password').type = 'password';

                document.getElementById('btnPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
            }
        }

        function change2() {
            var x = document.getElementById('passConf').type;
            if (x == 'password') {
                document.getElementById('passConf').type = 'text';

                document.getElementById('btnKPw').innerHTML = '<i class="fa fa-eye-slash fa-lg"></i>'
            } else {
                document.getElementById('passConf').type = 'password';

                document.getElementById('btnKPw').innerHTML = '<i class="fa fa-eye fa-lg"></i>';
            }
        }
    </script>