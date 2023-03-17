<button type="button" class="lg:w-14 w-10" style="position: fixed; right: 40px; bottom: 20px; display: none;" id="btn-back-to-top">
    <img src="<?= base_url() ?>assets/assets/logo/top.svg" width="56px" alt="">
</button>
<button type="button" class="lg:w-14 w-14" style="position: fixed; right: 40px; bottom: 100px; display: block;" id="wa">
    <img src="<?= base_url() ?>assets/assets/logo/wa.svg" width="60px" alt="">
</button>
<div class="text-center lg:text-right lg:flex lg:items-center lg:px-24 lg:pb-24 h-screen pt-16 lg:pt-0">
    <div class="lg:text-right lg:w-2/5 ">
        <p class="mt-8 md:text-base lg:text-4xl text-primary-100  md:text-4xl text-2xl font-bold ">
            <!-- <span class="block h-4 bg-primary-300 w-full absolute top-1/2"></span> -->
            <!-- title text-4xl  w-fit lg:w-2/5   -->
            Explore and publish your knowledge.
            <!-- <span class="relative md:text-4xl text-2xl text-primary-500 ">
                Explore and publish your knowledge.
            </span> -->
        </p>
        <p class="title mt-8 md:text-base text-lg">
            Berkarya, terbitkan, dan berbagi pengetahuan bersama <span class="font-bold text-primary-100">Penulis Cerdas Indonesia</span>
        </p>
    </div>

    <div class="my-container mt-12 lg:w-3/5 w-full ">
        <div class="relative">
            <img class="w-full bg-contain scale-75" src="<?= base_url() ?>assets/assets/img/index/read_book.png" />
        </div>
    </div>
</div>
<div class="bg-primary-100 md:py-24 py-16 lg:py-32 text-white">
    <div class="my-container flex flex-col gap-12">
        <div class="flex flex-col lg:flex-row items-start lg:gap-0 gap-6">
            <div class="desc lg:w-1/2 lg:text-left text-center lg:pr-12 flex flex-col gap-4 items-start">
                <a class="about px-3 py-2 lg:py-1 rounded bg-primary-600 " style="background-color: #e5c99e; color: #f59300;">
                    Tentang Kami
                </a>
                <p class="text-2xl md:text-2xl font-bold">
                    Explore and publish your knowledge
                    <!-- <span class="md:block hidden">dalam menghadapi </span>Era 5.0 -->
                </p>
                <a class="md:block px-3 py-1 text-black rounded" style="background-color: #a3d2d5;">
                    Merupakan komitmen kami dalam menyebarluaskan hasil penelitian bagi para peneliti di seluruh Indonesia.

                </a>
            </div>
            <div class="lg:w-1/2 text-start lg:text-left lg:pl-12">
                <p>Penulis Cerdas Indonesia (PCI) merupakan salah satu produk unggulan yang fokus sebagai penerbit buku yang mendukung transformasi digital dan telah terintegrasi dengan website. Buku-buku yang diterbitkan memiliki fitur interaktif "Smart Fitur" yang memudahkan pembaca dalam memahami isi buku.
                    <br> <br>
                    Penulis Cerdas Indonesia (PCI) juga berperan sebagai platform interaksi dan marketplace untuk penerbitan buku digital serta menyediakan proses penerbitan buku untuk dosen dan guru di seluruh Indonesia
                </p>
            </div>
        </div>
        <!-- <video style="border-radius: 15px;" src="<?= base_url() ?>assets/video/1.mp4" controls width="1400px" poster="<?= base_url() ?>assets/assets/img/index/videotron.png"></video> -->
    </div>
</div>

