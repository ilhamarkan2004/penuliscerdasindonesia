<style>
    .blok {
        width: 71%;
        height: 12px;
        background-color: #6BD1FF;
        z-index: -1;
        left: 0px;
        right: 0px;
        top: 31px;
        margin: auto;
    }

    img {
        width: 855px;
    }

    .alert {
        position: relative;
        top: 10;
        left: 0;
        width: auto;
        height: auto;
        padding: 10px;
        margin: 10px;
        line-height: 1.8;
        border-radius: 5px;
        cursor: hand;
        cursor: pointer;
        font-family: sans-serif;
        font-weight: 400;
    }

    .alertCheckbox {
        display: none;
    }

    :checked+.alert {
        display: none;
    }

    .alertText {
        display: table;
        margin: 0 auto;
        text-align: center;
        font-size: 16px;
    }

    .alertClose {
        float: right;
        padding-top: 5px;
        font-size: 10px;
    }

    .clear {
        clear: both;
    }


    .success {
        background-color: #EFE;
        border: 1px solid #DED;
        color: #9A9;
    }

    .notice {
        background-color: #EFF;
        border: 1px solid #DEE;
        color: #9AA;
    }

    .error {
        background-color: #FEE;
        border: 1px solid #EDD;
        color: #A66;
    }
</style>


<!-- Font Awesome Icons -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<link href="<?php echo base_url() ?>assets/css/nucleo-svg.css" rel="stylesheet" />



<div class=" flex justify-center pt-16">
    <div class="main flex container flex justify-center py-16 px-9 md:px-16">

        <div class="mx-auto border border-2 rounded-lg w-full lg:w-1/3 p-9">
            <?php if ($this->session->flashdata('message_success')) : ?>
                <label>
                    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
                    <div class="alert success">
                        <span class="alertClose">X</span>
                        <span class="alertText"><?= $this->session->flashdata('message_success') ?>
                            <br class="clear" /></span>
                    </div>
                </label>
            <?php endif; ?>
            <?php if ($this->session->flashdata('message_error')) : ?>
                <label>
                    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
                    <div class="alert error">
                        <span class="alertClose">X</span>
                        <span class="alertText"><?= $this->session->flashdata('message_error') ?>
                            <br class="clear" /></span>
                    </div>
                </label>
            <?php endif; ?>
            <div class="p-5">
                <p style="font-size: 21px;" class="font-bold text-center">Lupa Password</p>
                <div class="m-3">
                    <form id="forgot">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="block w-full border border-1 border-gray-300 rounded-lg text-[14px] px-3 py-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" id="email" name="email" placeholder="Masukkan Email">
                        <small id="emailError" class="text-danger"></small>
                    </form>

                    <button class="text-white rounded-lg w-full py-3 px-3 mt-4 bg-[#1089C0] hover:bg-sky-700 my-3" type="button" id="btnForgot" name="btnForgot">Verifikasi Ubah Password</button>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- <script src="assets/boottrap/js/bootstrap.bundle.min.js"></script> -->

<script>
    $("#btnForgot").off("click");
    $(document).on("click", "#btnForgot", function(e) {
        e.preventDefault();

        var data = $("#forgot").serialize();
        $.ajax({
            method: "post",
            url: "<?= base_url() ?>auth/prosesForgot",
            data: data,
            cache: false,
            dataType: "json",
            success: function(data) {
                if (data.success) {
                    Swal.fire({
                        // position: 'top-end',
                        icon: "success",
                        text: data.message,
                        showConfirmButton: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (result.isConfirmed) {
                                window.location.href = '<?= base_url('auth') ?>';
                            }
                        }
                    })
                } else {
                    var message = data.message;
                    Swal.fire({
                        // position: 'top-end',
                        icon: message.icon,
                        title: message.title,
                        text: message.text,
                        showConfirmButton: false,
                        timer: 3000,
                    });
                }

            },
        });
    });
</script>