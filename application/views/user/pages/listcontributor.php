<section class="flex justify-center pt-16 mb-20">
	<div class="container">

		<div class=" mt-10 ">
			<div class="flex flex-col overflow-x-auto">
				<div class="sm:-mx-6 lg:-mx-8">
					<div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
						<a href="<?= base_url('addkontributor') ?>"
							class="text-white w-full rounded-lg py-3 px-3 mt-4 bg-[#0e8f8f] text-xs hover:bg-white hover:text-[#0e8f8f] text-center">
							<i class="fas fa-plus-circle mr-2"></i> Tambah Kontributor
						</a>
						<div class="overflow-x-auto mt-5">
							<table class="min-w-full text-left text-sm font-light">
								<thead class="border-b font-medium dark:border-neutral-500">
									<tr>
										<th scope="col" class="px-6 py-4">#</th>
										<th scope="col" class="px-6 py-4">Nama Kontributor</th>
										<th scope="col" class="px-6 py-4">Kategori</th>
										<th scope="col" class="px-6 py-4">Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php $nomor_urut = 1;
                                    foreach($penulis as $pen) : ?>
									<tr class="border-b dark:border-neutral-500">
										<td class="whitespace-nowrap px-6 py-4 font-medium"><?= $nomor_urut ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $pen['nama'] ?></td>
										<td class="whitespace-nowrap px-6 py-4">Penulis</td>
										<td class="whitespace-nowrap px-6 py-4">
											<a href="<?= base_url('editcontributor/' . $pen['id']. '/penulis'); ?>"
												class="text-yellow-500 hover:underline mr-2">
												<i class="fas fa-edit"></i> Edit
											</a>
											<form action="<?= base_url('auth/deletecontributor'); ?>" method="POST"
												class="inline-block"
												onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontributor ini?');">
												<input type="hidden" name="buku_id" value="<?= $pen['id']; ?>">
												<input type="hidden" name="kategori" value="penulis">
												<button type="submit" class="text-red-500 hover:underline">
													<i class="fas fa-trash-alt"></i> Delete
												</button>
											</form>
										</td>
									</tr>
									<?php
                                    $nomor_urut++;
                                 endforeach; ?>

									<?php
                                    foreach($editor as $ed) : ?>
									<tr class="border-b dark:border-neutral-500">
										<td class="whitespace-nowrap px-6 py-4 font-medium"><?= $nomor_urut ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $ed['nama'] ?></td>
										<td class="whitespace-nowrap px-6 py-4">Editor</td>
										<td class="whitespace-nowrap px-6 py-4">
											<a href="<?= base_url('editcontributor/' . $ed['id']. '/editor'); ?>"
												class="text-yellow-500 hover:underline mr-2">
												<i class="fas fa-edit"></i> Edit
											</a>
											<form action="<?= base_url('auth/deletecontributor'); ?>" method="POST"
												class="inline-block"
												onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontributor ini?');">
												<input type="hidden" name="buku_id" value="<?= $ed['id']; ?>">
												<input type="hidden" name="kategori" value="editor">
												<button type="submit" class="text-red-500 hover:underline">
													<i class="fas fa-trash-alt"></i> Delete
												</button>
											</form>
										</td>
									</tr>
									<?php
                                    $nomor_urut++;
                                 endforeach; ?>

									<?php
                                    foreach($designcover as $des) : ?>
									<tr class="border-b dark:border-neutral-500">
										<td class="whitespace-nowrap px-6 py-4 font-medium"><?= $nomor_urut ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $des['nama'] ?></td>
										<td class="whitespace-nowrap px-6 py-4">Design Cover</td>
										<td class="whitespace-nowrap px-6 py-4">
											<a href="<?= base_url('editcontributor/' . $des['id']. '/designcover'); ?>"
												class="text-yellow-500 hover:underline mr-2">
												<i class="fas fa-edit"></i> Edit
											</a>
											<form action="<?= base_url('auth/deletecontributor'); ?>" method="POST"
												class="inline-block"
												onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontributor ini?');">
												<input type="hidden" name="buku_id" value="<?= $des['id']; ?>">
												<input type="hidden" name="kategori" value="designcover">
												<button type="submit" class="text-red-500 hover:underline">
													<i class="fas fa-trash-alt"></i> Delete
												</button>
											</form>
										</td>
									</tr>
									<?php
                                    $nomor_urut++;
                                 endforeach; ?>
									<?php
                                    foreach($layout as $lay) : ?>
									<tr class="border-b dark:border-neutral-500">
										<td class="whitespace-nowrap px-6 py-4 font-medium"><?= $nomor_urut ?></td>
										<td class="whitespace-nowrap px-6 py-4"><?= $lay['nama'] ?></td>
										<td class="whitespace-nowrap px-6 py-4">Layout</td>
										<td class="whitespace-nowrap px-6 py-4">
											<a href="<?= base_url('editcontributor/' . $lay['id']. '/layout'); ?>"
												class="text-yellow-500 hover:underline mr-2">
												<i class="fas fa-edit"></i> Edit
											</a>
											<form action="<?= base_url('auth/deletecontributor'); ?>" method="POST"
												class="inline-block"
												onsubmit="return confirm('Apakah Anda yakin ingin menghapus kontributor ini?');">
												<input type="hidden" name="buku_id" value="<?= $lay['id']; ?>">
												<input type="hidden" name="kategori" value="layout">
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