<!-- Kenapa memilih -->
<div id="aboutUs">
    <div class="my-container md:py-24 py-16 lg:py-28 flex flex-col gap-12">
        <div>
            <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
                Pilih Kami
            </div>
            <p class="font-bold text-xl md:text-2xl text-center mb-4">
                Kenapa memilih Penulis Cerdas Indonesia
            </p>
            <p class="text-center">
                Terbitkan buku anda dengan layanan yang akan kami berikan
            </p>
        </div>
        <div class="flex flex-row flex-wrap gap-4 md:gap-8 justify-center text-center">
            <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-money-bill text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Harga Terjangkau</p>
                <p class="md:text-sm">
                    Kami memberikan layanan jasa yang terjangkau, sehingga memudahkan penulis dalam menyebarluaskan karyanya.
                </p>
            </div>
            <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-bolt-lightning text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Cepat Terbit</p>
                <p class="md:text-sm">
                    Jasa penerbitan buku kami terpercaya dan menjamin 100% terbitnya buku. Dengan pengalaman dalam proses penerbitan, kami mampu menerbitkan buku dengan cepat.
                </p>
            </div>
            <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-fingerprint text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Ber-ISBN dan IKAPI</p>
                <p class="md:text-sm">
                    Setiap buku yang kami terbitkan memiliki kode unik ISBN (International Standard Book Number) sehingga judul buku dapat diidentifikasi secara internasional dan telah menjadi anggota IKAPI
                </p>
            </div>
            <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-check text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Anti ribet</p>
                <p class="md:text-sm">
                    Jasa kami memberikan layanan lengkap berupa editing EYD, layout, desain cover, dan Turnitin yang dapat memudahkan penulis dalam meningkatkan kualitas buku.
                </p>
            </div>
            <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-book text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Buku Digital Interaktif</p>
                <p class="md:text-sm">
                    Buku digital kami didesain interaktif untuk mendukung proses belajar mengajar dengan konten menarik berupa materi, gambar, audio, dan video.
                </p>
            </div>
            <!-- <div class="md:p-8 p-4 md:flex-grow-0 flex-grow w-1/3 lg:w-1/4 rounded-xl bg-white shadow-lg flex flex-col gap-6 hover:border hover:border-secondary-100">
                <i class="fa-solid fa-money-bill text-4xl" style="color: #FFA110;"></i>
                <p class="font-semibold md:text-base text-lg">Lorem Ipsum</p>
                <p class="md:text-sm">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus possimus
                </p>
            </div> -->


        </div>
    </div>
</div>

