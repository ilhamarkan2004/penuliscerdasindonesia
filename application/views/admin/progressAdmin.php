<!-- Modal Data Progress -->
<div class="modal fade" id="ProgressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelProgress">Edit Progress</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formProgress">
                    <input type="hidden" class="form-control" name="iB" id="iB" value="">

                    <div class="form-group">
                        <label for="exampleInputPassword1">Progress</label>
                        <select class="form-select form-control" name="progress" id="progress">
                            <?php foreach ($steps as $p) : ?>
                                <option value="<?= $p['id'] ?>"><?= $p['status'] ?></option>
                            <?php endforeach; ?>
                        </select>
                        <span class="form-text text-danger" id="errPaper"></span>
                    </div>

                    <label for="">Status Progress</label>
                    <div class="row">
                        <fieldset id="group1" class="row">
                            <div class="col-3 align-middle">
                                <input type="radio" id="2" name="status_code" class="w-25" value="2" style="accent-color: green;">
                                <label class="text-success mr-3" for="2">Accepted</label>
                            </div>
                            <div class="col-3">

                                <input type="radio" id="1" name="status_code" class="w-25" value="1" style="accent-color: yellow;">
                                <label class="text-warning mr-3" for="1">Pending</label>
                            </div>
                            <div class="col-3">
                                <input type="radio" id="0" name="status_code" class="w-25" value="0" style="accent-color: red;">
                                <label class="text-danger" for="0">Declined</label>
                            </div>
                        </fieldset>

                    </div>


                    <div class="form-group">
                        <label for="catatan">Catatan</label>
                        <textarea class="form-control" name="catatan" id="catatan" rows="3"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="button" id="" class="btn btn-primary aksiProgress">Tambah</button>

            </div>
        </div>
    </div>
</div>
<!-- Modal Data Cover -->
<div class="modal fade" id="ProgressCoverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jdlModelProgressCover">Cover</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formProgressCover" enctype="multipart/form-data">
                    <label class="form-label">Cover / gambaran cover saat ini</label>
                    <div class="d-flex justify-content-center">
                        <img id="prevCover" src="<?= base_url('assets/assets/default/preview_cover.jpg') ?>" class="card" style="height: 15rem; width: 9rem;" alt="...">
                    </div>
                    <input type="hidden" class="form-control" name="iB2" id="iB2" value="">

                    <div class="mb-3">
                        <label class="form-label">Catatan dari user</label>
                        <p id="catatCover"></p>
                    </div>
                    <div class="mb-3">
                        <label for="formFile" class="form-label">Update Cover</label>
                        <input class="form-control" type="file" id="cover" name="cover">
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" id="" class="btn btn-primary aksiProgressCover">Tambah</button>

            </div>
            </form>
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


<!-- DataTables Harga -->
<?php if ($user_group_id == 1) { ?>
    <div class="w-full">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive" style="margin:10px;">
                <table class="table table-hover table-striped align-middle" id="progressTable" style="width: 100%;max-width:100%;">
                    <thead class="">
                        <tr>
                            <th>Judul Buku</th>
                            <th>Progress</th>
                            <th>Naskah</th>
                            <th>Cover</th>
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



<script src="<?= base_url('assets/js/index.js'); ?>"></script>
<script src="<?= base_url('assets/js/slick.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/landingpage.js'); ?>"></script>
<script src="<?= base_url('assets/js/progress.js'); ?>"></script>

<script>
    $(document).off("click", ".edtProgressCover");
    $(document).on("click", ".edtProgressCover", function() {
        var id = $(this).attr("id");
        $("#formProgressCover")[0].reset();
        $.ajax({
            type: "post",
            url: "<?= base_url() ?>progress/detailBook",
            data: {
                id: id,
            },
            dataType: "JSON",
            success: function(data) {
                $("#jdlModelProgressCover").text("Ubah Cover");
                $(".aksiProgressCover").text("Ubah");
                var response = data.message;
                $("#iB2").val(response.id_b);
                $("#catatCover").text(response.note_cover);
                if (response.cover == '') {
                    var prevCover = '<?= base_url('assets/assets/default/preview_cover.jpg') ?>';
                } else {
                    var prevCover = response.prevCover;
                }
                $("#prevCover").attr("src", prevCover);
                $("#ProgressCoverModal").modal("show");
            },
        });
    });
</script>