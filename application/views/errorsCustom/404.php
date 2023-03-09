<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/404.css'); ?>" />
</head>

<body>
    <h1>404 Error Page</h1>
    <p class="zoom-area">Halaman '<b><?= $inisial ?></b>' tidak ditemukan</p>
    <section class="error-container">
        <span class="four"><span class="screen-reader-text">4</span></span>
        <span class="zero"><span class="screen-reader-text">0</span></span>
        <span class="four"><span class="screen-reader-text">4</span></span>
    </section>
    <div class="link-container">
        <a href="<?= base_url() ?>" class="more-link">Kembali ke halaman utama</a>
    </div>
</body>

</html>