<!-- Pelatihan -->
<div>
    <div class="my-container md:py-24 py-16 lg:py-8 flex flex-col gap-12">
        <div>
            <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
                Paket Penerbitan
            </div>
            <p class="font-bold text-xl md:text-2xl text-center mb-4">
                Paket Penerbitan di Penulis Cerdas Indonesia
            </p>
            <p class="text-center">
                Beberapa paket penerbitan buku yang dapat anda pilih
            </p>
        </div>

        <!-- Style untuk card -->
        <style>
            @media (min-width: 600px) {
                .judul-1 {
                    font-size: 50px;
                }

                .judul-2 {
                    font-size: 16px;
                }

                .judul-3 {
                    font-size: 32px;
                }

                .judul-4 {
                    font-size: 16px;
                }

                .container-pelatihan {
                    height: 90px;
                }

                .container-card {
                    max-width: 1200px;
                }

                .pelatihan {
                    font-size: 22px;
                }

                .digital {
                    font-size: 20px;
                }

                .tanggal {
                    font-size: 14px;
                }

                .coret-harga {
                    font-size: 22px;
                }

                .harga {
                    font-size: 28px;
                }

                .kartu {
                    width: 325px;
                }

                .button {
                    font-size: 14px;
                    background-color: #FFA110;
                    align-self: flex-end;
                    padding: 15px 0;
                }
            }
        </style>
        <div class="container mx-auto">
            <div class="flex justify-center flex-wrap">
                <?php if (!empty($paket)) { ?>
                    <div class="flex flex-wrap justify-center lg:justify-start">

                        <?php foreach ($paket as $po) : ?>
                            <a href="<?= base_url() ?>terbit">
                                <div class="min-w-[260px]">
                                    <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2 hover:border hover:border-secondary-100">
                                        <div class="border-b-2 border-[#F5F5F5];">
                                            <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px] text-primary-100">
                                                <?php echo $po['paket_name'] ?>
                                            </h1>
                                            <div class="flex items-center flex-col">
                                                <img src="<?= base_url(); ?>assets/assets/vector/books.svg" class="my-[16px]" />
                                            </div>
                                            <div class="flex items-center flex-col">
                                                <h2 class="text-black font-semibold text-base lg:text-[18px] text-center">
                                                    <?php echo $po['copy_num'] ?> eksemplar
                                                </h2>

                                                <!-- <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                                    Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                                </h2> -->
                                                <span class="text-sm font-bold mt-6">Mulai dari </span>
                                                <h2 class="font-semibold text-[26px] lg:text-[28px] text-center text-primary-100">
                                                    Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                </h2>
                                            </div>
                                        </div>
                                        <div class="my-6">
                                            <?php foreach (json_decode($po['service']) as $fas) : ?>
                                                <div class="flex justify-center">
                                                    <!-- <span></span> -->
                                                    <span class="leading-relaxed lg:text-base text-sm font-normal">
                                                        <i class="fa-solid fa-check-double text-secondary-100"></i>
                                                        <?= $fas->fasilitas ?>
                                                    </span>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                </div>
                            </a>

                        <?php endforeach; ?>
                    </div>
                <?php } else {
                    echo 'Mohon maaf, untuk saat ini tidak ada paket yang tersedia';
                } ?>
            </div>
            <a href="<?= base_url() ?>terbit" class="px-6 xl:px-12 py-2 xl:py-3 rounded-lg border lg:border-primaryBtn bg-primary-200 hover:bg-white text-white hover:text-primaryBtn" style="float: right;">Lihat selengkapnya ></a>
        </div>

    </div>
</div>


<!-- akhir saat yang tepat  -->

<!-- SLIDER  -->

<!-- SECTION TESTI START -->
<section id="testi" class="mt-6 my-container py-16">
    <div>
        <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
            Testimoni
        </div>
        <p class="font-bold text-xl md:text-2xl text-center mb-4">
            Bagaimana menurut mereka ?
        </p>
        <p class="text-center">
            Testimoni setelah menerbitkan buku di Penulis Cerdas Indonesia
        </p>
    </div>
    <!-- TAMPILAN WEB -->
    <div id="testi" class="slider">
        <div class="card-slider">

            <!-- CARD1 -->
            <div class="m-3 shadow-md rounded-[10px] p-3">
                <div class="w-full flex justify-center my-5">
                    <img class="rounded-full h-[114px] w-[114px] bg-primary-100" src="<?= base_url() ?>assets/assets/img/index/default.png" alt="Card image cap" />
                </div>
                <div class="flex justify-center">
                    <div class="flex items-center h-fit min-h-[140px]">
                        <div class="text-secondaryText text-sm font-normal flex flex-col items-center">
                            <h5 class="font-semibold text-primaryText">
                                Nama Lorem
                            </h5>
                            <p>Pekerjaan Lorem</p>
                            <!-- <a target="_blank" href="<?= $tr['linkedin'] ?>"><img class="my-9" src="<?= base_url(); ?>assets/assets/vector/linkedin.svg" alt="" /></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3 shadow-md rounded-[10px] p-3">
                <div class="w-full flex justify-center my-5">
                    <img class="rounded-full h-[114px] w-[114px] bg-primary-100" src="<?= base_url() ?>assets/assets/img/index/default.png" alt="Card image cap" />
                </div>
                <div class="flex justify-center">
                    <div class="flex items-center h-fit min-h-[140px]">
                        <div class="text-secondaryText text-sm font-normal flex flex-col items-center">
                            <h5 class="font-semibold text-primaryText">
                                Nama Lorem
                            </h5>
                            <p>Pekerjaan Lorem</p>
                            <p class="mt-1"><b class="text-xl">"</b> Lorem ipsum, dolor sit amet consectetur adipisicing elit. Magnam debitis delectus velit itaque laborum ea nihil aliquam impedit qui natus reprehenderit aperiam eos ratione, voluptatum magni, ducimus quam dolore dolorem?<b class="text-xl">"</b></p>
                            <!-- <a target="_blank" href="<?= $tr['linkedin'] ?>"><img class="my-9" src="<?= base_url(); ?>assets/assets/vector/linkedin.svg" alt="" /></a> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="m-3 shadow-md rounded-[10px] p-3">
                <div class="w-full flex justify-center my-5">
                    <img class="rounded-full h-[114px] w-[114px] bg-primary-100" src="<?= base_url() ?>assets/assets/img/index/default.png" alt="Card image cap" />
                </div>
                <div class="flex justify-center">
                    <div class="flex items-center h-fit min-h-[140px]">
                        <div class="text-secondaryText text-sm font-normal flex flex-col items-center">
                            <h5 class="font-semibold text-primaryText">
                                Nama Lorem
                            </h5>
                            <p>Pekerjaan Lorem</p>
                            <!-- <a target="_blank" href="<?= $tr['linkedin'] ?>"><img class="my-9" src="<?= base_url(); ?>assets/assets/vector/linkedin.svg" alt="" /></a> -->
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- SECTION TESTI END -->
<!-- Akhir Slider -->

