$(document).off("click", ".terima");
$(document).on("click", ".terima", function () {
  $("#linkBuktiBayar").removeClass("d-none");
  $("#formTerima")[0].reset();
  var id = $(this).attr("id");
  $.ajax({
    url: "pembayaran/getDetailOrder",
    method: "post",
    data: {
      id: id,
    },
    dataType: "JSON",
    success: function (data) {
      if (data.success == true) {
        var dataData = data.data;
        if (dataData.status_code == "200") {
          $("#linkBuktiBayar").removeClass("d-none");
        } else {
          $("#linkBuktiBayar").addClass("d-none");
        }
        $("#terimaModal").modal("show");
        $("#" + dataData.status_code).prop("checked", true);
        // $('input[name=type][value=200]').attr('checked', 'checked');
        // $("input[name='status']:checked").val(dataData.status_code);
        $("#bukti").val(dataData.bukti);
        $("#i").val(dataData.id_order);
      } else {
        Swal.fire({
          // position: 'top-end',
          icon: "info",
          title: data.message,
          text: "Data akan diubah otomatis oleh Midtrans",
          showConfirmButton: false,
          timer: 3000,
        });
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
});

$(document).off("click", ".hapusByr");
$(document).on("click", ".hapusByr", function () {
  var id = $(this).attr("id");
  console.log(id);
  if (id === undefined) {
    Swal.fire({
      icon: "error",
      title: "Gagal Hapus",
      text: "Tidak dapat hapus, bukan pendaftaran Midtrans",
      showConfirmButton: false,
      timer: 3000,
    });
  } else if (id === "none") {
    Swal.fire({
      icon: "error",
      title: "Gagal Hapus",
      text: "Tidak dapat hapus, pendaftaran ini belum 1 hari",
      showConfirmButton: false,
      timer: 3000,
    });
  } else {
    Swal.fire({
      title: "Data akan dihapus",
      text: "Apakah anda yakin?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Hapus!",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.isConfirmed) {
          $.ajax({
            type: "POST",
            url: "pembayaran/deleteOrder",
            data: {
              id: id,
            },
            dataType: "JSON",
            success: function (response) {
              if (response.success == null) {
                Swal.fire({
                  // position: 'top-end',
                  icon: "info",
                  title: response.message,
                  // text: 'Data akan diubah otomatis oleh Midtrans',
                  showConfirmButton: false,
                  timer: 3000,
                });
              } else if (response.success) {
                $("#listBayar").DataTable().ajax.reload();
                Swal.fire({
                  // position: 'top-end',
                  icon: "success",
                  title: response.message,
                  // text: 'Data akan diubah otomatis oleh Midtrans',
                  showConfirmButton: false,
                  timer: 3000,
                });
              } else if (response.success === false) {
                Swal.fire({
                  // position: 'top-end',
                  icon: "error",
                  title: response.message,
                  text: response.text,
                  showConfirmButton: false,
                  timer: 3000,
                });
              }
            },
          });
        }
      }
    });
  }
});

$("#sc").off("click");
$("#sc").click(function (e) {
  e.preventDefault();

  var data = $("#formTerima").serialize();

  $.ajax({
    type: "post",
    url: "pembayaran/putOrder",
    data: data,
    dataType: "json",
    success: function (data) {
      if (data.success == true) {
        $("#listBayar").DataTable().ajax.reload();
        // location.reload();
        $("#terimaModal").modal("hide");
        Swal.fire({
          // position: 'top-end',
          icon: "success",
          title: data.message,
          showConfirmButton: false,
          timer: 3000,
        });
      } else {
        Swal.fire({
          // position: 'top-end',
          icon: data.icon,
          text: data.message,
          showConfirmButton: false,
          timer: 3000,
        });
      }
    },
    error: function (data) {
      console.log(data);
    },
  });
});

$("#delBayar").off("click");
$("#delBayar").click(function (e) {
  e.preventDefault();
  Swal.fire({
    title: "Data akan dihapus",
    text: "Apakah anda yakin?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Hapus!",
    cancelButtonText: "Batal",
  }).then((result) => {
    if (result.isConfirmed) {
      if (result.isConfirmed) {
        $.ajax({
          type: "GET",
          url: "pembayaran/deleteOrder",
          dataType: "JSON",
          success: function (response) {
            if (response.success == null) {
              Swal.fire({
                // position: 'top-end',
                icon: "info",
                title: response.message,
                // text: 'Data akan diubah otomatis oleh Midtrans',
                showConfirmButton: false,
                timer: 3000,
              });
            } else if (response.success) {
              $("#listBayar").DataTable().ajax.reload();
              Swal.fire({
                // position: 'top-end',
                icon: "success",
                title: response.message,
                // text: 'Data akan diubah otomatis oleh Midtrans',
                showConfirmButton: false,
                timer: 3000,
              });
            }
          },
        });
      }
    }
  });
});

$(document).on("click", ".noView", function (e) {
  e.preventDefault();
  Swal.fire({
    icon: "error",
    title: "Gagal Tampil",
    text: "Tidak dapat menampilkan kwitansi, pembayaran belum terverifikasi",
    showConfirmButton: false,
    timer: 3000,
  });
});

$('input:radio[name="status_code"]').change(function () {
  // checks that the clicked radio button is the one of value 'Yes'
  // the value of the element is the one that's checked (as noted by @shef in comments)
  if ($(this).val() == "200") {
    $("#linkBuktiBayar").removeClass("d-none");
    // $("#linkBuktiBayar").fadeIn();
  } else {
    // $("#linkBuktiBayar").fadeOut();
    $("#linkBuktiBayar").addClass("d-none");
    $("#bukti").val("");
  }
});
