<div class="invoice p-3 mb-3">
    <!-- title row -->
    <div class="row">
        <div class="col-12">
            <h4 class="text-bold">
                <img src="<?= base_url(); ?>assets/img/suzuki.png" alt="suzuki" width="50px" height="40px"> Suzuki Indonesia
                <small class="float-right text-bold">Date: <?= date('d/m/y'); ?></small>
            </h4>
        </div>
        <!-- /.col -->
    </div><br>

    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
            From
            <address>
                <strong>Admin, Suzuki</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                Phone: (804) 123-5432<br>
                Email: suzuki@gmail.com
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            To
            <address>
                <strong><?= $detail_invoice['nama_pelanggan']; ?></strong><br>
                <?= $detail_invoice['alamat']; ?><br>
                Phone: <?= $detail_invoice['no_tlp']; ?><br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <b>Invoice #<?= $kd_invoice; ?></b><br>
            <br>
            <b>Order ID:</b> <?= $detail_invoice['id_pelanggan']; ?><?= $detail_invoice['id_service']; ?><br>
            <b>Payment Due:</b> <?= date('d/m/y'); ?><br>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr class="text-center">
                        <th>Qty</th>
                        <th>Service</th>
                        <th>Kode</th>
                        <th>Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td><?= $detail_invoice['jenis_service']; ?></td>
                        <td class="text-center"><?= $detail_invoice['kd_service']; ?></td>
                        <td class="text-center"><?= rupiah($detail_invoice['harga']); ?></td>
                    </tr>
                    <?php
                    $nilai = 0;
                    foreach ($data_spareparts as $spareparts) :
                        $subtotal = $nilai += $spareparts['harga_spareparts'];
                        $ppn = $subtotal / 100 * 10;
                        $total = $subtotal + $ppn + $detail_invoice['harga'];
                    ?>
                        <tr>
                            <td class="text-center">1</td>
                            <td><?= $spareparts['nama_spareparts']; ?></td>
                            <td class="text-center"><?= $spareparts['kd_spareparts']; ?></td>
                            <td class="text-center"><?= rupiah($spareparts['harga_spareparts']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- accepted payments column -->
        <div class="col-6">
        </div>
        <!-- /.col -->
        <div class="col-6">
            <p class="lead">Amount Due <?= date('d/m/y'); ?></p>

            <div class="table-responsive">
                <table class="table table-sm">
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?= rupiah($subtotal); ?></td>
                    </tr>
                    <tr>
                        <th>Ppn (10%)</th>
                        <td><?= rupiah($ppn); ?></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td><?= rupiah($total); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <!-- /.col -->
    </div>
    <br>
    <!-- /.row -->
    <center>
        <button id="cetak-spk"  class="btn btn-default"><i class="fas fa-print"></i> Cetak</button>
    </center>

    <!-- this row will not appear when printing -->
</div>