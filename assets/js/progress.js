$(document).ready(function () {
	table2 = $("#progressTable").DataTable({
		responsive: true,
		ajax: `progress/getAllBooks`,
		columns: [
			{
				data: "title",
			},
			{
				data: "progress",
			},
			{
				data: "upload_at",
			},
			{
				data: "update_at",
			},
			{
				data: "naskah",
			},
			{
				data: "cover",
			},
			{
				data: "action",
			},
		],
	});

	$(document).off("click", ".edtProgress");
	$(document).on("click", ".edtProgress", function () {
		$("#formProgress")[0].reset();
		var id = $(this).attr("id");
		$.ajax({
			type: "post",
			url: "progress/detailBookAdmin",
			data: {
				id: id,
			},
			dataType: "JSON",
			success: function (data) {
				$("#jdlModelProgress").text("Ubah Progress");
				$(".aksiProgress").text("Ubah");
				var response = data.message;
				$("#iB").val(response.id);
				$("#progress").val(response.progress_id);
				$("#catatan").val(response.catatan);
				$("#" + response.status_progres).prop("checked", true);

				$("#ProgressModal").modal("show");
			},
		});
	});
	$(document).off("click", ".aksiProgress");
	$(document).on("click", ".aksiProgress", function () {
		var data = $("#formProgress").serialize();
		// console.log(data);
		$.ajax({
			type: "POST",
			url: "progress/aksiProgress",
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
					$("#progressTable").DataTable().ajax.reload();
					$("#ProgressModal").modal("hide");
				} else {
					var error = response.message;
					// console.log(error.kurikulum);
					// $("#errName").text(error.name_error);
					// $("#errCopy").text(error.copy_error);
				}
			},
		});
	});

	$("#formProgressCover").submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: "post",
			url: "progress/aksiCover",
			data: new FormData(this),
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.success) {
					Swal.fire({
						// position: 'top-end',
						icon: "success",
						text: response.message,
						showConfirmButton: true,
					});
					$("#ProgressCoverModal").modal("hide");
				} else {
					if (response.message.alert_type == "swal") {
						Swal.fire({
							// position: 'top-end',
							icon: "error",
							text: response.message.message,
							showConfirmButton: true,
						});
					} else if (response.message.alert_type == "classic") {
						var message = response.message;
						console.log(message);
					}
				}
			},
		});
	});

	$("#formProgressNaskah").submit(function (e) {
		e.preventDefault();
		$.ajax({
			type: "post",
			url: "progress/aksiNaskah",
			data: new FormData(this),
			processData: false,
			contentType: false,
			dataType: "json",
			success: function (response) {
				if (response.success) {
					Swal.fire({
						// position: 'top-end',
						icon: "success",
						text: response.message,
						showConfirmButton: true,
					});
					$("#ProgressNaskahModal").modal("hide");
				} else {
					if (response.message.alert_type == "swal") {
						Swal.fire({
							// position: 'top-end',
							icon: "error",
							text: response.message.message,
							showConfirmButton: true,
						});
					} else if (response.message.alert_type == "classic") {
						var message = response.message;
						console.log(message);
					}
				}
			},
		});
	});

	$(document).off("click", ".delBuku");
	$(document).on("click", ".delBuku", function () {
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
						url: "progress/deleteBuku",
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
								$("#progressTable").DataTable().ajax.reload();
							}
						},
					});
				}
			}
		});
	});
});
