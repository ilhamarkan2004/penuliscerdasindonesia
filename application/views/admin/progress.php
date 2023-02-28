<style>
    .sideNav {
        right: -90%;
        transition: 0.3s;
        padding: 15px;
        text-decoration: none;
        border-radius: 5px 0px 0px 5px;
    }

    .sideNav:hover {
        right: -25px;
    }

    @media (min-width: 768px) {
        .lg-oke {
            display: block;
        }
    }
</style>
<div class="d-flex">
    <div class="container d-flex justify-content-between pl-3">
        <div id="listBuku" class="p-3 w-100"></div>

    </div>
    <div id="sideNavDiv" class="sticky-top end-2 lg-oke " style="display: none;">
        <div id="" class=" w-auto">
            <div id="sideNav" class="sideNav card d-grid gap-3 w-auto">
                <div class="w-auto">
                    <span class="badge text-bg-danger">&ensp;</span>
                    <span class="">Tahapan bermasalah</span>
                </div>
                <div class="">
                    <span class="badge text-bg-warning">&ensp;</span>
                    <span class="">Tahapan tertunda</span>
                </div>
                <div class="">
                    <span class="badge text-bg-success">&ensp;</span>
                    <span class="">Tahapan sedang berjalan</span>
                </div>

            </div>
        </div>
    </div>
</div>



<style>
    .timelinee {
        list-style-type: none;
        display: block;
        /* align-items: center; */
        justify-content: center;
        left: 0px;
    }

    .li {
        transition: all 200ms ease-in;
    }

    .status {
        padding: 0px 30px;
        display: flex;
        justify-content: center;
        position: relative;
        transition: all 200ms ease-in;
    }

    .status p {
        font-weight: 600;
    }

    .status:before {
        content: '';
        width: 25px;
        height: 25px;
        background-color: white;
        border-radius: 25px;
        border: 1px solid #ddd;
        position: absolute;
        left: 0px;
        top: 0px;
        bottom: auto;
        align-items: center;
        justify-content: center;
        transition: all 200ms ease-in;
    }

    /* .li.complete .status {
        border-top: 2px solid #66DC71;
    } */

    .li.complete .status:before {
        background-color: #66DC71;
        border: none;
        transition: all 200ms ease-in;
    }

    .li.complete .status p {
        color: #66DC71;

    }

    @media (min-device-width: 320px) and (max-device-width: 700px) {


        .li {
            transition: all 200ms ease-in;
            display: flex;
            width: inherit;
        }


        .status:before {

            transition: all 200ms ease-in;
        }


    }

    @media (min-width: 768px) {
        .lg-timelinee {
            list-style-type: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .lg-sideNavDiv {
            display: block;
        }
    }
</style>


<script>
    $(document).ready(function() {
        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>progress/getBooks",
            // data: "data",
            dataType: "json",
            success: function(response) {
                var data = response.message;
                // console.log(data);
                $.each(data, function(index, value) {
                    // console.log()
                    var cover = value.cover;
                    var isbn = value.isbn;
                    var note_admin = value.note_admin;
                    if (cover == '') {
                        cover = 'assets/assets/default/preview_cover.jpg';
                    }
                    if (isbn == null) {
                        isbn = '-';
                    }
                    if (note_admin == null) {
                        note_admin = '';
                    }
                    $("#listBuku").append(`
                    <div class="card mb-3 m-3" >
                        <div class="row g-0 card-body shadow relative" >
                            <div class="col-md-4">
                                <img src="<?= base_url() ?>${cover}" class="img-fluid rounded-start" style="max-height: 250px;" alt="...">
                            </div>
                            <div class="col-md-7 ms-3 position-relative">
                                <button class="badge text-bg-${statusColor(value.status_progres)} text-white position-absolute top-0 end-0 border border-0">${value.status}</button>
                                <div class="">
                                    <h5 class="card-title">${value.title}</h5>
                                    <p class="card-text"><b>ISBN : </b>${isbn}</p>
                                    <p class="card-text mt-4"><small class="text-muted" style="font-style: italic">${note_admin}</small></p>
                                </div>
                                ${showButtonEdit(value.contributor_role_id,<?= $idPJ ?>, value.id_b, value.status_progres)}
                                <button class="btn btn-dark float-end" id="progress" id_book="${value.book_id}">Progress</button>
                            </div>
                        </div>
                        <div class="shadow p-3 rounded mt-5" style="display:none;" id="progress${value.book_id}">
                            <ul class="timelinee lg-timelinee">
                                <?php foreach ($steps as $step) : ?>
                                <li id='step<?= $step['id'] ?>' class="li ${textComplete(<?= $step['id'] ?>, value.progress_id)}">
                                    <div class="status">
                                        <p> <?= $step['status'] ?> </p>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>`);



                });
            }
        });

        $("#progress").off("click");
        $(document).on("click", "#progress", function(e) {
            e.preventDefault();
            var id_book = $(this).attr('id_book');
            $(`#progress${id_book}`).fadeToggle();
        });
    });

    function textComplete(step_id, progress_id) {
        if (progress_id - 1 >= step_id) {
            return 'complete';
        } else if (progress_id == <?= $lastProgress ?>) {
            return 'complete';
        } else {
            return '';
        }
    }

    function statusColor(status) {
        if (status == 0) {
            return 'danger';
        } else if (status == 1) {
            return 'warning';
        } else if (status == 2) {
            return 'success';
        } else {
            return 'secondary'
        }
    }

    function showButtonEdit(contributor_id, role, id_b, status_progress) {
        if (contributor_id == role && status_progress != <?= $success ?>) {
            return `<form action="<?= base_url() . 'progress/editBuku' ?>" method="post">
                                    <button type="submit" class="btn btn-dark" name="id" value="${id_b}"></button>
                                </form>`;
        } else {
            return '';
        }
    }
</script>