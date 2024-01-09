<section class="flex justify-center pt-16 mb-20">
	<div class="container">

		<div class=" mt-10 ">
			<div class="flex flex-col overflow-x-auto">
				<div class="sm:-mx-6 lg:-mx-8">
					<div class="inline-block min-w-full py-2 sm:px-6 lg:px-8 mt-10">
						<?php if ($this->session->flashdata('message')): ?>
						<?= $this->session->flashdata('message') ?>
						<?php endif; ?>
						<a href="<?= base_url('addkatalog') ?>"
							class="text-white w-full rounded-lg py-3 px-3 mt-4 bg-[#0e8f8f] text-xs hover:bg-white hover:text-[#0e8f8f] text-center">
							<i class="fas fa-plus-circle mr-2"></i> Tambah Buku
						</a>
						<div class="overflow-x-auto mt-5">
							<table class="min-w-full text-left text-sm font-light">
								<thead class="border-b font-medium dark:border-neutral-500">
									<tr>
										<th scope="col" class="px-6 py-4">#</th>
										<th scope="col" class="px-6 py-4">Gambar</th>
										<th scope="col" class="px-6 py-4">Judul</th>
										<th scope="col" class="px-6 py-4">Halaman</th>
										<th scope="col" class="px-6 py-4">Penerbit</th>
										<th scope="col" class="px-6 py-4">Tanggal Terbit</th>
										<th scope="col" class="px-6 py-4">ISBN</th>
										<th scope="col" class="px-6 py-4">Bahasa</th>
										<th scope="col" class="px-6 py-4">Berat</th>
										<th scope="col" class="px-6 py-4">Lebar</th>
										<th scope="col" class="px-6 py-4">Panjang</th>
										<th scope="col" class="px-6 py-4">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor_urut = 1;
                                    foreach($buku as $b) : ?>
									<tr class="border-b dark:border-neutral-500">
										<td class="whitespace-nowrap px-6 py-4 font-medium"><?= $nomor_urut ?></td>
										<td class="whitespace-nowrap px-6 py-4"><img
												class="overflow-hidden h-24 w-full object-cover object-center"
												src="<?= base_url('public/uploads/buku/' . $b['fotobuku']); ?>"
												alt="product image" />
										</td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['judul'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['halaman'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['penerbit'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['tanggal_terbit'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['isbn'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['bahasa'] ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['berat'] ?>g</td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['lebar'] ?>cm</td>
										<td class="whitespace-nowrap px-6 py-4"><?= $b['panjang'] ?>cm</td>
										<td class="whitespace-nowrap px-6 py-4">
											<a href="<?= base_url('view/' . $b['id']); ?>"
												class="text-blue-500 hover:underline mr-2">
												<i class="fas fa-eye"></i> View
											</a>
											<a href="<?= base_url('edit/' . $b['id']); ?>"
												class="text-yellow-500 hover:underline mr-2">
												<i class="fas fa-edit"></i> Edit
											</a>
											<form action="<?= base_url('auth/delete'); ?>" method="POST"
												class="inline-block"
												onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
												<input type="hidden" name="buku_id" value="<?= $b['id']; ?>">
												<button type="submit" class="text-red-500 hover:underline">
													<i class="fas fa-trash-alt"></i> Delete
												</button>
											</form>
										</td>
									</tr>
									<?php
                                    $nomor_urut++;
                                 endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
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
