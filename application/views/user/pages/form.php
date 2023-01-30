<script src="https://cdn.tailwindcss.com"></script>
<section class="flex justify-center">
    <div class="container min-w-[360px]">
        <div class="flex flex-wrap w-full h-full px-9 lg:px-16 py-16">
            <div class="w-full lg:w-2/5 flex justify-center p-10">
                <div class="w-fit flex flex-col items-center">
                    <!--Program Pelatihan -->
                    <div class="min-w-[260px] w-fit">
                        <div class="shadow-md rounded-md lg:px-16 pb-6 bg-white m-4 border">
                            <div class="border-b-2 border-[#F5F5F5];">
                                <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                    <?= $paket['paket_name'] ?>
                                </h1>
                                <div class="flex items-center flex-col">
                                    <img src="<?= base_url('assets/assets/vector/solo.svg'); ?>" class="my-[16px]" />
                                </div>
                                <div class="flex items-center flex-col">
                                    <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                        <?= $paket['copy_num'] ?> eksemplar
                                    </h2>

                                </div>
                            </div>

                            <!-- Fasililtas -->
                            <div class="p-4">
                                <h1 class="h2-section-lp text-secondaryDetailText mt-6">
                                    Fasilitas yang didapat
                                </h1>
                                <div class="gap-4 text-sm my-3">
                                    <?php foreach ($fasilitas as $fs) : ?>
                                        <div class="my-1.5 flex items-center">
                                            <img src="<?= base_url('assets/assets/vector/double_checklist.svg'); ?>" class="mr-6" />
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
                                Ukuran kertas
                            </span>
                            <div class="w-full my-3">
                                <?php foreach ($harga_paket as $hp) : ?>
                                    <button id="harga_paket" value="<?= $hp['id_paket_harga'] ?>" name="paket_harga_id" class="bg-green-300 rounded-xl text-white py-4 px-3">
                                        <?= $hp['book_sizes_title'] ?>
                                    </button>
                                <?php endforeach; ?>
                            </div>
                            <small id="kertasErr" class="text-red-500"></small>
                            <input type="text" id="id_paket_harga" name="id_paket_harga" value="" hidden>
                            <small style="font-size: x-small ;">( Klik salah satu untuk memilih ukuran kertas )</small>
                        </label>

                        <label class="block mb-7">
                            <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700">
                                Upload Naskah
                            </span>
                            <input type="file" id="berkas" name="berkas" class="block w-full text-sm text-slate-500  file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-500 file:text-green-50 hover:file:bg-green-600" />
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


                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Kebutuhan BNSP</p>

                        <div id="list_writer mt-7">
                            <!-- per Nomor -->
                            <div id="per_writer" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
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
                                </label>
                            </div>
                            <div id="d_writer">

                            </div>
                        </div>

                        <div id="list_editor">
                            <!-- per Nomor -->
                            <div id="per_editor" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700 block pr-2">
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
                                </label>
                            </div>
                            <div id="d_editor">

                            </div>
                        </div>

                        <div id="list_designer">
                            <!-- per Nomor -->
                            <div id="per_designer" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700 block pr-2">
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
                                </label>
                            </div>
                            <div id="d_designer">

                            </div>
                        </div>

                        <div id="list_tata_letak">
                            <!-- per Nomor -->
                            <div id="per_tata_letak" class="flex items-end w-full mt-6">
                                <label class="block mb-2 w-full pr-2">
                                    <div class="flex items-center justify-between">
                                        <span class="after:content-['*'] after:ml-0.5 after:text-red-500 block text-sm font-medium text-slate-700 block pr-2">
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
                                </label>
                            </div>
                            <div id="d_tata_letak">

                            </div>
                        </div>

                        <p class="font-bold text-2xl mx-4 pt-10 border-b">Lainnya</p>

                        <div class="text-center">
                            <div class="w-full flex justify-center my-6 mt-7">
                                <button id="butuh_kdt1" name="butuh_kdt" class="bg-green-300 rounded-l-full text-white py-3 px-3">
                                    Saya <b>butuh</b> KDT
                                </button>
                                <button id="butuh_kdt2" name="butuh_kdt" class="bg-red-300 rounded-r-full text-white py-3 px-3">
                                    Saya <b>tidak butuh</b> KDT
                                </button>
                                <input type="text" id="is_kdt" name="is_kdt" value="" hidden>
                            </div>
                            <small style="font-size: x-small ;">( Klik salah satu )</small>
                            <small id="is_kdtErr" class="text-red-500"></small>
                        </div>

                        <label class="block mt-7">
                            <span class=" block text-sm font-medium text-slate-700">
                                Alamat pengiriman
                            </span>
                            <input type="text" id="alamat" name="alamat" class="mt-1 px-3 py-2 bg-white border shadow-sm border-slate-300 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-sky-500 block w-full rounded-md sm:text-sm focus:ring-1" placeholder="Masukkan alamat pengiriman hasil cetak" />
                            <small id="alamatErr" class="text-red-500"></small>
                        </label>




                        <!-- Metode Pembayaran -->
                        <div class="min-w-[360px] mt-6">
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
                                        <span for="n_program">Pembayaran atas nama </span>
                                        <span class=""><b><?= $currentUser['name'] ?></b></span>
                                    </div>
                                    <div class="flex w-full py-1 justify-between">
                                        <span for="n_program"><?= $paket['paket_name'] ?> - <span id="ukuran">(Pilih ukuran)</span> </span>
                                        <span class="" id="biaya">Rp. 0,00</span>
                                    </div>
                                    <div class="flex w-full py-1 justify-between">
                                        <span for="n_program">Jumlah pointmu</span>

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
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>