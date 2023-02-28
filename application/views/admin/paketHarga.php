<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- jika menggunakan bootstrap4 gunakan css ini  -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Modal Data Kertas -->
<div class="modal fade" id="KertasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelKertas">Tambah Jenis Kertas</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formKertas">
                    <input type="hidden" class="form-control" name="iK" id="iK" value="">
                    <input type="hidden" class="form-control" name="iP" id="iP" value="<?= $id_paket ?>">
                    <div>
                        <label for="">Nama Paket <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" disabled aria-describedby="basic-addon1" value="<?= $nama_paket ?>">
                        <small class="text-danger" id="errName"></small>
                    </div>

                    <div>
                        <label for="">Jumlah eksemplar<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="copy" name="copy" placeholder="Masukkan jumlah eksemplar">
                        <small class="text-danger" id="errCopy"></small>
                    </div>

                    <div>
                        <label for="">Harga Paket <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" aria-label="linkBukti" aria-describedby="basic-addon1">
                        <small class="text-danger" id="errPrice"></small>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="" class="btn btn-primary aksiHargaPaket">Tambah</button>

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
<!-- <div class="action flex overflow-auto "> -->
<!-- <a href="#" data-slide="1" class="w-fit h-fit m-5 border-b-2">Trainer</a>
        <a href="#" data-slide="2" class="w-fit h-fit m-5">Materi</a>
        <a href="#" data-slide="3" class="w-fit h-fit m-5">Kurikulum</a> -->
<!-- <?php if ($user_group_id == $idAdmin) { ?>
            <a href="#" data-slide="1" class="w-fit h-fit m-5">Harga</a>
        <?php } ?> -->
<!-- </div> -->
<!-- control end -->
<!-- <div class="slider slider-for relative w-full overflow-hidden"> -->


<!-- DataTables Harga -->
<?php if ($user_group_id == $idAdmin) { ?>
    <div class="w-full">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive" style="margin:10px;">
                <button style="float: left;" type="button" class="btn btn-primary" id="addKertas">
                    <i class="fa fa-lg fa-fw fa-plus" aria-hidden="true"></i>Tambah Pilihan Paket
                </button>
                <table class="table table-hover table-striped align-middle" id="kertasTable" style="width: 100%;max-width:100%;">
                    <thead class="">
                        <tr>
                            <th>No</th>
                            <th>Nama Paket</th>
                            <th>Jumlah eksemplar</th>
                            <th>Harga</th>
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

<!-- </div>
</div> -->

<script>
    $(document).ready(function() {
        $("#jenis_kertas").select2({
            dropdownParent: $("#KertasModal")
        });
    });
</script>

<script src="<?= base_url('assets/js/index.js'); ?>"></script>
<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/landingpage.js'); ?>"></script>
<script src="<?= base_url('assets/js/paket.js'); ?>"></script>

<script>
    $(document).ready(function() {
        table3 = $("#kertasTable").DataTable({
            responsive: true,
            ajax: `<?= base_url() ?>paket/getHargaPaket`,
            ajax: {
                'type': 'POST',
                'url': '<?= base_url() ?>paket/getHargaPaket',
                'data': {
                    id: '<?= $id_paket ?>',
                },
            },
            columns: [{
                    data: "no",
                },
                {
                    data: "name",
                },
                {
                    data: "copy",
                },
                {
                    data: "harga",
                },
                {
                    data: "action",
                },
            ],
        });

        $(document).off("click", "#addKertas");
        $(document).on("click", "#addKertas", function() {
            $("#errName").text("");
            $("#errPrice").text("");
            $("#errPaper").text("");
            $("#jdlModelKertas").text("Tambah Harga Baru");
            $(".aksiHargaPaket").text("Tambah");
            $("#iK").val("");
            $("#KertasModal").modal("show");
            $("#formKertas")[0].reset();
        });

        $(document).off("click", ".edtHargaPaket");
        $(document).on("click", ".edtHargaPaket", function() {
            $("#errName").text("");
            $("#errPrice").text("");
            $("#errPaper").text("");
            $("#formKertas")[0].reset();
            var id = $(this).attr("id");
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>paket/detailHargaPaket",
                data: {
                    id: id,
                },
                dataType: "JSON",
                success: function(data) {
                    $("#jdlModelKertas").text("Edit");
                    $(".aksiHargaPaket").text("Ubah");
                    var response = data.message;
                    $("#iK").val(response.id);
                    $("#copy").val(response.copy);
                    $("#price").val(response.harga);
                    $("#KertasModal").modal("show");
                },
            });
        });

        $(document).off("click", ".aksiHargaPaket");
        $(document).on("click", ".aksiHargaPaket", function() {
            $("#errName").text("");
            $("#errPrice").text("");
            $("#errPaper").text("");

            var data = $("#formKertas").serialize();
            console.log(data);
            $.ajax({
                type: "POST",
                url: "<?= base_url() ?>paket/aksiHargaPaket",
                data: data,
                dataType: "JSON",
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            // position: 'top-end',
                            icon: "success",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $("#kertasTable").DataTable().ajax.reload();
                        $("#KertasModal").modal("hide");
                    } else {
                        var error = response.message;
                        // console.log(error.kurikulum);
                        $("#errCopy").text(error.copy_error);
                        $("#errPrice").text(error.price_error);
                    }
                },
            });
        });

        $(document).off("click", ".delHargaPaket");
        $(document).on("click", ".delHargaPaket", function() {
            Swal.fire({
                title: "Data akan dihapus",
                text: "Apakah anda yakin?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus!",
                cancelButtonText: "Batal",
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        var data = $(this).attr("id");
                        $.ajax({
                            type: "POST",
                            data: {
                                id: data,
                            },
                            url: "<?= base_url() ?>paket/deleteHargaPaket",
                            dataType: "JSON",
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire({
                                        // position: 'top-end',
                                        icon: "success",
                                        text: response.message,
                                        showConfirmButton: false,
                                        timer: 2000,
                                    });
                                    $("#kertasTable").DataTable().ajax.reload();
                                }
                            },
                        });
                    }
                }
            });
        });
    });
</script>