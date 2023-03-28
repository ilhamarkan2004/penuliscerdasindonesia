<div class="container my-12 mx-auto px-4 md:px-12 pt-16">

    <div class="p-3">
        <h1 class="text-4xl font-bold mt"><?= $eventDetail['name_type'] ?></h1>
        <p class="ml-4 p-4"><?= $eventDetail['desc'] ?></p>
        <p class="text-center">
            <?= (count($by_type) == 0) ? 'Belum ada ' . strtolower($eventDetail['name_type']) . ' tersedia' : ''; ?>
        </p>
    </div>
    <div class="flex flex-wrap -mx-1 lg:-mx-4">

        <?php foreach ($by_type as $bt) : ?>
            <!-- Column -->
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">

                <!-- Article -->
                <article class="overflow-hidden rounded-lg shadow-lg">

                    <a target="_blank" href="<?= $bt['link'] ?>">
                        <img alt="Placeholder" class="block h-auto w-full" src="<?= base_url() . $bt['img'] ?>">
                    </a>

                    <header class="flex items-center justify-between leading-tight p-2 md:p-4 my-3">
                        <h1 class="text-lg font-bold">
                            <a target='_blank' class="no-underline hover:underline text-black" href="<?= $bt['link'] ?>">
                                <?= $bt['event_name'] ?>
                            </a>
                        </h1>
                        <p class="text-grey-darker text-sm">

                        </p>
                    </header>

                    <div class="px-3">
                        <p class="pb-2">
                            <?= $bt['e_desc'] ?>
                        </p>
                        <footer class="flex items-center justify-between leading-none">
                            <a target='_blank' class="flex items-center no-underline hover:underline text-black" href="<?= $bt['link'] ?>">
                                <p class="ml-2 text-sm" style="color: #c4c4c4;">
                                    Pendaftaran mulai dari <?= date('j M Y', strtotime($bt['start_regist']))  ?> - <?= date('j M Y', strtotime($bt['end_regist']))  ?>
                                </p>
                            </a>
                        </footer>
                    </div>


                </article>
                <!-- END Article -->

            </div>
            <!-- END Column -->
        <?php endforeach; ?>


    </div>
</div>