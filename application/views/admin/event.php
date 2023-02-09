<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> -->
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->

<!-- Modal Data Event -->
<div class="modal fade" id="EventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelEvent">Tambah Event</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" id="formEvent" enctype="multipart/form-data" method="POST">
                    <div class="modal-body">

                        <!-- <input type="hidden" name="id_pel" id=""> -->
                        <input type="hidden" name="iE" id="iE">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Acara</label>
                            <input type="text" class="form-control" name='event_name' id="event_name" placeholder="">
                            <small id="name_err" class="text-danger"></small>
                        </div>
                        <!-- <input type="hidden" name="id_kat" id=""> -->
                        <div class="form-group">
                            <div><label>Tipe Acara</label></div>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/book.svg" alt=""></span>
                                <select class="form-select form-control" name="event_type" id="event_type">
                                    <option value="">--pilih--</option>
                                    <?php foreach ($event as $k) : ?>
                                        <option value="<?= $k['id'] ?>"><?= $k['name_type'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <small id="type_err" class="text-danger"></small>
                        </div>


                        <div class="form-group">
                            <div class="row align-items-start">
                                <div class="col">
                                    <label for="">Tanggal Mulai Pendaftaran</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                                        <input class="form-control" type="date" name="start_regist" id="start_regist" value="<?php echo date("Y-m-d"); ?>">
                                        <small id="start_err" class="text-danger"></small>
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">Tanggal Berakhir Pendaftaran</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/timer1.svg" alt=""></span>
                                        <input class="form-control" type="date" name="end_regist" id="end_regist">
                                        <small id="end_err" class="text-danger"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-6">
                            <label for="">Status</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text"><img src="<?= base_url() ?>assets/assets/vector/activity.svg" alt=""></span>
                                <select class="form-select form-control" name="status" id="status">
                                    <option value="1">Aktif</option>
                                    <option value="0">Tidak Aktif</option>
                                </select>
                                <small id="status_err" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
                            <small id="desc_err" class="text-danger"></small>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Link pendaftaran</label>
                            <input type="text" class="form-control" name='link' id="link" placeholder="">
                            <small id="link_err" class="text-danger"></small>
                        </div>


                        <label for="gambar">Gambar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="img" id="img" accept=".jpg, .jpeg, .png">
                            <label class="custom-file-label" for="customFile"></label>
                        </div>
                        <small id="img_error" class="text-danger"></small>

                        <input type="hidden" class="custom-file-input" name="img_old" id="img_old" value="">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" id="" class="btn btn-primary aksiEvent">Tambah</button>

                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

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


<!-- DataTables Harga -->
<?php if ($user_group_id == 1) { ?>
    <div class="w-full">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive" style="margin:10px;">
                <button style="float: left;" type="button" class="btn btn-primary" id="addEvent">
                    <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Pilihan Event
                </button>
                <table class="table table-hover table-striped align-middle" id="eventTable" style="width: 100%;max-width:100%;">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Jenis</th>
                            <th>Nama</th>
                            <th>Deskripsi</th>
                            <th>Tanggal pendaftaran</th>
                            <th>Status</th>
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
<script src="<?= base_url('assets/js/event.js'); ?>"></script>