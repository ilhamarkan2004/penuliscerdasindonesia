<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900">
				<div class="p-8 rounded ">
					<h1 class="font-medium text-3xl">Edit Buku  <?= $existing_buku['judul']; ?></h1>
					<p class="text-gray-600 mt-6">Jika ingin merubah buku , maka isilah beberapa form di
						bawah ini</p>
					<form method="POST" action="<?= base_url('edit/'. $existing_buku['id']); ?>"
						enctype="multipart/form-data">
						  <input type="hidden" name="buku_id" value="<?= $existing_buku['id']; ?>">
						<div class="mt-8 grid lg:grid-cols-2 gap-4">
							<div> <label for="judul" class="text-sm text-gray-700 block mb-1 font-medium">Judul</label>
								<input type="text" name="judul" id="judul"
									class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
									placeholder="Judul Buku"
									value="<?= set_value('judul', $existing_buku['judul']); ?>" />
								<?= form_error('judul','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
							</div>

							<div> <label for="halaman" class="text-sm text-gray-700 block mb-1 font-medium">Jumlah
									Halaman</label> <input type="number" name="halaman" id="halaman" min="0"
									class="w-20 bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 "
									value="<?= set_value('halaman', $existing_buku['halaman']); ?>" />
								<?= form_error('halaman','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
							</div>
							<div> <label for="tanggal_terbit"
									class="text-sm text-gray-700 block mb-1 font-medium">Tanggal Penerbitan</label>
								<input type="date" name="tanggal_terbit" id="tanggal_terbit" min="0"
									class="w-64 bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 "
									value="<?= set_value('tanggal_terbit', $existing_buku['tanggal_terbit']); ?>" />
								<?= form_error('tanggal_terbit','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
							</div>
						</div>
						<div> <label for="bahasa"
								class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Bahasa</label>
							<select name="bahasa"
								class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
								aria-label="Default select example">
								<option class="font-bold ">Pilih Bahasa</option>
								<option value="Indonesia"
									<?= ($existing_buku['bahasa'] == 'Indonesia') ? 'selected' : ''; ?>>Indonesia
								</option>
								<option value="Inggris"
									<?= ($existing_buku['bahasa'] == 'Inggris') ? 'selected' : ''; ?>>Inggris</option>

							</select>
							<?= form_error('bahasa','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="penerbit"
								class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Penerbit</label>
							<select name="penerbit"
								class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
								aria-label="Default select example">
								<option class="font-bold ">Pilih Penerbit</option>
								<option value="CV. Penulis Cerdas Indonesia" <?= ($existing_buku['penerbit'] == 'CV. Penulis Cerdas Indonesia') ? 'selected' : ''; ?>>CV. Penulis Cerdas Indonesia</option>
							</select>
							<?= form_error('penerbit','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="flipbook" class="text-sm text-gray-700 block mb-1 mt-4 font-medium">URL Flipbook</label>
							<input type="text" name="flipbook" id="flipbook"
								class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
								placeholder="Url Flipbook" value="<?= set_value('flipbook', $existing_buku['flipbook']); ?>" />
							<?= form_error('flipbook','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="isbn" class="text-sm text-gray-700 block mb-1 mt-4 font-medium">ISBN</label>
							<input type="text" name="isbn" id="isbn"
								class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
								placeholder="Nomor ISBN" value="<?= set_value('isbn', $existing_buku['isbn']); ?>" />
							<?= form_error('isbn','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="berat" class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Berat</label>
							<input type="text" name="berat" id="berat"
								class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
								placeholder="Berat Buku" value="<?= set_value('berat', $existing_buku['berat']); ?>" />
							<?= form_error('berat','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="lebar" class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Lebar</label>
							<input type="text" name="lebar" id="lebar"
								class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
								placeholder="Lebar Buku" value="<?= set_value('lebar', $existing_buku['lebar']); ?>" />
							<?= form_error('lebar','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="panjang"
								class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Panjang</label>
							<input type="text" name="panjang" id="panjang"
								class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
								placeholder="Panjang Buku" value="<?= set_value('panjang', $existing_buku['panjang']); ?>" />
							<?= form_error('panjang','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div class="mt-8"> <label for="deskripsi"
								class="text-sm text-gray-700 block mb-1 font-medium">Deskripsi Buku</label>
							<textarea placeholder="Deskripsi Buku" name="deskripsi" id="deskripsi" cols="30" rows="10"
								class="w-full bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700"
								><?= set_value('deskripsi', $existing_buku['deskripsi']); ?></textarea>
							<?= form_error('deskripsi','<p class="text-red-500 mt-2 text-xs">', '</p>');?>

						</div>
						<div class="mt-8">
							<label for="fotobuku" class="text-sm text-gray-700 block mb-1 font-medium">Foto
								Buku</label>
							<input name="fotobuku" type="file"
								class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
							<?= form_error('fotobuku','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div class="space-x-4 mt-8"> <button type="submit"
								class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Save</button>
							<!-- Secondary --> <a href="<? base_url('') ?>"
								class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50">Cancel</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
