$(document).ready(function () {
	table2 = $("#purchaseTable").DataTable({
		responsive: true,
		ajax: "purchase/getPurchase",
		columns: [
			{
				data: "no",
			},
			{
				data: "judul",
			},
			{
				data: "publish_at",
			},
			{
				data: "terjual",
			},
			{
				data: "action",
			},
		],
	});

	$(document).on("click", ".showGraph", function () {
		Swal.fire({
			icon: "info",
			title: "Mohon maaf",
			text: "Fitur tampilan grafik masih dalam pengembangan",
			showConfirmButton: true,
		});
	});
});
