<div class="py-12">
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
			<div class="p-6 text-gray-900">
				<div class="p-8 rounded ">
					<?= $this->session->flashdata('message');?>
					<h1 class="font-medium text-3xl">Tambah Kontributor</h1>
					<p class="text-gray-600 mt-6">Jika ingin menambahkan kontributor baru, maka isilah beberapa form di
						bawah ini</p>
					<form method="POST" action="<?= base_url('auth/addkontributor'); ?>" enctype="multipart/form-data">
						<div class="mt-8 grid lg:grid-cols-2 gap-4">
							<div> <label for="nama" class="text-sm text-gray-700 block mb-1 font-medium">Nama Kontributor</label>
								<input type="text" name="nama" id="nama"
									class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
									placeholder="Nama Kontributor" value="<?= set_value('nama');?>" />
								<?= form_error('nama','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
							</div>
						</div>
						<div> <label for="kontributor"
								class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Kontributor</label>
							<select name="kontributor"
								class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
								aria-label="Default select example">
								<option class="font-bold ">Pilih Kontributor</option>
								<option value="penulis">Penulis</option>
								<option value="editor">Editor</option>
								<option value="designcover">Design Cover</option>
								<option value="layout">Layout</option>
							</select>
							<?= form_error('bahasa','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
						</div>
						<div> <label for="buku_id"
								class="text-sm text-gray-700 block mb-1 mt-4 font-medium">Buku</label>
							<select name="buku_id"
								class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700  bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
								aria-label="Default select example">
								<option class="font-bold ">Pilih Buku</option>
								<?php foreach($buku as $b) : ?>
								<option value="<?= $b['id'] ?>"><?= $b['judul'] ?></option>
								<?php endforeach; ?>
							</select>
							<?= form_error('bahasa','<p class="text-red-500 mt-2 text-xs">', '</p>');?>
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