<!-- SECTION MITRA START -->
<section id="mitra" class="mt-6 my-container py-16">
    <div>
        <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
            Kolaborator
        </div>
        <p class="font-bold text-xl md:text-2xl text-center mb-4">
            Mitra & Kolaborator kami
        </p>
        <p class="text-center">
            Beberapa mitra dan kolaborator dari Penulis Cerdas Indonesia
        </p>
    </div>
    <!-- TAMPILAN WEB -->
    <div id="mitra" class="slider">
        <div class="card-slider">

            <?php
            $arr = ['1.png', '2.png', '3.png', '4.png', '5.png', '6.png', '7.png', '8.png', '9.png', '10.png', '11.png', '12.png'];
            foreach ($arr as $a) : ?>
                <div class="m-3 shadow-md rounded-[10px] p-3">
                    <div class="w-full flex justify-center my-5">
                        <img class=" h-[90px] w-[90px] lg:w-[114px] lg:h-[114px] bg-white" src="<?= base_url() ?>assets/assets/mitra/<?= $a ?>" alt="Card image cap" />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- SECTION MITRA END -->

<!-- Frequently Asked Question -->
<div class="my-container flex flex-col lg:flex-col lg:flex-row items-center md:py-24 py-16 gap-6 lg:gap-24">
    <div class="flex flex-col text-center md:text-left items-center md:items-start gap-6 flex-grow lg:w-fit">
        <div class="justify-center md:flex flex-col items-center gap-6">

            <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
                Frequently Asked Questions
            </div>
            <span class="font-bold text-2xl text-center">Temukan jawaban dari pertanyaan anda</span>
            <p class="text-center">
                Pertanyaan yang sering ditanyakan
            </p>
        </div>
    </div>
    <div id="lpw" class="flex justify-center mt-0">
        <div class="container">
            <div class="justify-center flex flex-wrap w-full h-full px-0 lg:pl-0 py-0">
                <!-- gambar start -->
                <div class="w-full lg:w-2/5 scale-85 relative lg:scale-100">
                    <img class="scale-110" src="<?= base_url() ?>assets/assets/img/index/information.png" />
                </div>
                <!-- gambar end -->

                <div class="w-full lg:w-3/5 scale-85 lg:scale-100 font-body pl-[5%] lg:pr-[5%]">
                    <!-- collapse menu start -->
                    <div class="relative w-full overflow-hidden py-3">
                        <input type="checkbox" class="peer opacity-0 absolute top-0 w-full h-full z-10 cursor-pointer" />

                        <div class="h-fit w-full flex items-center pr-7 mb-2 lg:mb-5">
                            <h1 class="text-lg font-semibold text-black">
                                Bagaimana cara mengecek progress penerbitan buku ?
                            </h1>
                        </div>

                        <!-- arrow icons -->
                        <img src="<?= base_url() ?>assets/assets/img/index/panah.svg" alt="panah_collapse" class="absolute top-5 right-4 text-blue-900 transition-transform duration-500 rotate-0 peer-checked:rotate-180" />
                        <div class="mb-0 pb-0">
                            <img src="<?= base_url() ?>assets/assets/img/index/garis.svg" class="mb-0" />
                        </div>
                        <!-- content -->

                        <div class="overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-96">
                            <div class="py-[10px]">
                                <p>
                                    Cara nya sangat mudah, cukup mengecek di log aktivitas penerbitan untuk mengetahui progress atau kemajuan penerbitan buku anda.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- collapse menu end -->

                    <!-- collapse menu start -->
                    <div class="relative w-full overflow-hidden py-3">
                        <input type="checkbox" class="peer opacity-0 absolute top-0 w-full h-12 z-10 cursor-pointer" />

                        <div class="h-fit w-full flex items-center pr-7 mb-2 lg:mb-5">
                            <h1 class="text-lg font-semibold text-black">
                                Butuh waktu berapa lama untuk menerbitkan buku?
                            </h1>
                        </div>

                        <!-- arrow icons -->
                        <img src="<?= base_url() ?>assets/assets/img/index/panah.svg" alt="panah_collapse" class="absolute top-5 right-4 text-blue-900 transition-transform duration-500 rotate-0 peer-checked:rotate-180" />
                        <div class="mb-0 pb-0">
                            <img src="<?= base_url() ?>assets/assets/img/index/garis.svg" class="mb-0" />
                        </div>
                        <!-- content -->

                        <div class="overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-96">
                            <div class="py-[10px]">
                                <p>
                                    Penerbitan buku di layanan kami termasuk cepat kak, dengan proses penerbitan jangka waktu 2 minggu atau 14 hari.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- collapse menu end -->

                    <!-- collapse menu start -->
                    <div class="relative w-full overflow-hidden py-3">
                        <input type="checkbox" class="peer opacity-0 absolute top-0 w-full h-12 z-10 cursor-pointer" />

                        <div class="h-fit w-full flex items-center pr-7 mb-2 lg:mb-5">
                            <h1 class="text-lg font-semibold text-black">
                                Berapa biaya produksi menerbitkan buku?
                            </h1>
                        </div>

                        <!-- arrow icons -->
                        <img src="<?= base_url() ?>assets/assets/img/index/panah.svg" alt="panah_collapse" class="absolute top-5 right-4 text-blue-900 transition-transform duration-500 rotate-0 peer-checked:rotate-180" />
                        <div class="mb-0 pb-0">
                            <img src="<?= base_url() ?>assets/assets/img/index/garis.svg" class="mb-0" />
                        </div>
                        <!-- content -->

                        <div class="overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-96">
                            <div class="py-[10px]">
                                <p>
                                    Penulis bisa memilih sesuai dengan kantong atau bisa berkonsultasi dengan server pelayanan kami untuk menyesuaikan kebutuhan yang diinginkan. Untuk biaya produksi buku tergantung berapa jumlah halaman buku yang dimiliki pelanggan, desain cover, Layout, editing konten, proof reading. <br>
                                    Apabila jumlah buku halaman Anda melebihi <strong>100 halaman</strong> maka akan ditambahkan dengan penambahan biaya sesuai dengan halaman buku yang ingin anda terbitkan.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- collapse menu end -->

                    <!-- collapse menu start -->
                    <div class="relative w-full overflow-hidden py-3">
                        <input type="checkbox" class="peer opacity-0 absolute top-0 w-full h-12 z-10 cursor-pointer" />

                        <div class="h-fit w-full flex items-center pr-7 mb-2 lg:mb-5">
                            <h1 class="text-lg font-semibold text-black">
                                Apakah jasa penerbitan Penulisan Cerdas Indonesia bagian anggota IKAPI (Ikatan Penerbit Indonesia)?
                            </h1>
                        </div>

                        <!-- arrow icons -->
                        <img src="<?= base_url() ?>assets/assets/img/index/panah.svg" alt="panah_collapse" class="absolute top-5 right-4 text-blue-900 transition-transform duration-500 rotate-0 peer-checked:rotate-180" />
                        <div class="mb-0 pb-0">
                            <img src="<?= base_url() ?>assets/assets/img/index/garis.svg" class="mb-0" />
                        </div>
                        <!-- content -->

                        <div class="overflow-hidden transition-all duration-500 max-h-0 peer-checked:max-h-96">
                            <div class="py-[10px]">
                                <p>
                                    Secara resmi, kami telah menjadi anggota IKAPI sejak 2021 dengan kode anggota IKAPI No. 280/JTI/2021. Oleh karena itu, tidak diragukan lagi bahwa anda dapat menerbitkan buku bersama kami.
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- collapse menu end -->

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Akhir Frequently Asked Question -->

