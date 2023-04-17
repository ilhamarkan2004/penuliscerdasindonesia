function resetError() {
	$("#name_err").text("");
	$("#type_err").text("");
	$("#start_err").text("");
	$("#end_err").text("");
	$("#status_err").text("");
	$("#link_err").text("");
	$("#desc_err").text("");
	$("#img_err").text("");
}

$(document).ready(function () {
	table = $("#eventTable").DataTable({
		responsive: true,
		ajax: "event/getEvent",
		columns: [
			{
				data: "no",
			},
			{
				data: "event_type",
			},
			{
				data: "event_name",
			},
			{
				data: "desc",
			},
			{
				data: "date",
			},
			{
				data: "is_active",
			},
			{
				data: "action",
			},
		],
	});

	$(document).off("click", "#addEvent");
	$(document).on("click", "#addEvent", function () {
		resetError();

		$("#jdlModelEvent").text("Tambah Acara Baru");
		$(".aksiEvent").text("Tambah");
		$("#iE").val("");
		$("#EventModal").modal("show");
		$("#formEvent")[0].reset();
	});

	$(document).off("click", ".edtEvent");
	$(document).on("click", ".edtEvent", function () {
		resetError();
		$("#formEvent")[0].reset();
		var id = $(this).attr("id");
		$.ajax({
			type: "post",
			url: "event/detailEvent",
			data: {
				id: id,
			},
			dataType: "JSON",
			success: function (data) {
				$("#jdlModelEvent").text("Ubah Acara");
				$(".aksiEvent").text("Ubah");
				var response = data.message;
				$("#iE").val(response.e_id);
				$("#event_type").val(response.event_type_id);
				$("#event_name").val(response.event_name);
				$("#start_regist").val(response.start_regist);
				$("#end_regist").val(response.end_regist);
				$("#status").val(response.status);
				$("#link").val(response.link);
				$("#desc").val(response.e_desc);

				$("#EventModal").modal("show");
			},
		});
	});

	$("#formEvent").submit(function (e) {
		e.preventDefault();
		resetError();
		$.ajax({
			url: "event/aksiEvent",
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
						showConfirmButton: false,
						timer: 2000,
					});
					$("#EventModal").modal("hide");
					$("#eventTable").DataTable().ajax.reload();
				} else {
					$("#name_err").text(response.message.name_err);
					$("#type_err").text(response.message.type_err);
					$("#start_err").text(response.message.start_err);
					$("#end_err").text(response.message.end_err);
					$("#status_err").text(response.message.status_err);
					$("#link_err").text(response.message.link_err);
					$("#desc_err").text(response.message.desc_err);
					$("#img_err").text(response.message.img_err);
				}
			},
		});
	});

	$(document).off("click", ".delEvent");
	$(document).on("click", ".delEvent", function () {
		Swal.fire({
			title: "Data akan dihapus",
			text: "Apakah anda yakin?",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#d33",
			cancelButtonColor: "#3085d6",
			confirmButtonText: "Hapus!",
			cancelButtonText: "Batal",
		}).then((result) => {
			if (result.isConfirmed) {
				if (result.isConfirmed) {
					var data = $(this).attr("id");
					$.ajax({
						type: "POST",
						data: {
							id: data,
						},
						url: "event/deleteEvent",
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
								$("#eventTable").DataTable().ajax.reload();
							}
						},
					});
				}
			}
		});
	});
});
