$(document).ready(function () {
	// var ip = $('#ip').val();
	table2 = $("#paketTable").DataTable({
		responsive: true,
		ajax: `paket/getPaket`,
		columns: [
			{
				data: "no",
			},
			{
				data: "name",
			},
			// {
			// 	data: "copy_num",
			// },
			{
				data: "is_active",
			},
			{
				data: "service",
			},
			{
				data: "action",
			},
		],
	});

	$(document).off("click", "#addPaket");
	$(document).on("click", "#addPaket", function () {
		$("#errName").text("");
		// $("#errCopy").text("");
		$("#errStatus").text("");
		$("#jdlModelPaket").text("Tambah Paket Baru");
		$(".aksiPaket").text("Tambah");
		$("#iP").val("");
		$("#PaketModal").modal("show");
		$("#formPaket")[0].reset();
	});

	$(document).off("click", ".edtPaket");
	$(document).on("click", ".edtPaket", function () {
		$("#errName").text("");
		// $("#errCopy").text("");
		$("#errStatus").text("");
		$("#formPaket")[0].reset();
		var id = $(this).attr("id");
		$.ajax({
			type: "post",
			url: "paket/detailPaket",
			data: {
				id: id,
			},
			dataType: "JSON",
			success: function (data) {
				$("#jdlModelPaket").text("Ubah Paket");
				$(".aksiPaket").text("Ubah");
				var response = data.message;
				$("#iP").val(response.id);
				$("#name").val(response.paket_name);
				// $("#copy").val(response.copy_num);
				$("#status").val(response.is_active);
				$("#PaketModal").modal("show");
			},
		});
	});

	$(document).off("click", ".fasilitas");
	$(document).on("click", ".fasilitas", function () {
		var id = $(this).attr("id");
		$.ajax({
			type: "post",
			url: "paket/detailPaket",
			data: {
				id: id,
			},
			dataType: "JSON",
			success: function (response) {
				var data = response.message;
				// $("#jdlList").text(`Konten Materi ${data.nama_kategori}`);
				var content = "";
				var fasilitas = data.service;
				if (fasilitas == null) {
					fasilitas = "";
				}
				arr = JSON.parse(fasilitas);
				console.log(arr);
				$.each(arr, function (key, value) {
					content += `<div class="row "><div class="col">
                                    <input type="text" class="form-control w-100" id="fasilitas" name="fasilitas[]" placeholder="" value="${value.fasilitas}">
                                </div>
                                <div class="col-auto">
                                    <button type="button" id="remove_fasilitas" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
                                </div></div>`;
				});
				content += `<div id="ac_fasilitas" class="d-flex justify-content-between mt-3">
                <button id="add_fasilitas" type="button" class="btn btn-success">
                                     Tambah Fasilitas
                                 </button>
                                 <button id="save_fasilitas" value="${data.id}" type="button" class="btn btn-primary">
                                     Simpan
                                 </button>
                                 
                            </div>`;
				$("#listFasilitas").html(content);
				$("#FasilitasModal").modal("show");
			},
		});
	});

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

	$("#add_fasilitas").off("click");
	$(document).on("click", "#add_fasilitas", function (e) {
		e.preventDefault();

		$("#ac_fasilitas").before(`<div class="row "><div class="col">
            <input type="text" class="form-control w-100" id="materiKategori" name="fasilitas[]" placeholder="" value="">
          </div>
          <div class="col-auto">
            <button type="button" id="remove_fasilitas" class="btn btn-danger"><i class="fa-solid fa-xmark fs-6"></i></button>
          </div></div>`);
	});

	$(document).on("click", "#remove_fasilitas", function (e) {
		e.preventDefault();
		let listNoLain = $(this).parent().parent();
		$(listNoLain).remove();
	});

	$("#save_fasilitas").off("click");
	$(document).on("click", "#save_fasilitas", function () {
		// e.preventDefault();
		if (validasi() != []) {
			notifikasi();
			return;
		}
		var data = $("#listFasilitas").serializeArray();
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: "paket/putService",
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
				$("#FasilitasModal").modal("hide");
			},
		});
	});

	$(document).off("click", ".aksiPaket");
	$(document).on("click", ".aksiPaket", function () {
		$("#errName").text("");
		// $("#errCopy").text("");
		$("#errStatus").text("");

		var data = $("#formPaket").serialize();
		// console.log(data);
		$.ajax({
			type: "POST",
			url: "paket/aksiPaket",
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
					$("#paketTable").DataTable().ajax.reload();
					$("#PaketModal").modal("hide");
				} else {
					var error = response.message;
					// console.log(error.kurikulum);
					$("#errName").text(error.name_error);
					// $("#errCopy").text(error.copy_error);
				}
			},
		});
	});

	$(document).off("click", ".delPaket");
	$(document).on("click", ".delPaket", function () {
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
						url: "paket/deletePaket",
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
								$("#paketTable").DataTable().ajax.reload();
							} else {
								Swal.fire({
									// position: 'top-end',
									icon: "error",
									text: response.message,
									showConfirmButton: false,
									timer: 2000,
								});
							}
						},
					});
				}
			}
		});
	});
});