<!-- Ask More -->
<div id="kontak" class="my-container flex md:flex-row items-center md:pt-0 md:pb-24 pb-16 pt-0 gap-6 lg:gap-24">


    <div class="flex flex-col text-center md:text-left items-start md:items-start gap-6 flex-grow lg:w-1/3">
        <div class="md:flex flex-col items-start gap-6">
            <div class=" w-fit mb-6 md:mb-4 mx-auto rounded px-3 py-2 lg:py-1 text-sm" style="background-color: #ffdeae; color: #f59300;">
                Pertanyaan lain?
            </div>
            <p class="font-bold text-2xl">Masih ada pertanyaan lain?
            <p class="text-start">
                Klik tombol di bawah untuk menghubungi kami
            </p>
        </div>
        <div class="w-[206px] h-[45px] bg-primary-100 flex rounded-lg cursor-pointer">
            <div class="flex w-full items-center">
                <img src="<?= base_url() ?>assets/assets/img/index/wa.svg" class="w-1/4 h-[16px] -mr-2" />
                <button type="button" class="font-semibold text-white w-3/4 " id="tanya">
                    Pertanyaan lain ?
                </button>
            </div>
        </div>
    </div>

    <div class="hidden lg:block w-2/3">
        <img class="scale-75" src="<?= base_url() ?>assets/assets/img/index/cs_vector.jpg" />
    </div>
