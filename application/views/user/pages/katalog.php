<section class="flex justify-center pt-16 mb-20">
    <div class="container">
        <div class="title px-20 max-w-[1400px] text-center my-6 py-6 lg:py-0 mx-auto">
            <h2 class="text-2xl text-[18px] text-slate-800 font-bold">Katalog Buku</h2>
            <p class="judul-4 text-[14px] ">Lorem ipsum dolor sit amet.</p>
        </div>

        <?php if (empty($buku)) : ?>
            <p class=" mt-14 text-center text-slate-800 text-sm font-semibold">Buku belum tersedia.</p>
        <?php else : ?>
            <div class="flex flex-wrap gap-2 lg:gap-5 xl:gap-10 justify-center ">
                <?php foreach($buku as $b) : ?>
                    <!-- CARD -->
                    <div class="w-[175px] lg:w-72 xl:w-90 border-slate-100 bg-transparent xl:rounded-xl shadow-lg shadow-slate-700 overflow-x-hidden">
                        <a class="mb-2 p-5 flex" href="">
                            <img class="overflow-hidden h-80 w-full object-cover object-center" src="<?= base_url('public/uploads/buku/' . $b['fotobuku']); ?>" alt="product image" />
                        </a>
                        <div class="px-5 pb-5">
                            <div class="">
                                <p class="text-base text-slate-900 font-semibold text-center mb-1"><?= $b['judul'] ?></p>
                                <p class="text-xs text-slate-800 text-center mb-2">ISBN : <?= $b['isbn']?></p>
                                <a href="<?= base_url('pci/baca/') . $b['id']?>" class="block text-center py-1 xl:py-1.5 rounded-lg border lg:border-primaryBtn bg-primary-200 hover:bg-white text-white hover:text-primaryBtn">
                                    Baca
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<script>
	$('#tanya').click(function (e) {
		e.preventDefault();
		var hp = "<?= $cs ?>";
		var textEncode = encodeURI(
			"Mau tanya nih min, ..."
		);
		window.location = `https://wa.me/${hp}?text=${textEncode}`;
	});
	const cardText = document.getElementById('card-text');
	const cardTextContent = cardText.textContent;
	const maxLength = 40; // Jumlah karakter maksimal sebelum perubahan

	if (cardTextContent.length > maxLength) {
		cardText.innerHTML = cardTextContent.slice(0, maxLength) + '...';
	}
</script>