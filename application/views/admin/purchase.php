<!-- DataTables  -->
<div class="w-full">
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive" style="margin:10px;">
            <table class="table table-hover table-striped align-middle" id="purchaseTable" style="width: 100%;max-width:100%;">
                <thead class="">
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Waktu publish</th>
                        <th>Jumlah terjual</th>
                        <!-- <th>Update</th>
                        <th>Naskah</th>
                        <th>Cover</th> -->
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

<!--  -->
<script src="<?= base_url('assets/js/purchase.js'); ?>"></script>