</div>
<!-- Akhir Ask More -->

<script src="<?= base_url('assets/js/index_slide.js'); ?>"></script>
<script>
    $(document).ready(function() {
        $('.text-home').addClass('text-secondary-100');
    });
    <?php
    if ($this->session->flashdata('sukses_daftar')) : ?>
        $(document).ready(function() {
            Swal.fire({
                // position: 'top-end',
                icon: 'success',
                title: " <?= $this->session->flashdata('sukses_daftar') ?>",
                showConfirmButton: false,
                timer: 2000,
            });
        });
    <?php endif; ?>

    //Get the button
    let mybutton = document.getElementById("btn-back-to-top");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 20 ||
            document.documentElement.scrollTop > 20
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }
    // When the user clicks on the button, scroll to the top of the document
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

    $('#wa').click(function(e) {
        e.preventDefault();
        var hp = "<?= $cs ?>";
        var textEncode = encodeURI(
            "Mau tanya nih min, ..."
        );
        window.location = `https://wa.me/${hp}?text=${textEncode}`;
    });
    $('#tanya').click(function(e) {
        e.preventDefault();
        var hp = "<?= $cs ?>";
        var textEncode = encodeURI(
            "Mau tanya nih min, ..."
        );
        window.location = `https://wa.me/${hp}?text=${textEncode}`;
    });
</script>