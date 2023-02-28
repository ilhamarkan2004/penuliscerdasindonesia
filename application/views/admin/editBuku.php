<style>
    @import url("https://fonts.googleapis.com/css2?family=Open+Sans&family=Poppins:wght@300;400;500;600;700&display=swap");

    #progress-bar {
        background-color: #12CC1A;
        color: #FFFFFF;
        width: 0%;
        -webkit-transition: width .3s;
        -moz-transition: width .3s;
        transition: width .3s;
        border-radius: 5px;
    }
</style>


<link id="pagestyle" href="<?= base_url() ?>assets/css/editBuku.css" rel="stylesheet" />
<style>
    input {
        font-weight: 400;
    }

    textarea {
        font-weight: 400;
    }
</style>

<div class="section1">
    <div class="div1 min-w-360">
        <div class="div2">

            <div class="div3 lg-w-3per5">
                <div class="w-full">
                    <!-- Form Pendaftaran -->
                    <form action="#" id="updateBook" enctype="multipart/form-data" method="POST">
                        <input type="text" id="id_book" name="id_book" value="<?= $id_buku ?>" hidden />
                        <h1 class="h1-form">
                            Form Ubah Data Buku
                        </h1>
                        <!-- ================== UMUM =================== -->
                        <p class="p1-form">Umum</p>
                        <label class="label1-form mt-6">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                Judul Buku
                            </span>
                            <input type="text" id="title" name="title" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan judul buku anda" value="<?= $buku['title'] ?>" />
                            <small id="judulErr" class="text-red"></small>
                        </label>

                        <label class="label1-form">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                Sinopsis buku
                            </span>
                            <textarea id="desc" rows="5" name="desc" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan sinopsis buku anda"><?= $buku['description'] ?></textarea>
                            <small id="descErr" class="text-red"></small>
                        </label>

                        <label class="label1-form">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                Pilihan ukuran kertas
                            </span>
                            <div class="w-full my-3" style="gap: 0.5rem;">
                                <?php foreach ($kertas as $hp) : ?>
                                    <button id="kertas" value="<?= $hp['id'] ?>" name="book_size_id" class="bg-green-<?= ($hp['id'] == $buku['book_size_id']) ? '500' : '300'; ?> rounded-xl text-white py-4 px-3 my-2">
                                        <?= $hp['title'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="kertasErr" class="text-red"></small>
                            <input type="hidden" id="id_kertas" name="id_kertas" value="<?= $buku['book_size_id'] ?>">
                            <small style="font-size: x-small ;">( Klik salah satu untuk memilih ukuran kertas )</small>
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Pilihan jenis kertas
                            </span>
                            <div class="w-full my-3" style="gap: 0.5rem;">
                                <?php foreach ($jk as $j) : ?>
                                    <button id="jk" value="<?= $j['id'] ?>" name="book_paper_id" class="bg-green-<?= ($j['id'] == $buku['book_paper_id']) ? '500' : '300'; ?> rounded-xl text-white py-4 px-3 my-2">
                                        <?= $j['paper_name'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="typeErr" class="text-red-500"></small>
                            <input type="hidden" id="id_jk" name="id_jk" value="<?= $buku['book_paper_id'] ?>">
                            <small style="font-size: x-small ;">( Klik salah satu untuk memilih jenis kertas )</small>
                        </label>

                        <label class="label1-form">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                Upload Naskah
                            </span>
                            <input type="file" id="berkas" name="berkas" class="block w-full text-sm text-slate-500  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-50 hover:file:bg-green-600" />
                            <small id="berkasErr" class="text-red"></small>
                        </label>
                        <!-- ================== DESAIN COVER ========================== -->
                        <p class="p1-form">Desain Cover</p>
                        <small>Upload jika ingin memperbarui cover</small>

                        <div class="text-center">
                            <div class="w-full flex justify-center my-6 mt-7">
                                <button id="butuh_desain1" name="butuh_desain" class="bg-green-<?= ($buku['is_cover'] == 0) ? '500' : '300'; ?> rounded-l-full text-white py-3 px-3">
                                    Saya <b>sudah</b> punya desain cover
                                </button>
                                <button id="butuh_desain2" name="butuh_desain" class="bg-red-<?= ($buku['is_cover'] == 1) ? '500' : '300'; ?> rounded-r-full text-white py-3 px-3">
                                    Saya <b>belum</b> punya desain cover
                                </button>
                                <input type="text" id="is_cover" name="is_cover" value="<?= $buku['is_cover'] ?>" hidden>
                            </div>
                            <small style="font-size: x-small ;">( Klik salah satu )</small>
                            <small id="is_coverErr" class="text-red"></small>
                        </div>

                        <div id="bikinDesign" class="bikinDesign" style="display: none;">
                            <label class="label1-form">
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                    Segmen Pembaca
                                </span>
                                <input value="<?= $buku['reader_cover'] ?>" type="text" id="pembaca" name="pembaca" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Contoh: Pelajar, Anak-anak, semua kalangan" />
                                <small id="pembacaErr" class="text-red"></small>
                            </label>
                            <label class="label1-form">
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form">
                                    Catatan
                                </span>
                                <textarea id="catatCover" rows="5" name="catatCover" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Catatan ini untuk memberikan gambaran dari cover yang anda inginkan"><?= $buku['note_cover'] ?></textarea>
                                <small id="catatCoverErr" class="text-red"></small>
                            </label>
                        </div>

                        <div id="uploadCover">
                            <label class="label1-form">
                                <span class=" after:ml-0.5 after:text-red-500 span1-form">
                                    Upload Cover
                                </span>
                                <input type="file" id="cover" name="cover" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-50 hover:file:bg-green-600" />
                                <small id="uploadCoverErr" class="text-red"></small>
                            </label>
                        </div>

                        <p class="p1-form">Kebutuhan ISBN</p>

                        <div id="list_writer mt-7">
                            <!-- per Nomor -->
                            <div id="per_writer" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form block pr-2">
                                            Penulis
                                        </span>
                                        <small id="writerErr" class="text-red"></small>
                                        <button id="add_writer" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="writer" name="writer[]" value="<?= $Penulis[0]['email'] ?>" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan email penulis" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div id="d_writer">
                                <?php foreach ($Penulis as $key => $p) :
                                    if ($key < 1) {
                                        continue;
                                    } ?>

                                    <div id="per_writer" class="flex items-end w-full mb-2">
                                        <label class="block  w-full pr-2">
                                            <div class="relative">
                                                <input type="text" id="writer" name="writer[]" value="<?= $p['email'] ?>" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan nama penulis lainnya" />
                                            </div>
                                        </label>

                                        <button id="remove_writer" class="bg-red-500 rounded-lg text-white mx-3">
                                            <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div id="list_editor">
                            <!-- per Nomor -->
                            <div id="per_editor" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form block pr-2">
                                            Editor
                                        </span>
                                        <button id="add_editor" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="editor" name="editor[]" value="<?= $Editor[0]['email'] ?>" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div id="d_editor">
                                <?php foreach ($Editor as $key => $p) :
                                    if ($key < 1) {
                                        continue;
                                    } ?>

                                    <div id="per_editor" class="flex items-end w-full mb-2">
                                        <label class="block  w-full pr-2">
                                            <div class="relative">
                                                <input type="text" id="editor" name="editor[]" value="<?= $p['email'] ?>" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan nama penulis lainnya" />
                                            </div>
                                        </label>

                                        <button id="remove_editor" class="bg-red-500 rounded-lg text-white mx-3">
                                            <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div id="list_designer">
                            <!-- per Nomor -->
                            <div id="per_designer" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form block pr-2">
                                            Desain Cover
                                        </span>
                                        <small id="designerErr" class="text-red"></small>
                                        <button id="add_designer" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="designer" name="designer[]" value="<?= $DesainCover[0]['email'] ?>" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div id="d_designer">
                                <?php foreach ($DesainCover as $key => $p) :
                                    if ($key < 1) {
                                        continue;
                                    } ?>

                                    <div id="per_designer" class="flex items-end w-full mb-2">
                                        <label class="block  w-full pr-2">
                                            <div class="relative">
                                                <input type="text" id="designer" name="designer[]" value="<?= $p['email'] ?>" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan nama penulis lainnya" />
                                            </div>
                                        </label>

                                        <button id="remove_designer" class="bg-red-500 rounded-lg text-white mx-3">
                                            <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div id="list_tata_letak">
                            <!-- per Nomor -->
                            <div id="per_tata_letak" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 span1-form block pr-2">
                                            Tata Letak
                                        </span>
                                        <button id="add_tata_letak" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="tata_letak" name="tata_letak[]" value="<?= $TataLetak[0]['email'] ?>" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div id="d_tata_letak">
                                <?php foreach ($TataLetak as $key => $p) :
                                    if ($key < 1) {
                                        continue;
                                    } ?>

                                    <div id="per_tata_letak" class="flex items-end w-full mb-2">
                                        <label class="block  w-full pr-2">
                                            <div class="relative">
                                                <input type="text" id="tata_letak" name="tata_letak[]" value="<?= $p['email'] ?>" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none block w-full rounded-md sm:text-sm" placeholder="Masukkan nama penulis lainnya" />
                                            </div>
                                        </label>

                                        <button id="remove_tata_letak" class="bg-red-500 rounded-lg text-white mx-3">
                                            <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <p class="p1-form">Lainnya</p>

                        <div class="text-center">
                            <div class="w-full flex justify-center my-6 mt-7">
                                <button id="butuh_kdt1" name="butuh_kdt" class="bg-green-<?= ($buku['is_kdt'] == 1) ? '500' : '300'; ?> rounded-l-full text-white py-3 px-3">
                                    Saya <b>butuh</b> KDT
                                </button>
                                <button id="butuh_kdt2" name="butuh_kdt" class="bg-red-<?= ($buku['is_kdt'] == 0) ? '500' : '300'; ?> rounded-r-full text-white py-3 px-3">
                                    Saya <b>tidak butuh</b> KDT
                                </button>
                                <input type="text" id="is_kdt" name="is_kdt" value="<?= $buku['is_kdt'] ?>" hidden>
                            </div>
                            <small style="font-size: x-small ;">( Klik salah satu )</small>
                            <small id="is_kdtErr" class="text-red"></small>
                        </div>

                        <!-- <label class="block mt-7">
                            <span class=" span1-form">
                                Alamat pengiriman
                            </span>
                            <input type="text" id="alamat" name="alamat" class="input1-form placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block sm:text-sm focus:ring-1" placeholder="Masukkan alamat pengiriman hasil cetak" />
                            <small id="alamatErr" class="text-red"></small>
                        </label> -->

                        <div class="min-w-[360px] mt-6">
                            <div>
                                <div class="rounded-lg bg-white rounded-t-lg shadow-[0px_25px_90px_10px_rgba(130,130,130,0.23)] mx-2 py-3 px-3 border-x border-b">
                                    <button type="submit" id="b_confirm" class=" bg-green-500 text-white rounded-lg py-4 font-bold w-full hover:ring-primaryDetailText ring-2">
                                        Konfirmasi Perubahan
                                    </button>
                                    <div id="progress-div">
                                        <div id="progress-bar"></div>
                                    </div>
                                    <div id="loader-icon" style="display:none;"><img src="LoaderIcon.gif"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url('assets/js/editBuku.js'); ?>"></script>

<script>
    $(document).ready(function() {
        $("#updateBook").submit(function(e) {
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
                xhr: function() {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener(
                        "progress",
                        function(evt) {
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
                url: "<?= base_url() ?>progress/aksiEditBuku",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                dataType: "JSON",
                beforeSend: function() {
                    $("#progress-bar").width("0%");
                    $("#loader-icon").show();
                },
                error: function() {
                    $("#loader-icon").html(
                        '<p style="color:#EA4335;">File upload failed, please try again.</p>'
                    );
                },
                success: function(response) {
                    var message = response.message;
                    if (response.success) {
                        $("#updateBook")[0].reset();
                        $("#loader-icon").html(
                            '<p style="color:#28A74B;">File has uploaded successfully!</p>'
                        );
                        Swal.fire({
                            // position: 'top-end',

                            icon: message.icon,
                            title: message.title,
                            text: message.text,
                            showConfirmButton: true,
                        }).then((result) => {

                            window.location = '<?= base_url() ?>progress';
                            // window.location.href = "dashboard";
                        });
                    } else {
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

        function writerValidasi() {
            $("[id^=writer]").each(function() {
                var text = $(this).val();
                var ini = $(this);
                if (IsEmail(text) == true) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>pci/cekEmail",
                        data: {
                            email: text,
                        },
                        dataType: "json",
                        success: function(response) {
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
            $("[id^=designer]").each(function() {
                var text = $(this).val();
                var ini = $(this);
                if (IsEmail(text) == true) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>pci/cekEmail",
                        data: {
                            email: text,
                        },
                        dataType: "json",
                        success: function(response) {
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
            $("[id^=editor]").each(function() {
                var text = $(this).val();
                var ini = $(this);
                if (IsEmail(text) == true) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>pci/cekEmail",
                        data: {
                            email: text,
                        },
                        dataType: "json",
                        success: function(response) {
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
            $("[id^=tata_letak]").each(function() {
                var text = $(this).val();
                var ini = $(this);
                if (IsEmail(text) == true) {
                    $.ajax({
                        type: "post",
                        url: "<?= base_url() ?>pci/cekEmail",
                        data: {
                            email: text,
                        },
                        dataType: "json",
                        success: function(response) {
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

        function IsEmail(email) {
            var regex =
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (regex.test(email)) {
                return true;
            } else {
                return false;
            }
        }

        $("#add_writer").off("click");
        $(document).on("click", "#add_writer", function(e) {
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
                    <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
        });

        $(document).on("click", "#remove_writer", function(e) {
            e.preventDefault();

            let listNoLain = $(this).parent();
            $(listNoLain).remove();
        });

        $("#add_editor").off("click");
        $(document).on("click", "#add_editor", function(e) {
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
                    <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
        });

        $(document).on("click", "#remove_editor", function(e) {
            e.preventDefault();

            let listNoLain = $(this).parent();
            $(listNoLain).remove();
        });

        $("#add_designer").off("click");
        $(document).on("click", "#add_designer", function(e) {
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
                    <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
        });

        $(document).on("click", "#remove_designer", function(e) {
            e.preventDefault();

            let listNoLain = $(this).parent();
            $(listNoLain).remove();
        });

        $("#add_tata_letak").off("click");
        $(document).on("click", "#add_tata_letak", function(e) {
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
                    <img src="<?= base_url() ?>assets/assets/vector/close-square.svg" alt="">
                </button>
 </div>`);
        });

        $(document).on("click", "#remove_tata_letak", function(e) {
            e.preventDefault();

            let listNoLain = $(this).parent();
            $(listNoLain).remove();
        });



    });
</script>