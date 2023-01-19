$(document).ready(function () {
  function validasi() {
    var peringatan = [];
    $("[id^=materiKategori]").each(function () {
      if ($(this).val() == "") {
        peringatan.push("kolom tidak boleh kosong");
        $(this).focus();
        return false;
      }

      if ($(this).val().length < 5) {
        peringatan.push("List materi setidaknya terdapat 5 karakter");
        $(this).focus();
        return false;
      }

      if ($(this).val().length > 255) {
        peringatan.push("List materi paling banyak 255 karakter");
        $(this).focus();
        return false;
      }

      if ($(this).val().trim().length == 0) {
        peringatan.push("Tidak dapat memasukkan materi hanya dengan spasi");
        $(this).focus();
        return false;
      }
    });

    var arr = [];
    $("[id^=materiKategori]").each(function () {
      var value = $(this).val();
      if (arr.indexOf(value) == -1) {
        if (value != "") {
          arr.push(value);
        }
        $(this).removeClass("errorInput");
      } else {
        $(this).addClass("errorInput");
        peringatan.push("Terdapat konten materi yang sama");
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

  $(".pilKat").click(function (e) {
    e.preventDefault();
    $(".pilKat").removeClass(["btn-primary"]);
    $(this).addClass(["btn-primary"]);

    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "kategori/getKategori",
      data: {
        id: id,
      },
      dataType: "JSON",
      success: function (response) {
        var data = response.result;
        $("#jdlList").text(`Konten Materi ${data.nama_kategori}`);
        var content = "";
        var katMateri = data.materi;
        if (katMateri == null) {
          katMateri = "";
        }
        arr = katMateri.split("#~#");
        // console.log();
        $.each(arr, function (key, value) {
          content += `<div class="row "><div class="col">
                                    <input type="text" class="form-control w-100" id="materiKategori" name="materi[]" placeholder="" value="${value}">
                                </div>
                                <div class="col-auto">
                                    <button type="button" id="remove_materi" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
                                </div></div>`;
        });
        content += `<div id="ac_materi" class="d-flex justify-content-between mt-3">
                <button id="add_materi" type="button" class="btn btn-success">
                                     Tambah Materi
                                 </button>
                                 <button id="save_materi" value="${data.id_kategori}" type="button" class="btn btn-primary">
                                     Simpan Materi
                                 </button>
                                 
                            </div>`;
        $("#listMateri").html(content);
      },
    });
  });
  $("#add_materi").off("click");
  $(document).on("click", "#add_materi", function (e) {
    e.preventDefault();

    $("#ac_materi").before(`<div class="row "><div class="col">
            <input type="text" class="form-control w-100" id="materiKategori" name="materi[]" placeholder="" value="">
          </div>
          <div class="col-auto">
            <button type="button" id="remove_materi" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
          </div></div>`);
  });

  $(document).on("click", "#remove_materi", function (e) {
    e.preventDefault();
    let listNoLain = $(this).parent().parent();
    $(listNoLain).remove();
  });

  $("#save_materi").off("click");
  $(document).on("click", "#save_materi", function (e) {
    e.preventDefault();

    if (validasi() != []) {
      notifikasi();
      return;
    }
    var data = $("#listMateri").serializeArray();
    var id = $(this).val();
    $.ajax({
      type: "POST",
      url: "kategori/putMateriKat",
      data: {
        data,
        id,
      },
      dataType: "JSON",
      success: function (data) {
        // console.log(data);
        Swal.fire({
          // position: 'top-end',
          icon: data.icon,
          title: data.message,
          showConfirmButton: false,
          timer: 2000,
        });
      },
    });
  });
});
