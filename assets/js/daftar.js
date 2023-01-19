$(document).ready(function () {
  var jumlahPendaftar = document.querySelectorAll("#no_hp_lain").length + 1;
  var limit = $("#add_no_hp").val();
  limitAddView(jumlahPendaftar, limit);

  $("#b_confirm_midtrans").off("click");
  $(document).on("click", "#b_confirm_midtrans", function (e) {
    e.preventDefault();

    if (validasi() != []) {
      console.log(validasi());
      notifikasi();
      return;
    }
    // $(this).prop("disabled", true);
    // $(this).text("Mohon tunggu ...");

    // setTimeout(function () {
    //   $(this).attr("disabled", false);
    //   $(this).text("Bayar Menggunakan Midtrans");
    // }, 2000);

    var data = $("#daftar").serialize();
    $.ajax({
      type: "POST",
      url: "daftar/token",
      data: data,
      cache: false,
      success: function (data) {
        // console.log("token = " + data);
        $(this).prop("disabled", false);
        $(this).text("Bayar Menggunakan Midtrans");

        var resultType = document.getElementById("result-type");
        var resultData = document.getElementById("result-data");

        function changeResult(type, data) {
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          onSuccess: function (result) {
            changeResult("success", result);
            // console.log(result.status_message);
            // console.log(result);
            $("#payment-form").submit();
          },
          onPending: function (result) {
            changeResult("pending", result);
            // console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function (result) {
            changeResult("error", result);
            // console.log(result.status_message);
            $("#payment-form").submit();
          },
        });
      },
    });
  });

  $("#b_confirm").off("click");
  $(document).on("click", "#b_confirm", function (e) {
    e.preventDefault();

    if (validasi() != "") {
      notifikasi();
      return;
    }

    var data = $("#daftar").serialize();
    $.ajax({
      method: "post",
      url: "daftar/manual",
      data: data,
      cache: false,
      dataType: "json",
      success: function (data) {
        // console.log(data);

        if (data.success == true) {
          Swal.fire({
            // position: 'top-end',
            icon: "success",
            title: "Berhasil melakukan pendaftaran",
            text: "Segera lakukan pembayaran agar pembelian tidak kadaluarsa",
            showConfirmButton: false,
            timer: 3000,
          });

          setTimeout(function () {
            var hp = "6281332332036";
            var textEncode = encodeURI(
              `*ID Order : ${data.id}*\nBerikut adalah bukti pembayaran dari program yang telah saya pilih.`
            );
            window.location = `https://wa.me/${hp}?text=${textEncode}`;
          }, 3000);
        } else {
          var message = data.message;
          if (message.redirect == true) {
            Swal.fire({
              // position: 'top-end',
              icon: message.icon,
              text: message.pesan,
              showConfirmButton: false,
              timer: 2000,
            });
            setTimeout(function () {
              window.location.href = message.target;
            }, 2000);
          } else {
            if (message.notif == true) {
              Swal.fire({
                // position: 'top-end',
                icon: message.icon,
                text: message.pesan,
                showConfirmButton: true,
                // timer: 2000,
              });
            }
          }
        }
      },
    });
  });

  $("#no_hp").keyup(function (e) {
    e.preventDefault();

    if (/\D/g.test(this.value)) {
      // Filter non-digits from input value.
      this.value = this.value.replace(/\D/g, "");
      $("#mustNum").text("Hanya dapat diisi menggunakan nomor");
    }

    $("#no_hp1").val($("#no_hp").val());
  });

  $("#p_otomatis").off("click");
  $(document).on("click", "#p_otomatis", function (e) {
    e.preventDefault;
    $("#p_manual").removeClass("metodeBayar-active");
    $("#p_otomatis").addClass("metodeBayar-active");
    $("#b_confirm_midtrans").removeClass("hidden");
    $("#b_confirm").addClass("hidden");
    $("#tf_ke").slideUp();
  });

  $("#p_manual").off("click");
  $(document).on("click", "#p_manual", function (e) {
    e.preventDefault;
    $("#p_otomatis").removeClass("metodeBayar-active");
    $("#p_manual").addClass("metodeBayar-active");
    $("#b_confirm").removeClass("hidden");
    $("#b_confirm_midtrans").addClass("hidden");
    $("#tf_ke").slideDown();
  });

  $("#add_no_hp").off("click");
  $(document).on("click", "#add_no_hp", function (e) {
    e.preventDefault();

    $("#d_no_hp").prepend(`<div id="per_nomor" class=" w-full">
        <label class="block my-3 w-full">
            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                Nomor telepon peserta lain
            </span>
      
            <div class="flex items-center">
            <div class="flex w-full">
               <span class="flex items-center mt-1 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                   +62
               </span>
                <input required type="text" id="no_hp_lain" name="no_hp_lain[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan nomor telepon peserta lain" />
                </div>
                <button id="remove_no_hp" class="bg-red-500 rounded-lg text-white mx-3">
                    <img src="assets/assets/vector/close-square.svg" alt="">
                </button>
            </div>
            <small id="status[]"></small>
        </label>
        </div>`);
    addJumlahView();
    biaya();
    potongan();
    total();
    var jumlahPendaftar = document.querySelectorAll("#no_hp_lain").length + 1;
    var limit = $("#add_no_hp").val();
    limitAddView(jumlahPendaftar, limit);
  });

  $(document).on("click", "#remove_no_hp", function (e) {
    e.preventDefault();
    minJumlahView();
    biaya();
    potongan();
    total();

    let listNoLain = $(this).parent().parent();
    $(listNoLain).remove();

    var jumlahPendaftar = document.querySelectorAll("#no_hp_lain").length + 1;
    var limit = $("#add_no_hp").val();
    console.log(jumlahPendaftar);
    console.log(limit);
    limitAddView(jumlahPendaftar, limit);
  });

  // function aja

  function limitAddView(pendaftar, limit) {
    if (pendaftar >= limit) {
      $("#add_no_hp").addClass("hidden");
    } else {
      $("#add_no_hp").removeClass("hidden");
    }
  }

  function addJumlahView() {
    var jumlahBeli = parseInt($("#jumlahBeli").text());
    jumlahBeli++;
    $("#jumlahBeli").text(jumlahBeli);
  }

  function minJumlahView() {
    var jumlahBeli = parseInt($("#jumlahBeli").text());
    jumlahBeli--;
    $("#jumlahBeli").text(jumlahBeli);
  }

  function biaya() {
    const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(number);
    };
    var harga = $("#hdnBiaya").val();
    var jumlahBeli = parseInt($("#jumlahBeli").text());
    var totalKali = jumlahBeli * harga;
    $("#biaya").text(rupiah(parseInt(totalKali)));
  }

  function potongan() {
    const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(number);
    };
    var ph = $("#hdnDiskon").val();
    var jumlahBeli = parseInt($("#jumlahBeli").text());
    var potonganKali = jumlahBeli * ph;
    $("#potongan").text(rupiah(parseInt(potonganKali)));
  }

  function total() {
    const rupiah = (number) => {
      return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
      }).format(number);
    };
    var jumlah = $("#biaya").text();
    var jmlh = parseInt(jumlah.replace(/Rp|,00|\./g, ""));
    var potongan = $("#potongan").text();
    var ptgn = parseInt(potongan.replace(/Rp|,00|\./g, ""));
    var totalAll = jmlh - ptgn;
    $("#total").text(rupiah(parseInt(totalAll)));
  }

  $("#nama").keypress(function (e) {
    if (e.which === 32 && !this.value.length) {
      e.preventDefault();
      Swal.fire({
        // position: 'top-end',
        icon: "error",
        text: "Tidak dapat menggunakan spasi diawal nama",
        showConfirmButton: true,
      });
    }
    var inputValue = event.charCode;
    if (
      !(inputValue >= 65 && inputValue <= 122) &&
      inputValue != 32 &&
      inputValue != 0
    ) {
      e.preventDefault();
      Swal.fire({
        // position: 'top-end',
        icon: "error",
        text: "Hanya dapat memasukkan huruf",
        showConfirmButton: true,
      });
    }
  });
  $("#alamat").keypress(function (e) {
    if (e.which === 32 && !this.value.length) {
      e.preventDefault();
      Swal.fire({
        // position: 'top-end',
        icon: "error",
        text: "Tidak dapat menggunakan spasi diawal",
        showConfirmButton: true,
      });
    }
  });
  $("#tempat_lahir").keypress(function (e) {
    if (e.which === 32 && !this.value.length) {
      e.preventDefault();
      Swal.fire({
        // position: 'top-end',
        icon: "error",
        text: "Tidak dapat menggunakan spasi diawal",
        showConfirmButton: true,
      });
    }
  });
  $("#instansi").keypress(function (e) {
    if (e.which === 32 && !this.value.length) {
      e.preventDefault();
      Swal.fire({
        // position: 'top-end',
        icon: "error",
        text: "Tidak dapat menggunakan spasi diawal nama",
        showConfirmButton: true,
      });
    }
  });

  function validasi() {
    if ($("#email").val() == "") {
      $("#email").focus();
      return "Email tidak boleh kosong";
    }
    if ($("#email").val() != "" && IsEmail($("#email").val()) == false) {
      $("#email").focus();
      return "Email tidak valid";
    }
    if ($("#email").val().length > 100) {
      $("#email").focus();
      return "Jumlah karakter maksimal 100 karakter";
    }
    if ($("#nama").val() == "") {
      $("#nama").focus();
      return "Nama tidak boleh kosong";
    }
    if ($("#nama").val().length > 100 || $("#nama").val().length < 3) {
      $("#nama").focus();
      return "Jumlah karakter maksimal 100 karakter dan minimal 3 karakter";
    }

    if ($("#no_hp").val() == "") {
      $("#no_hp").focus();
      return "Nomor telepon anda tidak boleh kosong";
    }

    if ($("#no_hp").val().length > 13) {
      $("#no_hp").focus();
      return "Nomor telepon anda lebih dari 13 angka";
    }
    if ($("#no_hp").val().length < 10) {
      $("#no_hp").focus();
      return "Nomor telepon anda kurang dari 10 angka";
    }
    if ($("#no_hp").val().charAt(0) == 0) {
      $("#no_hp").focus();
      return "Nomor telepon anda tidak boleh diawali dengan angka 0";
    }
    if ($("#instansi").val() == "") {
      $("#instansi").focus();
      return "Instansi tidak boleh kosong";
    }
    if ($("#instansi").val().length > 100) {
      $("#instansi").focus();
      return "Jumlah karakter maksimal 100 karakter ";
    }

    if ($("#alamat").val() == "") {
      $("#alamat").focus();
      return "Alamat tidak boleh kosong";
    }

    if ($("#alamat").val().length > 255) {
      $("#alamat").focus();
      return "Jumlah karakter maksimal 255 karakter ";
    }

    if (
      $("#kec_id").val() == "" ||
      $("#kab_id").val() == "" ||
      $("#prov_id").val() == ""
    ) {
      if ($("#prov_id").val() == "") {
        $("#prov_id").focus();
      } else if ($("#kab_id").val() == "") {
        $("#kab_id").focus();
      } else if ($("#kec_id").val() == "") {
        $("#kec_id").focus();
      }
      return "Lengkapi provinsi, kabupaten/ kota, dan kecamatan domisili anda";
    }

    if (!$("#lk").prop("checked") && !$("#pr").prop("checked")) {
      return "Jenis kelamin belum dipilih";
    }

    if ($("#tempat_lahir").val() == "") {
      $("#tempat_lahir").focus();
      return "Tempat lahir tidak boleh kosong";
    }
    if ($("#tempat_lahir").val().length > 255) {
      $("#tempat_lahir").focus();
      return "Jumlah karakter maksimal 255 karakter ";
    }
    if (!$("#tgl_lahir").val()) {
      $("#tgl_lahir").focus();
      return "Tanggal lahir tidak boleh kosong";
    }
    if (new Date($("#tgl_lahir").val()).getMilliseconds() > Date.now()) {
      $("#tgl_lahir").focus();
      return "Tanggal lahir tidak melebihi hari ini";
    }
    if ($("#pendidikan_id").val() == "") {
      $("#pendidikan_id").focus();
      return "Pendidikan tidak boleh kosong";
    }
    if ($("#pekerjaan_id").val() == "") {
      $("#pekerjaan_id").focus();
      return "Pekerjaan tidak boleh kosong";
    }
    var peringatan = [];
    $("[id^=no_hp_lain]").each(function () {
      if (/\D/g.test(this.value)) {
        // Filter non-digits from input value.
        peringatan.push("Nomor telepon hanya dapat diisi menggunakan nomor");
        // this.value = this.value.replace(/\D/g, "");
        return false;
      }

      if ($(this).val() == "") {
        peringatan.push("Nomor telepon peserta lain tidak boleh kosong");
        return false;
      }

      if ($(this).val().length > 13) {
        peringatan.push("Nomor telepon peserta lain lebih dari 13 angka");
        return false;
      }

      if ($(this).val().length < 10) {
        peringatan.push("Nomor telepon peserta lain kurang dari 10 angka");
        return false;
      }
      if ($(this).val().charAt(0) == 0) {
        peringatan.push(
          "Nomor telepon peserta lain tidak boleh diawali dengan angka 0"
        );
        return false;
      }
    });

    var arr = [$("#no_hp").val()];
    $("[id^=no_hp_lain]").each(function () {
      var value = $(this).val();
      if (arr.indexOf(value) == -1) {
        if (value != "") {
          arr.push(value);
        }
        $(this).removeClass("errorInput");
      } else {
        if ($("#no_hp").val() != "") {
          $(this).addClass("errorInput");
          peringatan.push("Terdapat nomor telepon yang sama");
        }
      }
    });

    return removeDuplicates(peringatan).toString();
  }

  function removeDuplicates(arr) {
    return arr.filter((item, index) => arr.indexOf(item) === index);
  }

  function notifikasi() {
    Swal.fire({
      // position: 'top-end',
      icon: "error",
      text: validasi(),
      showConfirmButton: true,
    });
  }

  function IsEmail(email) {
    var regex =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if (regex.test(email)) {
      return true;
    } else {
      return false;
    }
  }
});
