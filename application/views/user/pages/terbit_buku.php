<section class="flex justify-center">
    <div class="container">
        <div class="title px-20 max-w-[1400px] text-center my-6 py-6 lg:py-0 mx-auto">
            <?= ($this->session->has_userdata('id_user')) ? '' : '<div class=" w-full flex justify-center"> <p class="rounded-lg bg-red-500 font-bold text-white p-4 my-4 w-fit">Maaf saat ini anda belum bisa mengisi form penerbitan buku, <a class="underline" href="' . site_url('auth') . '">LOGIN</a> terlebih dahulu untuk menerbitkan buku anda</p></div>'; ?>
            <h2 class="judul-3 text-[18px] text-[#1089C0] font-bold">Pilih Paket Yang Tersedia</h2>
            <p class="judul-4 text-[14px] ">Pilih paket yang sesuai minat anda.</p>
        </div>

        <div class="container mx-auto">
            <div class="flex justify-center flex-wrap">
                <?php if (!empty($paket)) { ?>
                    <div class="flex flex-wrap justify-center lg:justify-start">
                        <?php foreach ($paket as $po) : ?>

                            <!-- ITEM 2 -->
                            <div class="min-w-[260px]">
                                <div class="shadow-md rounded-md px-6 pb-6 bg-white my-3 mx-2">
                                    <div class="border-b-2 border-[#F5F5F5];">
                                        <h1 class="pt-[30px] text-center font-semibold text-xl lg:text-[24px]">
                                            <?php echo $po['paket_name'] ?>
                                        </h1>
                                        <div class="flex items-center flex-col">
                                            <img src="<?= base_url(); ?>assets/assets/vector/group.svg" class="my-[16px]" />
                                        </div>
                                        <div class="flex items-center flex-col">
                                            <h2 class="text-secondaryTextBlue font-semibold text-base lg:text-[18px] text-center">
                                                <?php echo $po['copy_num'] ?> eksemplar
                                            </h2>

                                            <!-- <h2 class="my-[4px] text-[#939393] line-through text-lg lg:text-xl font-normal">
                                                                Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                                            </h2> -->
                                            <span class="text-sm font-bold mt-6">Mulai dari </span>
                                            <h2 class="font-semibold text-[26px] lg:text-[28px] text-center">
                                                Rp. <?= number_format($po['harga'], 0, '', '.'); ?>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="my-6">
                                        <?php foreach (json_decode($po['service']) as $fas) : ?>
                                            <div class="flex">
                                                <img src="<?= base_url() ?>assets/assets/vector/check-circle.svg" class="mx-3" />
                                                <p class="leading-relaxed lg:text-base text-sm font-normal">
                                                    <?= $fas->fasilitas ?>
                                                </p>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="flex justify-center relative h-11 top-[-38px]">
                                    <form action="<?= base_url('form') ?>" method="post" class="w-fit">
                                        <input class="absolute" style="visibility:hidden ;" name="id_paket" size="1" type="text" value="<?= $po['paket_id'] ?>">
                                        <button id="daftarSekarang" type="submit" class="block font-semibold text-[16px] text-white px-11 py-3 bg-primaryBtn rounded-lg" style="background-color: <?= ($this->session->has_userdata('id_user')) ? 'orange' : 'grey'; ?>;" <?= ($this->session->has_userdata('id_user')) ? '' : 'disabled'; ?>>
                                            Terbitkan Sekarang
                                        </button>
                                    </form>

                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php } else {
                    echo 'Mohon maaf, untuk saat ini tidak ada paket yang tersedia';
                } ?>
            </div>
        </div>

        <div class="my-container mt-20 flex md:flex-row items-center md:pt-0 md:pb-24 pb-16 pt-0 gap-6 lg:gap-24">
            <div class="">
                <div class="flex md:hidden flex-col items-start gap-6">
                    <div class="text-[#036ADF] bg-[#A3CEFF] rounded px-3 py-2 lg:py-1 text-sm font-semibold">
                        Ask More
                    </div>
                    <p class="font-bold text-2xl">
                        Masih ada <br />pertanyaan lain?<br />
                    </p>
                    <div></div>
                </div>

                <div class="flex flex-col text-center md:text-left items-start md:items-start gap-6 flex-grow lg:w-2/3">
                    <div class="hidden md:flex flex-col items-start gap-6">
                        <div class="text-[#036ADF] bg-[#A3CEFF] rounded px-3 py-2 lg:py-1 text-sm font-semibold">
                            Ask More
                        </div>
                        <p class="font-bold text-2xl">Masih ada <br />pertanyaan lain?</p>
                    </div>
                    <p class="text-start">
                        Klik tombol di bawah untuk konsultasi lebih lanjut dengan Tim kami
                    </p>
                    <div class="w-[206px] h-[45px] bg-[#1089C0] flex rounded-lg cursor-pointer">
                        <div class="flex w-full items-center">
                            <img src="<?= base_url() ?>assets/assets/img/index/wa.svg" class="w-1/4 h-[16px] -mr-2" />
                            <button type="button" class="font-semibold text-white w-3/4" id="tanya">
                                Tanya lebih lanjut
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hidden lg:block">
                <img src="<?= base_url() ?>assets/assets/img/index/bola2.svg" />
            </div>
        </div>
    </div>
</section>