$("#edtProfile").off("click");
$(document).on("click", "#edtProfile", function (e) {
	e.preventDefault();

	$("#jdlModelProfile").text("Ubah Profil");
	$(".aksiProfile").text("Ubah");
	$("#ProfileModal").modal("show");
});

$(document).off("click", ".aksiPass");
$(document).on("click", ".aksiPass", function () {
	$("#errOldPass").text("");
	$("#errNewPass").text("");
	var data = $("#formPass").serialize();
	$.ajax({
		type: "post",
		url: "dashboard/aksiPass",
		data: data,
		dataType: "JSON",
		success: function (response) {
			if (response.success) {
				Swal.fire({
					// position: 'top-end',
					icon: "success",
					text: response.message,
					showConfirmButton: false,
					timer: 2000,
				});
				$("#PassModal").modal("hide");
			} else {
				$("#errOldPass").text(response.message.oldPass_err);
				$("#errNewPass").text(response.message.newPass_err);
				$("#errVerif").text(response.message.verif_err);
			}
		},
	});
});

$("#edtPassword").off("click");
$(document).on("click", "#edtPassword", function (e) {
	e.preventDefault();
	$("#formPass")[0].reset();

	$("#jdlModelPass").text("Ubah Password");
	$(".aksiPass").text("Ubah");
	$("#PassModal").modal("show");
});

$("#formProfile").submit(function (e) {
	e.preventDefault();
	$("#errName").text("");
	$("#errDesc").text("");
	$("#errTelp").text("");
	$("#errImg").text("");
	$.ajax({
		url: "dashboard/aksiProfile",
		type: "POST",
		data: new FormData(this),
		processData: false,
		contentType: false,
		// cache: false,
		// async: false,
		dataType: "JSON",
		success: function (response) {
			if (response.success) {
				Swal.fire({
					// position: 'top-end',
					icon: "success",
					text: response.message,
					showConfirmButton: true,
				}).then((result) => {
					/* Read more about isConfirmed, isDenied below */
					location.reload();
				});

				$("#ProfileModal").modal("hide");
				$("#profileTable").DataTable().ajax.reload();
			} else {
				$("#errName").text(response.message.name_err);
				$("#errDesc").text(response.message.desc_err);
				$("#errTelp").text(response.message.telp_err);
				$("#errImg").text(response.message.img_err);
			}
		},
	});
});

table = $("#linkTable").DataTable({
	responsive: true,
	ajax: "getISBN",
	columns: [
		{
			data: "no",
		},
		{
			data: "judul",
		},
		{
			data: "link",
		},
	],
});
