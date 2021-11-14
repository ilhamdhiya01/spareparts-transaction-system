<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <!-- Main content -->
                <div class="invoice p-3 mb-3">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-12">
                            <h4>
                                <img src="<?= base_url(); ?>assets/img/suzuki-invoice.png" style="width:25px; height:25px;" alt=""> PT. Suzuki
                                <small class="float-right">Date: <?= date('d-m-Y') ?></small>
                            </h4>
                        </div><br><br>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            From
                            <address>
                                <strong>Service Advicer</strong><br>
                                <span class="text-sm">Jl. Karang Jangkang No.18<br> Semarang Barat</span><br>
                                <span class="text-sm">Phone : (804) 123-5432</span><br>
                                <span class="text-sm">Email : info@almasaeedstudio.com</span>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            To
                            <address>
                                <strong><?= $detail_invoice['nama_pelanggan']; ?></strong><br>
                                <span class="text-sm"><?= $detail_invoice['alamat']; ?></span><br>
                                <span class="text-sm">Phone : <?= $detail_invoice['no_tlp']; ?></span><br>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Invoice #<?= $kd_invoice; ?></b><br>
                            <br>
                            <b class="text-sm">ID Service:</b> <?= $detail_invoice['kd_service']; ?><br>
                            <b class="text-sm">Payment Due:</b> <?= date('d-m-Y') ?><br>
                        </div>
                        <!-- /.col -->
                    </div><br>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Qty</th>
                                        <th>Service / Spareparts</th>
                                        <th>Kode spareparts</th>
                                        <th>Description</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-sm"></td>
                                        <td class="text-sm">Jasa service</td>
                                        <td class="text-sm"><?= $detail_invoice['kd_service']; ?></td>
                                        <td class="text-sm"><?= $detail_invoice['jenis_service']; ?></td>
                                        <td class="text-sm"><?= rupiah($detail_invoice['harga']); ?></td>
                                    </tr>
                                    <?php 
                                    $sub_total = 0;
                                    foreach ($data_spareparts as $spareparts) : 
                                    ?>
                                        <tr>
                                            <td class="text-sm">1</td>
                                            <td class="text-sm"><?= $spareparts['nama_spareparts']; ?></td>
                                            <td class="text-sm"><?= $spareparts['kd_spareparts']; ?></td>
                                            <td class="text-sm"><?= $spareparts['spareparts']; ?></td>
                                            <td class="text-sm"><?= rupiah($spareparts['harga_spareparts']); ?></td>
                                            <?php $sub_total += $spareparts['harga_spareparts']; ?>
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
                            <p class="lead">Amount Due <?= date('d-m-Y') ?></p>

                            <div class="table-responsive">
                                <table class="table table-sm text-sm">
                                    <tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <?php
                                        $total = $sub_total + $detail_invoice['harga'];
                                        ?>
                                        <td><?= rupiah($total); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Ppn (2%)</th>
                                        <?php
                                        $hitung_ppn = 2 / 100;
                                        $ppn = $total * $hitung_ppn;
                                        ?>
                                        <td><?= rupiah($ppn); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <td><?= rupiah($total + $ppn); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                <i class="fas fa-print"></i> Cetak
                            </button>
                        </div>
                    </div>
                </div>
                <!-- /.invoice -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</section>