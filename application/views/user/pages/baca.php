<section class="flex justify-center pt-16 mb-20">
	<div class="container">

		<div class=" mt-10 ">
			<div class="md:flex px-12">
				<img src="<?= base_url('public/uploads/buku/' . $buku['fotobuku']); ?>" alt=" Gambar produk"
					class="  md:mx-8  mx-auto max-w-sm w-full  rounded-md">
				<div class="w-screen mb-16 xl:flex">
					<div>
						<h1 class="text-2xl font-bold text-slate-900 mb-10 ml-12 break-words mt-5 tracking-wide">
							<?= $buku['judul'] ?></h1>
						<div>
							<h2 class="ml-12 text-lg font-bold mb-4">Detail</h2>
						</div>
						<div class="flex ml-12 ">
							<div class="w-52">
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Jumlah Halaman</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['halaman'] ?></p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Tanggal Terbit</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['tanggal_terbit'] ?></p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">ISBN</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['isbn'] ?></p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Bahasa</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['bahasa'] ?></p>
								<a href="<?= $buku['flipbook']?>"
									class="mt-3 block text-center w-32 py-1 xl:py-1.5 rounded-lg border text-xs lg:border-primaryBtn bg-primary-200 hover:bg-white text-white hover:text-primaryBtn">Baca
									Sekarang</a>
							</div>
							<div class="w-52 ">
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Penerbit</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['penerbit'] ?></p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Berat</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['berat']?> g</p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Lebar</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['lebar'] ?> cm</p>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Panjang</p>
								<p class="text-slate-800 mb-4 text-base"><?= $buku['panjang'] ?> cm</p>
							</div>
						</div>
					</div>
					<div class="ml-12 xl:ml-1 mt-8 xl:mt-[92px]">
						<h2 class=" text-lg font-bold mb-4">Kontributor</h2>
						<div class=" md:w-1/3 ">
							<div class="w-52">
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Penulis</p>
								<ol class="mb-4">
									<?php $counter = 1; ?>
									<?php foreach($penulis as $pen) : ?>
									<li class="block text-slate-800 mb-0.5 text-base"><?= $counter ?>.
										<?= $pen['nama'] ?></li>
									<?php $counter++; ?>
									<?php endforeach; ?>
								</ol>


								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Editor</p>
								<ol class="mb-4">
									<?php $counter = 1; ?>
									<?php foreach($editor as $ed) : ?>
									<li class="block text-slate-800 mb-0.5 text-base"><?= $counter ?>.
										<?= $ed['nama'] ?></li>
									<?php $counter++; ?>
									<?php endforeach; ?>
								</ol>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Design Cover</p>
								<ol class="mb-4">
									<?php $counter = 1; ?>
									<?php foreach($designcover as $des) : ?>
									<li class="block text-slate-800 mb-0.5 text-base"><?= $counter ?>.
										<?= $des['nama'] ?></li>
									<?php $counter++; ?>
									<?php endforeach; ?>
								</ol>
								<p class="text-slate-800 mb-0.5 text-xs font-semibold">Layout</p>
								<ol class="mb-4">
									<?php $counter = 1; ?>
									<?php foreach($layout as $lay) : ?>
									<li class="block text-slate-800 mb-0.5 text-base"><?= $counter ?>.
										<?= $lay['nama'] ?></li>
									<?php $counter++; ?>
									<?php endforeach; ?>
								</ol>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="mt-6 xs:max-w-sm  p-12 md:mx-8  xl:max-w-none mx-auto ">
				<h2 class="text-lg font-bold text-slate-800 mb-2 break-words  ">Deskripsi Produk</h2>
				<p class="text-slate-800 mt-2 break-words text-justify "><?= $buku['deskripsi'] ?></p>
			</div>
		</div>
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
</script>