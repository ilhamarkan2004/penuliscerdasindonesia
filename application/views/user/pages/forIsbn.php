<style>
    tr.space>td {
        padding: 0.5em;
    }
</style>
<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<section class="flex justify-center pt-16">
    <div class="container min-w-[360px]">
        <div class="flex flex-wrap w-full h-full px-9 lg:px-16 py-16">
            <div class="w-full lg:w-2/5 flex justify-center p-10">
                <div class="w-fit flex flex-col items-center">
                    <!--Program Pelatihan -->
                    <div class="min-w-[260px] w-fit flex justify-center">
                        <div class="shadow-md rounded-md lg:px-16 bg-white border">
                            <div class="border-b-2 border-[#F5F5F5] flex items-center">
                                <img src="<?= base_url() . $bookDetail['cover'] ?>" class="" style="aspect-ratio: 3/4; width: 15rem;" />
                            </div>

                            <!-- Fasililtas -->

                        </div>
                        <!-- <div class="flex justify-center relative h-11 top-[-38px]"></div> -->
                    </div>
                </div>
            </div>


            <!-- -------- -->
            <div class="w-full lg:w-3/5 flex justify-center ">
                <div class="w-full shadow-md rounded-md lg:px-16 pb-6 bg-white m-4 border">
                    <h1 class="font-semibold text-3xl text-center p-4">
                        <?= $bookDetail['title'] ?>
                    </h1>
                    <h3 class="text-lg font-semibold">Sinopsis</h3>
                    <p class="text-justify">
                        <?= $bookDetail['description'] ?>
                    </p>
                    <h3 class="text-lg font-semibold mt-6">Detail</h3>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($contributor as $c) : ?>
                                <tr class="space">
                                    <td><?= $c['role_name'] ?></td>
                                    <td class="flex flex-wrap">
                                        <?= (count(${strtolower(str_replace(' ', '', $c['role_name']))}) == 0) ? "-" : ''; ?>
                                        <?php foreach (${strtolower(str_replace(' ', '', $c['role_name']))} as $p) : ?>
                                            <span class="bg-green-500 rounded-xl text-white py-2 px-3 m-1"><?= $p['name'] ?></span>
                                        <?php endforeach; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>