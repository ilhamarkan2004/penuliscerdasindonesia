$(document).ready(function () {
  changeText();

  $(document).off("click", ".tambahMateri");
  $(document).on("click", ".tambahMateri", function () {
    changeText();
    $("#modalLabel").text("Tambah Materi");
    $("#addEditMateri").text("Tambahkan");
    $("#errJudul").text("");
    $("#errKat").text("");
    $("#errTipe").text("");
    $("#errLink").text("");
    $("#i").val("");
    $("#materiModal").modal("show");
    $("#formMateri")[0].reset();
  });

  $(document).off("click", ".dltMateri");
  $(document).on("click", ".dltMateri", function () {
    // $('#status1').prop('checked', false);
    // $("input[name=bukti]").html("");
    var id = $(this).attr("id");
    $.ajax({
      url: "materi/getDetailMateri",
      method: "post",
      data: {
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        if (data.success == true) {
          var dataData = data.data;

          $("#is").val(dataData.id_materi);
          // $('#modalLabelHapus').text('Hapus Materi');
          $("#deleteMateri").text("Hapus");
          $("#dltMateriModal").modal("show");
          $("#judul").val(dataData.judul);
          $("#pesan").html(
            `<p class="p-3 text-black">Apakah anda yakin akan menghapus materi dengan judul "<b>${dataData.judul}</b>" ?</p>`
          );
        } else {
          // Swal.fire({
          //     // position: 'top-end',
          //     icon: "info",
          //     title: data.message,
          //     text: 'Data akan diubah otomatis oleh Midtrans',
          //     showConfirmButton: false,
          //     timer: 3000,
          // });
        }
      },
      error: function (data) {
        console.log(data);
      },
    });
  });

  $(document).off("click", ".edtMateri");
  $(document).on("click", ".edtMateri", function () {
    // $('#status1').prop('checked', false);
    // $("input[name=bukti]").html("");
    $("#errJudul").text("");
    $("#errKat").text("");
    $("#errTipe").text("");
    $("#errLink").text("");
    var id = $(this).attr("id");
    $.ajax({
      url: "materi/getDetailMateri",
      method: "post",
      data: {
        id: id,
      },
      dataType: "JSON",
      success: function (data) {
        if (data.success == true) {
          var dataData = data.data;

          $("#i").val(dataData.id_materi);
          $("#modalLabel").text("Edit Materi");
          changeText();
          $("#materiModal").modal("show");
          $("#judul").val(dataData.judul);
          $("#kategori").val(dataData.id_kategori);
          $("#tipe").val(dataData.id_tipe_file);
          $("#link").val(dataData.link_materi);
        }
      },
      error: function (data) {
        console.log(data);
      },
    });
  });

  $(document).off("click", "#addEditMateri");
  $("#addEditMateri").click(function (e) {
    e.preventDefault();
    $("#errJudul").text("");
    $("#errKat").text("");
    $("#errTipe").text("");
    $("#errLink").text("");

    var data = $("#formMateri").serialize();
    if ($("#i").val() == "") {
      $.ajax({
        type: "POST",
        url: "materi/postMateri",
        data: data,
        dataType: "json",
        success: function (data) {
          if (data.success) {
            $("#listMateri").DataTable().ajax.reload();
            // location.reload();
            $("#materiModal").modal("hide");
            $("#errJudul").text("");
            $("#errKat").text("");
            $("#errTipe").text("");
            $("#errLink").text("");
            Swal.fire({
              // position: 'top-end',
              icon: "success",
              title: data.message,
              // text: '',
              showConfirmButton: false,
              timer: 3000,
            });
          } else {
            var message = data.message;
            $("#errJudul").text(message.judul);
            $("#errKat").text(message.kategori);
            $("#errTipe").text(message.tipe);
            $("#errLink").text(message.link);
          }
        },
      });
    } else {
      $("#addEditMateri").text("Ubah");
      $.ajax({
        type: "POST",
        url: "materi/putMateri",
        data: data,
        dataType: "json",
        success: function (data) {
          if (data.success) {
            $("#listMateri").DataTable().ajax.reload();
            // location.reload();
            $("#materiModal").modal("hide");
            $("#errJudul").text("");
            $("#errKat").text("");
            $("#errTipe").text("");
            $("#errLink").text("");
            Swal.fire({
              // position: 'top-end',
              icon: "success",
              title: data.message,
              // text: '',
              showConfirmButton: false,
              timer: 3000,
            });
          } else {
            var message = data.message;
            $("#errJudul").text(message.judul);
            $("#errKat").text(message.kategori);
            $("#errTipe").text(message.tipe);
            $("#errLink").text(message.link);
          }
        },
      });
    }
  });

  $("#deleteMateri").click(function (e) {
    e.preventDefault();
    var data = $("#formMateriHapus").serialize();
    console.log(data);
    $.ajax({
      type: "POST",
      url: "materi/deleteMateri",
      data: data,
      dataType: "JSON",
      success: function (data) {
        if (data.success) {
          $("#listMateri").DataTable().ajax.reload();
          // location.reload();
          $("#dltMateriModal").modal("hide");
          Swal.fire({
            // position: 'top-end',
            icon: "success",
            title: data.message,
            // text: '',
            showConfirmButton: false,
            timer: 3000,
          });
        } else {
          Swal.fire({
            // position: 'top-end',
            icon: "error",
            title: data.message,
            // text: '',
            showConfirmButton: false,
            timer: 3000,
          });
        }
      },
    });
  });
});

function changeText() {
  if ($("#i").val() == "") {
    $("#addEditMateri").text("Tambahkan");
  } else {
    $("#addEditMateri").text("Ubah");
  }
}
