$(document).ready(function () {
	$("#butuh_desain1").click(function (e) {
		e.preventDefault();
		$("#bikinDesign").fadeOut();
		$("#uploadCover").fadeIn();
		$(this).removeClass("bg-green-300");
		$(this).addClass("bg-green-500");
		$("#butuh_desain2").removeClass("bg-red-500");
		$("#butuh_desain2").addClass("bg-red-300");
		$("#is_cover").val("0");
	});
	$("#butuh_desain2").click(function (e) {
		e.preventDefault();
		$("#bikinDesign").fadeIn();
		$("#uploadCover").fadeIn();
		$(this).removeClass("bg-red-300");
		$(this).addClass("bg-red-500");
		$("#butuh_desain1").removeClass("bg-green-500");
		$("#butuh_desain1").addClass("bg-green-300");
		$("#is_cover").val("1");
	});
});

$(document).ready(function () {
	$("#butuh_kdt1").click(function (e) {
		e.preventDefault();
		$(this).removeClass("bg-green-300");
		$(this).addClass("bg-green-500");
		$("#butuh_kdt2").removeClass("bg-red-500");
		$("#butuh_kdt2").addClass("bg-red-300");
		$("#is_kdt").val("1");
	});
	$("#butuh_kdt2").click(function (e) {
		e.preventDefault();
		$(this).removeClass("bg-red-300");
		$(this).addClass("bg-red-500");
		$("#butuh_kdt1").removeClass("bg-green-500");
		$("#butuh_kdt1").addClass("bg-green-300");
		$("#is_kdt").val("0");
	});
});

$(document).ready(function () {
	function IsEmail(email) {
		var regex =
			/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (regex.test(email)) {
			return true;
		} else {
			return false;
		}
	}

	$("#title").keypress(function (e) {
		var inputValue = event.charCode;
		if (e.which === 32 && !this.value.length) {
			e.preventDefault();
			$("#judulErr").text("Tidak dapat menggunakan spasi diawal judul");
		} else {
			$("#judulErr").text("");
		}
	});

	$("#desc").keypress(function (e) {
		if (e.which === 32 && !this.value.length) {
			e.preventDefault();
			$("#descErr").text("Tidak dapat menggunakan spasi diawal deskripsi");
		} else {
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

	$("#jk").off("click");
	$(document).on("click", "#jk", function (e) {
		e.preventDefault();
		var id = $(this).val();

		$("#id_jk").val(id);
		var harga_paket = document.querySelectorAll("#jk");
		// $(this).removeClass("bg-secondary-100");
		for (const hp of harga_paket) {
			hp.classList.remove("bg-green-500");
		}
		$(this).addClass("bg-green-500");
		for (const hp of harga_paket) {
			hp.classList.add("bg-green-300");
		}
		$(this).removeClass("bg-green-300");
	});

	$("#kertas").off("click");
	$(document).on("click", "#kertas", function (e) {
		e.preventDefault();
		var id = $(this).val();

		$("#id_kertas").val(id);
		var harga_paket = document.querySelectorAll("#kertas");
		// $(this).removeClass("bg-secondary-100");
		for (const hp of harga_paket) {
			hp.classList.remove("bg-green-500");
		}
		$(this).addClass("bg-green-500");
		for (const hp of harga_paket) {
			hp.classList.add("bg-green-300");
		}
		$(this).removeClass("bg-green-300");
	});

	$("#harga_paket").off("click");
	$(document).on("click", "#harga_paket", function (e) {
		e.preventDefault();
		var id = $(this).val();
		const rupiah = (number) => {
			return new Intl.NumberFormat("id-ID", {
				style: "currency",
				currency: "IDR",
			}).format(number);
		};
		$.ajax({
			type: "post",
			url: "pci/getHargaPaket",
			data: {
				id: id,
			},
			dataType: "json",
			success: function (response) {
				$("#biaya").text(rupiah(parseInt(response.harga)));
				$("#ukuran").text(response.eksemplar);
				total();
				$("#id_paket_harga").val(id);
			},
		});
		var harga_paket = document.querySelectorAll("#harga_paket");
		// $(this).removeClass("bg-secondary-100");
		for (const hp of harga_paket) {
			hp.classList.remove("bg-green-500");
		}
		$(this).addClass("bg-green-500");
		for (const hp of harga_paket) {
			hp.classList.add("bg-green-300");
		}
		$(this).removeClass("bg-green-300");
	});
});
