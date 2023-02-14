<!-- Modal Data Sell -->
<div class="modal fade" id="SellModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelSell">Tambah Penjualan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="formSell" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="iS" id="iS">
                        <div class="form-group">
                            <div><label>Buku yang akan terbit</label></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-book"></i></span>
                                <select class="form-select form-control" name="book" id="book">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($buku as $k) : ?>
                                        <option value="<?= $k['id_b'] ?>"><?= $k['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="book_err" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <div><label>Kategori buku</label></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"></span>
                                <select class="form-select form-control" name="category" id="category">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($category as $k) : ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="category_err" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <div><label>Bahasa</label></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-flag"></i></span>
                                <select class="form-select form-control" name="lang" id="lang">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($language as $k) : ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['language'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="lang_err" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <div><label>Publisher</label></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><i class="fa-solid fa-building"></i></span>
                                <select class="form-select form-control" name="pub" id="pub">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($publisher as $k) : ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['publisher'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="pub_err" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Jumlah Halaman</label>
                            <input type="number" class="form-control" name='num_page' id="num_page" placeholder="">
                            <small id="num_page_err" class="text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Price</label>
                            <input type="number" class="form-control" name='price' id="price" placeholder="">
                            <small id="price_err" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="" class="btn btn-primary aksiSell">Tambah</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<div class="w-full">
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive" style="margin:10px;">
            <button style="float: left;" type="button" class="btn btn-primary" id="addSell">
                <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Jual Buku
            </button>
            <table class="table table-hover table-striped align-middle" id="sellTable" style="width: 100%;max-width:100%;">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Nama Buku</th>
                        <th>Penerbit</th>
                        <th>Harga Jual</th>
                        <th>Tanggal Publish</th>
                        <th>Tanggal Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbl_data">

                </tbody>
            </table>
            <!-- Paginate -->
            <div class="pagination"></div>
        </div>
    </div>
</div>



<script src="<?= base_url('assets/js/sell.js'); ?>"></script>