<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<!-- Modal Data Paket -->
<div class="modal fade" id="PaketModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelPaket">Tambah Paket</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formPaket">
                    <input type="hidden" class="form-control" name="ref_file_old" id="ref_file_old" value="">
                    <input type="hidden" class="form-control" name="iP" id="iP" value="">
                    <div>
                        <label for="">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama paket" aria-label="linkBukti" aria-describedby="basic-addon1">
                        <small class="text-danger" id="errName"></small>
                    </div>
                    <div>
                        <label for="">Jumlah Eksemplar <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="copy" name="copy" placeholder="Masukkan jumlah eksemplar" aria-label="linkBukti" aria-describedby="basic-addon1">
                        <small class="text-danger" id="errCopy"></small>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Status</label>
                        <select class="form-select form-control" name="status" id="status">
                            <option value="1">Aktif</option>
                            <option value="0">Non-aktif</option>
                        </select>
                        <span class="form-text text-danger" id="errStatus"></span>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="" class="btn btn-primary aksiPaket">Tambah</button>

            </div>
        </div>
    </div>
</div>

<!-- Modal data fasilitas -->
<div class="modal fade" id="FasilitasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelHarga">Pelayanan</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <div class="d-md-flex">
                        <div class="list-card w-100" id="fasilitas">
                            <h4 id="jdlList"></h4>
                            <form id="listFasilitas" method="POST" class="position-relative">


                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

            </div>
        </div>
    </div>
</div>


<link rel="stylesheet" href="<?= base_url('assets/css/slick.css'); ?>" />
<link rel="stylesheet" href="<?= base_url('assets/css/slick-theme.css'); ?>" />

<style>
    /* a {
        color: inherit;
        text-decoration: inherit;
    } */

    button {
        background: none;
        color: inherit;
        border: none;
        padding: 0;
        font: inherit;
        cursor: pointer;
        outline: inherit;
    }

    .w-fit {
        width: -moz-fit-content;
        width: fit-content;
    }

    .h-fit {
        height: -moz-fit-content;
        height: fit-content;
    }

    .m-5 {
        margin: 1.25rem;
    }

    .flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .items-center {
        align-items: center;
    }

    .justify-center {
        justify-content: center;
    }

    .text-center {
        text-align: center;
    }

    .border-b-2 {
        border-bottom-width: 2px;
    }

    .w-full {
        width: 100%;
    }

    .h-\[114px\] {
        height: 114px;
    }

    .w-\[114px\] {
        width: 114px;
    }

    .rounded-full {
        border-radius: 9999px;
    }
</style>


<!-- <div class="carousel slide relative container" data-bs-ride="static"> -->
<!-- <div class="action flex overflow-auto ">
        <a href="#" data-slide="1" class="w-fit h-fit m-5 border-b-2">Trainer</a>
        <a href="#" data-slide="2" class="w-fit h-fit m-5">Materi</a>
        <a href="#" data-slide="3" class="w-fit h-fit m-5">Kurikulum</a>
        <?php if ($user_group_id == 1) { ?>
            <a href="#" data-slide="4" class="w-fit h-fit m-5">Harga</a>
        <?php } ?>
    </div> -->
<!-- control end -->
<!-- <div class="slider slider-for relative w-full overflow-hidden"> -->


<!-- DataTables Harga -->
<?php if ($user_group_id == 1) { ?>
    <div class="w-full">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive" style="margin:10px;">
                <button style="float: left;" type="button" class="btn btn-primary" id="addPaket">
                    <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Pilihan Paket
                </button>
                <table class="table table-hover table-striped align-middle" id="paketTable" style="width: 100%;max-width:100%;">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Jumlah Eksemplar</th>
                            <th>Status</th>
                            <th>Pelayanan</th>
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
<?php } ?>

<!-- </div> -->
<!-- </div> -->


<script src="<?= base_url('assets/js/index.js'); ?>"></script>
<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/landingpage.js'); ?>"></script>
<script src="<?= base_url('assets/js/paket.js'); ?>"></script>