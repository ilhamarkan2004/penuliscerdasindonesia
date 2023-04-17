$(document).ready(function () {
	$("#daftar").submit(function (e) {
		e.preventDefault();
		writerValidasi();
		designerValidasi();
		editorValidasi();
		tata_letakValidasi();

		$("#judulErr").text("");
		$("#descErr").text("");
		$("#kertasErr").text("");
		$("#copyErr").text("");
		$("#berkasErr").text("");
		$("#is_coverErr").text("");
		$("#pembacaErr").text("");
		$("#catatCoverErr").text("");
		$("#uploadCoverErr").text("");
		$("#alamatErr").text("");
		$("#is_kdtErr").text("");
		$("#typeErr").text("");
		$.ajax({
			xhr: function () {
				var xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function (evt) {
						if (evt.lengthComputable) {
							var percentComplete = parseInt((evt.loaded / evt.total) * 100);
							$("#progress-bar").width(percentComplete + "%");
							$("#progress-bar").html(percentComplete + "%");
						}
					},
					false
				);
				return xhr;
			},
			url: "pci/submit_form",
			type: "POST",
			data: new FormData(this),
			processData: false,
			contentType: false,
			dataType: "JSON",
			beforeSend: function () {
				$("#progress-bar").width("0%");
				$("#loader-icon").show();
			},
			error: function () {
				$("#loader-icon").html(
					'<p style="color:#EA4335;">File upload failed, please try again.</p>'
				);
			},
			success: function (response) {
				if (response.success) {
					var hp = "6285171670522";
					var textEncode = encodeURI(
						`*ID Order : ${response.id}*\nBerikut adalah bukti pembayaran dari pendaftaran buku saya.`
					);
					window.open(`https://wa.me/${hp}?text=${textEncode}`, "_blank");
					$("#daftar")[0].reset();
					$("#loader-icon").html(
						'<p style="color:#28A74B;">File has uploaded successfully!</p>'
					);
					Swal.fire({
						// position: 'top-end',
						icon: response.message.icon,
						title: response.message.title,
						text: response.message.text,
						showConfirmButton: true,
					}).then((result) => {
						/* Read more about isConfirmed, isDenied below */

						window.location.href = "dashboard";
					});
				} else {
					$("#progress-bar").width("0px");
					$("#loader-icon").html(
						'<p style="color:#EA4335;">Terdapat inputan yang tidak sesuai, mohon cek ulang.</p>'
					);
					if (response.message.alert_type == "swal") {
						Swal.fire({
							// position: 'top-end',
							icon: "error",
							text: response.message.message,
							showConfirmButton: true,
						});
					} else if (response.message.alert_type == "classic") {
						var message = response.message;
						$("#judulErr").text(message.title_error);
						$("#descErr").text(message.desc_error);
						$("#copyErr").text(message.paket_harga_error);
						$("#kertasErr").text(message.kertas_error);
						$("#berkasErr").text(message.berkas_error);
						$("#is_coverErr").text(message.is_cover_error);
						$("#is_kdtErr").text(message.is_kdt_error);
						$("#pembacaErr").text(message.pembaca_error);
						$("#catatCoverErr").text(message.catat_cover_error);
						$("#uploadCoverErr").text(message.upload_cover_error);
						$("#alamatErr").text(message.alamat_error);
						$("#typeErr").text(message.jk_error);
					}
				}
			},
		});
	});

	// $("#cover").on("change", function () {
	// 	/* current this object refer to input element */ var $input = $(this);
	// 	/* collect list of files choosen */ var files = $input[0].files;
	// 	var filename = files[0].name;
	// 	/* getting file extenstion eg- .jpg,.png, etc */ var extension =
	// 		filename.substr(filename.lastIndexOf("."));
	// 	/* define allowed file types */ var allowedExtensionsRegx =
	// 		/(\.jpg|\.jpeg|\.png|\.gif)$/i;
	// 	/* testing extension with regular expression */ var isAllowed =
	// 		allowedExtensionsRegx.test(extension);
	// 	if (isAllowed) {
	// 		alert("File type is valid for the upload");
	// 		/* file upload logic goes here... */
	// 	} else {
	// 		alert("Invalid File Type.");
	// 		return false;
	// 	}
	// });

	$("#no_hp").keyup(function (e) {
		e.preventDefault();

		if (/\D/g.test(this.value)) {
			// Filter non-digits from input value.
			this.value = this.value.replace(/\D/g, "");
			$("#mustNum").text("Hanya dapat diisi menggunakan nomor");
		}

		$("#no_hp1").val($("#no_hp").val());
	});

	$("#add_writer").off("click");
	$(document).on("click", "#add_writer", function (e) {
		e.preventDefault();

		$(
			"#d_writer"
		).prepend(`<div id="per_writer" class="flex items-end w-full mb-2">
    <label class="block  w-full pr-2">
        <div class="relative">
		<input type="text" id="writer" name="writer[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan email penulis lainnya" />
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg> -->
            </div>
        </div>
    </label>
    
    <button id="remove_writer" class="bg-red-500 rounded-lg text-white mx-3">
                    <img src="assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
	});

	$(document).on("click", "#remove_writer", function (e) {
		e.preventDefault();

		let listNoLain = $(this).parent();
		$(listNoLain).remove();
	});

	$("#add_editor").off("click");
	$(document).on("click", "#add_editor", function (e) {
		e.preventDefault();

		$(
			"#d_editor"
		).prepend(`<div id="per_editor" class="flex items-end w-full mb-2">
    <label class="block  w-full pr-2">
        <div class="relative">
		<input type="text" id="editor" name="editor[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan email kontributor" />
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg> -->
            </div>
        </div>
    </label>
    
    <button id="remove_editor" class="bg-red-500 rounded-lg text-white mx-3">
                    <img src="assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
	});

	$(document).on("click", "#remove_editor", function (e) {
		e.preventDefault();

		let listNoLain = $(this).parent();
		$(listNoLain).remove();
	});

	$("#add_designer").off("click");
	$(document).on("click", "#add_designer", function (e) {
		e.preventDefault();

		$(
			"#d_designer"
		).prepend(`<div id="per_designer" class="flex items-end w-full mb-2">
    <label class="block  w-full pr-2">
        <div class="relative">
		<input type="text" id="designer" name="designer[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan email kontributor" />
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg> -->
            </div>
        </div>
    </label>
    
    <button id="remove_designer" class="bg-red-500 rounded-lg text-white mx-3">
                    <img src="assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
	});

	$(document).on("click", "#remove_designer", function (e) {
		e.preventDefault();

		let listNoLain = $(this).parent();
		$(listNoLain).remove();
	});

	$("#add_tata_letak").off("click");
	$(document).on("click", "#add_tata_letak", function (e) {
		e.preventDefault();

		$(
			"#d_tata_letak"
		).prepend(`<div id="per_tata_letak" class="flex items-end w-full mb-2">
    <label class="block  w-full pr-2">
        <div class="relative">
		<input type="text" id="tata_letak" name="tata_letak[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan email kontributor" />
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                    </svg> -->
            </div>
        </div>
    </label>
    
    <button id="remove_tata_letak" class="bg-red-500 rounded-lg text-white mx-3">
                    <img src="assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
	});

	$(document).on("click", "#remove_tata_letak", function (e) {
		e.preventDefault();

		let listNoLain = $(this).parent();
		$(listNoLain).remove();
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
			data: { id: id },
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

	function writerValidasi() {
		$("[id^=writer]").each(function () {
			var text = $(this).val();
			var ini = $(this);
			if (IsEmail(text) == true) {
				$.ajax({
					type: "post",
					url: "pci/cekEmail",
					data: {
						email: text,
					},
					dataType: "json",
					success: function (response) {
						if (response.success == false) {
							ini.removeClass("border-slate-300");
							ini.removeClass("border-green-500");
							ini.addClass("border-red-500");
						} else {
							$("#writerErr").text("");
							ini.removeClass("border-slate-300");
							ini.removeClass("border-red-500");
							ini.addClass("border-green-500");
						}
					},
				});
			} else {
				ini.removeClass("border-slate-300");
				ini.removeClass("border-green-500");
				ini.addClass("border-red-500");
			}
		});
	}
	function designerValidasi() {
		$("[id^=designer]").each(function () {
			var text = $(this).val();
			var ini = $(this);
			if (IsEmail(text) == true) {
				$.ajax({
					type: "post",
					url: "pci/cekEmail",
					data: {
						email: text,
					},
					dataType: "json",
					success: function (response) {
						if (response.success == false) {
							ini.removeClass("border-slate-300");
							ini.removeClass("border-green-500");
							ini.addClass("border-red-500");
						} else {
							$("#designerErr").text("");
							ini.removeClass("border-slate-300");
							ini.removeClass("border-red-500");
							ini.addClass("border-green-500");
						}
					},
				});
			} else {
				ini.removeClass("border-slate-300");
				ini.removeClass("border-green-500");
				ini.addClass("border-red-500");
			}
		});
	}
	function editorValidasi() {
		$("[id^=editor]").each(function () {
			var text = $(this).val();
			var ini = $(this);
			if (IsEmail(text) == true) {
				$.ajax({
					type: "post",
					url: "pci/cekEmail",
					data: {
						email: text,
					},
					dataType: "json",
					success: function (response) {
						if (response.success == false) {
							ini.removeClass("border-slate-300");
							ini.removeClass("border-green-500");
							ini.addClass("border-red-500");
						} else {
							$("#editorErr").text("");
							ini.removeClass("border-slate-300");
							ini.removeClass("border-red-500");
							ini.addClass("border-green-500");
						}
					},
				});
			} else {
				ini.removeClass("border-slate-300");
				ini.removeClass("border-green-500");
				ini.addClass("border-red-500");
			}
		});
	}
	function tata_letakValidasi() {
		$("[id^=tata_letak]").each(function () {
			var text = $(this).val();
			var ini = $(this);
			if (IsEmail(text) == true) {
				$.ajax({
					type: "post",
					url: "pci/cekEmail",
					data: {
						email: text,
					},
					dataType: "json",
					success: function (response) {
						if (response.success == false) {
							ini.removeClass("border-slate-300");
							ini.removeClass("border-green-500");
							ini.addClass("border-red-500");
						} else {
							$("#tata_letakErr").text("");
							ini.removeClass("border-slate-300");
							ini.removeClass("border-red-500");
							ini.addClass("border-green-500");
						}
					},
				});
			} else {
				ini.removeClass("border-slate-300");
				ini.removeClass("border-green-500");
				ini.addClass("border-red-500");
			}
		});
	}

	function total() {
		const rupiah = (number) => {
			return new Intl.NumberFormat("id-ID", {
				style: "currency",
				currency: "IDR",
			}).format(number);
		};
		var jumlah = $("#biaya").text();
		var jmlh = parseInt(jumlah.replace(/Rp|,00|\./g, ""));
		var potongan = $("#potongan").text();
		var ptgn = parseInt(potongan.replace(/Rp|,00|\./g, ""));
		var totalAll = jmlh - ptgn;
		if (totalAll < 0) {
			totalAll = 0;
		}
		$("#total").text(rupiah(parseInt(totalAll)));
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

	function removeDuplicates(arr) {
		return arr.filter((item, index) => arr.indexOf(item) === index);
	}

	// function notifikasi() {
	// 	Swal.fire({
	// 		// position: 'top-end',
	// 		icon: "error",
	// 		text: validasi(),
	// 		showConfirmButton: true,
	// 	});
	// }

	function IsEmail(email) {
		var regex =
			/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if (regex.test(email)) {
			return true;
		} else {
			return false;
		}
	}
});

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
	loadkabupaten();
});

function loadkabupaten() {
	$("#prov_id").change(function () {
		var getprovinsi = $(this).val();
		console.log(getprovinsi);

		$.ajax({
			type: "POST",
			dataType: "JSON",
			url: "auth/getKab",
			data: {
				provinsi: getprovinsi,
			},
			async: false,
			success: function (data) {
				var html = "";
				var i;
				html = "<option value='' selected>--pilih--</option>";
				for (i = 0; i < data.length; i++) {
					html +=
						'<option value="' +
						data[i].id +
						'">' +
						data[i].nama_kabupaten_kota +
						"</option>";
				}

				$("#kab_id").html(html);
			},
		});
	});
}
