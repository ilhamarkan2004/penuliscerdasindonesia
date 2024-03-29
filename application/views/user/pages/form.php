<style>
    #progress-bar {
        background-color: #12CC1A;
        color: #FFFFFF;
        text-align: end;
        border-radius: 10px;
        width: 0%;
        -webkit-transition: width .3s;
        -moz-transition: width .3s;
        transition: width .3s;
    }

    .hovertext {
        position: relative;
        border-bottom: 1px dotted black;
    }

    .hovertext:before {
        content: attr(data-hover);
        visibility: hidden;
        opacity: 0;
        width: max-content;
        max-width: 500%;
        background-color: #12CC1A;
        color: #fff;
        text-align: center;
        border-radius: 5px;
        padding: 5px 5px;
        transition: opacity 1s ease-in-out;

        position: absolute;
        z-index: 1;
        left: 0;
        top: 110%;
    }

    .hovertext:hover:before {
        opacity: 1;
        visibility: visible;
    }
</style>

<script src="https://cdn.tailwindcss.com"></script>
<section class="flex justify-center pt-16">
    <div class="container min-w-[360px]">
        <div class="flex flex-wrap w-full h-full px-9 lg:px-16 py-16">
            <div class="w-full lg:w-2/5 flex justify-center p-10">
                <div class="w-fit flex flex-col items-center">
                    <!--Program Pelatihan -->
                    <div class="min-w-[260px] w-fit">
                        <div class="shadow-md rounded-md lg:px-16 pb-6 bg-white m-4 border border-primary-100">
                            <div class="border-b-2 border-[#F5F5F5];">
                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                    <?= $paket['paket_name'] ?>
                                </h1>
                                <div class="flex items-center flex-col">
                                    <img src="<?= base_url('assets/assets/vector/books.svg'); ?>" class="my-[16px]" />
                                </div>
                                <!-- <div class="flex items-center flex-col">
                                    <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                        <?= $paket['copy_num'] ?> eksemplar
                                    </h2>

                                </div> -->
                            </div>

                            <!-- Fasililtas -->
                            <div class="p-4">
                                <h1 class="h2-section-lp text-secondary-100 mt-6">
                                    Fasilitas yang didapat
                                </h1>
                                <div class="gap-4 text-sm my-3">
                                    <?php foreach ($fasilitas as $fs) : ?>
                                        <div class="my-1.5 flex items-center">
                                            <i class="fa-solid fa-check-double text-secondary-100"></i>
                                            <p><?= $fs->fasilitas ?></p>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="flex justify-center relative h-11 top-[-38px]"></div> -->
                    </div>
                </div>
            </div>
            <div class="w-full lg:w-3/5 flex justify-center p-10">
                <div class="w-full">
                    <!-- Form Pendaftaran -->
                    <form action="#" id="daftar" enctype="multipart/form-data" method="POST">
                        <h1 class="h1-section-lp text-center text-3xl">
                            Form Pendaftaran
                        </h1>
                        <!-- ================== UMUM =================== -->
                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Umum</p>
                        <label class="block mb-7 mt-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Judul Buku
                            </span>
                            <input type="text" id="title" name="title" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan judul buku anda" />
                            <small id="judulErr" class="text-red-500"></small>
                        </label>
                        <!-- Input telepon -->
                        <!-- <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Nomor Telepon
                            </span>
                            <div class="flex">
                                <span class="flex items-center mt-1 px-3 text-sm text-gray-900 bg-gray-200 border border-r-0 border-gray-300 rounded-l-md dark:bg-gray-600 dark:text-gray-400 dark:border-gray-600">
                                    +62
                                </span>
                                <input value="" type="text" id="no_hp" name="no_hp" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-r-md sm:text-sm focus:ring-1" placeholder="Masukkan nomor telepon anda" />
                            </div>
                            <small id="mustNum" class="text-red-500"></small>
                        </label> -->

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Sinopsis buku
                            </span>
                            <textarea id="desc" rows="5" name="desc" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan sinopsis buku anda"></textarea>
                            <small id="descErr" class="text-red-500"></small>
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Jumlah eksemplar
                            </span>
                            <div class="w-full my-3" style="gap: 0.5rem;">
                                <?php foreach ($harga_paket as $hp) : ?>
                                    <button id="harga_paket" value="<?= $hp['id_paket_harga'] ?>" name="paket_harga_id" class="bg-green-300 rounded-xl text-white py-4 px-3 my-2">
                                        <?= $hp['copy_num'] ?> eksemplar
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="copyErr" class="text-red-500"></small>
                            <input type="text" id="id_paket_harga" name="id_paket_harga" value="" hidden>
                            <!-- <small style="font-size: x-small ;">( Klik salah satu untuk memilih ukuran kertas )</small> -->
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Pilihan ukuran kertas
                            </span>
                            <div class="w-full my-3" style="gap: 0.5rem;">
                                <?php foreach ($kertas as $hp) : ?>
                                    <button id="kertas" value="<?= $hp['id'] ?>" name="book_size_id" class="bg-green-300 rounded-xl text-white py-4 px-3 my-2">
                                        <?= $hp['title'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="kertasErr" class="text-red-500"></small>
                            <input type="text" id="id_kertas" name="id_kertas" value="" hidden>
                            <!-- <small style="font-size: x-small ;">( Klik salah satu untuk memilih ukuran kertas )</small> -->
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Pilihan jenis kertas
                            </span>
                            <div class="w-full my-3" style="gap: 0.5rem;">
                                <?php foreach ($jk as $j) : ?>
                                    <button id="jk" value="<?= $j['id'] ?>" name="book_paper_id" class="bg-green-300 rounded-xl text-white py-4 px-3 my-2">
                                        <?= $j['paper_name'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="typeErr" class="text-red-500"></small>
                            <input type="hidden" id="id_jk" name="id_jk" value="">
                            <!-- <small style="font-size: x-small ;">( Klik salah satu untuk memilih jenis kertas )</small> -->
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Upload Naskah
                            </span>
                            <input type="file" id="berkas" name="berkas" class="block w-full text-sm text-slate-500  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-50 hover:file:bg-green-600" />
                            <small style="font-size: x-small ;">Format file yang dapat diupload adalah pdf, doc, docx, ppt, dan pptx</small>
                            <small id="berkasErr" class="text-red-500"></small>
                        </label>
                        <!-- ================== DESAIN COVER ========================== -->
                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Desain Cover</p>

                        <div class="text-center">
                            <div class="w-full flex justify-center my-6 mt-7">
                                <button id="butuh_desain1" name="butuh_desain" class="bg-green-300 rounded-l-full text-white py-3 px-3">
                                    Saya <b>sudah</b> punya desain cover
                                </button>
                                <button id="butuh_desain2" name="butuh_desain" class="bg-red-300 rounded-r-full text-white py-3 px-3">
                                    Saya <b>belum</b> punya desain cover
                                </button>
                                <input type="text" id="is_cover" name="is_cover" value="" hidden>
                            </div>
                            <small style="font-size: x-small ;">( Klik salah satu )</small>
                            <small id="is_coverErr" class="text-red-500"></small>
                        </div>

                        <div id="bikinDesign" class="bikinDesign" hidden>
                            <label class="block mb-7">
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Segmen Pembaca
                                </span>
                                <input type="text" id="pembaca" name="pembaca" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Contoh: Pelajar, Anak-anak, semua kalangan" />
                                <small id="pembacaErr" class="text-red-500"></small>
                            </label>
                            <label class="block mb-7">
                                <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Catatan
                                </span>
                                <textarea id="catatCover" rows="5" name="catatCover" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Catatan ini untuk memberikan gambaran dari cover yang anda inginkan"></textarea>
                                <small id="catatCoverErr" class="text-red-500"></small>
                            </label>
                        </div>

                        <div id="uploadCover" hidden>
                            <label class="block mb-7">
                                <span class=" after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                    Upload Cover
                                </span>
                                <input type="file" id="cover" name="cover" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-50 hover:file:bg-green-600" />
                                <small id="uploadCoverErr" class="text-red-500"></small>
                            </label>
                        </div>


                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Kebutuhan ISBN</p>

                        <div id="list_writer mt-7">
                            <!-- per Nomor -->
                            <div id="per_writer" class="flex items-end w-full mt-6">
                                <div class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700 block pr-2">
                                            Penulis
                                        </span>
                                        <small id="writerErr" class="text-red-500"></small>
                                        <button id="add_writer" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="writer" name="writer[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan email penulis" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="d_writer">

                            </div>
                        </div>

                        <div id="list_editor">
                            <!-- per Nomor -->
                            <div id="per_editor" class="flex items-end w-full mt-6">
                                <div class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class=" block text-sm font-medium text-slate-700 block pr-2">
                                            Editor
                                        </span>
                                        <button id="add_editor" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="editor" name="editor[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="d_editor">

                            </div>
                        </div>

                        <div id="list_designer">
                            <!-- per Nomor -->
                            <div id="per_designer" class="flex items-end w-full mt-6">
                                <div class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class=" block text-sm font-medium text-slate-700 block pr-2">
                                            Desain Cover
                                        </span>
                                        <small id="designerErr" class="text-red-500"></small>
                                        <button id="add_designer" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="designer" name="designer[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="d_designer">

                            </div>
                        </div>

                        <div id="list_tata_letak">
                            <!-- per Nomor -->
                            <div id="per_tata_letak" class="flex items-end w-full mt-6">
                                <div class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class=" block text-sm font-medium text-slate-700 block pr-2">
                                            Tata Letak
                                        </span>
                                        <button id="add_tata_letak" class="bg-green-500 rounded-xl text-white py-2 px-3">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="relative">
                                        <input type="text" id="tata_letak" name="tata_letak[]" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan email kontributor" />
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <!-- <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                                </svg> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="d_tata_letak">

                            </div>
                        </div>

                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Lainnya</p>

                        <div class="">
                            <span class="hovertext" style="font-size: small; margin-left: 5px;" data-hover="KDT adalah sebuah deskripsi bibliografis yang dihasilkan dari pengolahan data yang diberikan untuk dicantumkan pada halaman balik halaman judul (halaman verso / copyright) sebagai kelengkapan penerbitan">
                                <b style="color: #12CC1A;"> Info KDT !</b>
                            </span>
                            <div class="w-full flex justify-center my-6 mt-7 text-center">
                                <button id="butuh_kdt1" name="butuh_kdt" class="bg-green-300 rounded-l-full text-white py-3 px-3">
                                    Saya <b>butuh</b> KDT
                                </button>
                                <button id="butuh_kdt2" name="butuh_kdt" class="bg-red-300 rounded-r-full text-white py-3 px-3">
                                    Saya <b>tidak butuh</b> KDT
                                </button>
                                <input type="text" id="is_kdt" name="is_kdt" value="" hidden>
                            </div>


                            <small id="is_kdtErr" class="text-red-500"></small>
                        </div>

                        <span class=" block text-sm font-medium text-slate-700">
                            Alamat pengiriman
                        </span>
                        <div class="flex-col flex lg:flex-row  mt-1 pt-2 w-full">
                            <div class="lg:w-1/2 w-full mr-1">
                                <label class="block mb-7 text-sm font-medium text-slate-700">Provinsi</label>
                                <select id="prov_id" name="provinsi_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5 w-full">
                                    <?php
                                    // $selected_prov = $data_member['provinsi_id'];
                                    ?>
                                    <option value="" selected>--pilih--</option>
                                    <?php foreach ($provinsi as $prov) : ?>

                                        <option value="<?= $prov['id'] ?>"><?= $prov['nama_provinsi'] ?></option>

                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="lg:w-1/2 w-full ml-1">
                                <label class="block mb-7 text-sm font-medium text-slate-700 ">Kota/Kabupaten</label>
                                <select id="kab_id" name="kabupaten_id" class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block mx-1 mb-3 p-2.5 w-full">
                                    <?php if (isset($data_member)) : ?>
                                        <?php
                                        // $selected_kab = $data_member['kabupaten_id'];
                                        ?>
                                        <option selected>--pilih--</option>
                                        <?php foreach ($kabupaten as $kab) : ?>

                                            <option value="<?= $kab['id'] ?>"><?= $kab['nama_kabupaten_kota'] ?></option>

                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                        </div>
                        <label class="block mb-7 text-sm font-medium text-slate-700">
                            <input type="text" id="alamat" name="alamat" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan alamat pengiriman hasil cetak" />
                            <small id="alamatErr" class="text-red-500"></small>
                        </label>

                        <!-- <label class="block mt-7">

                            <input type="text" id="alamat" name="alamat" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan alamat pengiriman hasil cetak" />
                            <small id="alamatErr" class="text-red-500"></small>
                        </label> -->




                        <!-- Metode Pembayaran -->
                        <div class="text-xs lg:text-base md:text-base mt-6">
                            <!-- <h1 class="h1-section-lp">Pembayaran</h1> -->
                            <div>
                                <!-- control -->
                                <div class="flex">
                                    <a id="p_otomatis" class="metodeBayar-active cursor-pointer mx-3 px-5 py-3 bg-white rounded-t-lg flex items-center justify-center text-center">
                                        <span class="text-primaryText font-semibold bg-transparent">Pembayaran</span>
                                    </a>
                                    <!-- <a id="p_manual" class="cursor-pointer mx-3 px-5 py-3 bg-white rounded-t-lg flex items-center justify-center text-center">
                                        <span class="text-primaryText font-semibold bg-transparent">Manual Transfer</span>
                                    </a> -->
                                </div>
                                <div class="rounded-lg bg-white rounded-t-lg shadow-[0px_25px_90px_10px_rgba(130,130,130,0.23)] mx-2 py-3 px-3 border-x border-b">
                                    <div class="flex w-full py-1 justify-between">
                                        <span class="w-1/2" for="n_program">Pembayaran atas nama </span>
                                        <span class="w-1/2 text-right"><b><?= $currentUser['name'] ?></b></span>
                                    </div>
                                    <div class="flex w-full py-1 justify-between">
                                        <span class="w-1/2" for="n_program"><?= $paket['paket_name'] ?> - <span id="ukuran">(Jumlah eksemplar)</span> </span>
                                        <span class="w-1/2 text-right" id="biaya">Rp. 0,00</span>
                                    </div>
                                    <div class="flex w-full py-1 justify-between">
                                        <span class="w-1/2" for="n_program">Jumlah pointmu</span>

                                        <div class="w-fit h-fit">
                                            <span>- </span>
                                            <span class="" id="potongan">Rp.
                                                <?= number_format($currentUser['point'], 0, '', '.')  ?>,00
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex w-full py-1 my-4 justify-between font-bold border-t">
                                        <span for="n_program">Total</span>
                                        <span class="" id="total">Rp.
                                            0,00
                                        </span>
                                    </div>

                                    <div id="tf_ke" class="m-5 w-full">
                                        <h2 class="font-bold">Transfer ke</h2>
                                        <div class="flex flex-wrap">
                                            <div id="transfer" class="mx-3">
                                                <img class="my-6" id="logo" src="<?= base_url() ?>assets/assets/img/lp/form/BCA.svg" alt="" />
                                                <p id="nama">Penulis Cerdas Indonesia</p>
                                                <p id="no_rek" class="font-bold">1xxxxxxxxxxx4</p>
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" id="b_confirm" class=" bg-green-500 text-white rounded-lg py-4 font-bold w-full hover:ring-primaryDetailText ring-2">
                                        Konfirmasi Pembayaran
                                    </button>
                                    <div id="progress-div" class="mt-6">
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
</section>