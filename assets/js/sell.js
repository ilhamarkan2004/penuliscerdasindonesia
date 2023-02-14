$(document).ready(function () {
	table2 = $("#sellTable").DataTable({
		responsive: true,
		ajax: `sell/getAllSell`,
		columns: [
			{
				data: "no",
			},
			{
				data: "title",
			},
			{
				data: "publisher",
			},
			{
				data: "price",
			},
			{
				data: "publish_at",
			},
			{
				data: "update_at",
			},
			{
				data: "action",
			},
		],
	});

	$(document).off("click", "#addSell");
	$(document).on("click", "#addSell", function () {
		$("#book_err").text("");
		$("#category_err").text("");
		$("#lang_err").text("");
		$("#pub_err").text("");
		$("#num_page_err").text("");
		$("#price_err").text("");
		$("#formSell")[0].reset();

		$("#jdlModelSell").text("Tambah Buku Dijual");
		$(".aksiSell").text("Tambah");

		$("#SellModal").modal("show");
	});

	$(document).off("click", ".edtSell");
	$(document).on("click", ".edtSell", function () {
		$("#formSell")[0].reset();
		var id = $(this).attr("id");
		$.ajax({
			type: "post",
			url: "sell/detailSell",
			data: {
				id: id,
			},
			dataType: "JSON",
			success: function (data) {
				$("#jdlModelSell").text("Ubah Buku Dijual");
				$(".aksiSell").text("Ubah");
				var response = data.message;
				$("#iS").val(response.id_bs);
				$("#book").val(response.id_b);
				$("#category").val(response.category_id);
				$("#lang").val(response.language_id);
				$("#pub").val(response.publisher_id);
				$("#num_page").val(response.num_page);
				$("#price").val(response.sell_price);

				$("#SellModal").modal("show");
			},
		});
	});

	$(document).off("click", ".aksiSell");
	$(document).on("click", ".aksiSell", function (e) {
		e.preventDefault();
		$("#book_err").text("");
		$("#category_err").text("");
		$("#lang_err").text("");
		$("#pub_err").text("");
		$("#num_page_err").text("");
		$("#price_err").text("");
		var data = $("#formSell").serialize();
		// console.log(data);
		$.ajax({
			type: "POST",
			url: "sell/aksiSell",
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
					$("#sellTable").DataTable().ajax.reload();
					$("#SellModal").modal("hide");
				} else {
					var error = response.message;
					$.each(error, function (key, value) {
						$(`#${key}`).text(`${value}`);
					});
				}
			},
		});
	});

	$(document).off("click", ".delSell");
	$(document).on("click", ".delSell", function () {
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
						url: "sell/deleteSell",
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
								$("#sellTable").DataTable().ajax.reload();
							}
						},
					});
				}
			}
		});
	});
});
