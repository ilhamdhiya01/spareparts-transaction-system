<style>
    .kop-wrapper {
        display: flex;
        justify-content: space-between;
        border-bottom: 2px solid #000000;
    }

    p,
    li,
    span {
        font-size: 15px;
    }

    hr {
        border: 1px solid rgba(0, 0, 0, 0.3);
        position: relative;
        top: -13px;
    }

    .kop:last-child {
        width: 85%;
    }

    .kop:not(:first-child) {
        flex: 1;
    }

    .kop img {
        width: 60px;
        height: 50px;
        margin-top: 10px;
    }

    .kop .alamat {
        /* max-width: 70%; */
    }

    .alamat h1 {
        text-align: center;
    }

    .alamat h1 {
        text-transform: uppercase;
        font-size: 16px;
        font-weight: bold;
    }

    .alamat p {
        font-size: 14px;
        margin-top: -5px;
    }

    .nomor-surat-wrapper h1 {
        text-align: center;
    }

    .nomor-surat-wrapper h1 {
        font-size: 15px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .nomor-surat-wrapper p {
        font-size: 15px;
        text-transform: uppercase;
        margin-top: -28px;
    }

    .nomor-surat-wrapper hr {
        position: relative;
        top: -15px;
        border: 1px solid #000000;
        width: 200px;
    }

    h3 {
        font-size: 16px;
    }

    .isi-spk-pemberi,
    .isi-spk-penerima,
    .isi-spk-kriteria,
    .isi-spk-service {
        display: flex;
    }

    .isi-spk-pemberi .isi:first-child,
    .isi-spk-penerima .isi:first-child,
    .isi-spk-kriteria .isi:first-child,
    .isi-spk-service .isi:first-child {
        width: 25%;
    }

    .isi-spk-pemberi .isi:not(:first-child),
    .isi-spk-penerima .isi:not(:first-child),
    .isi-spk-kriteria .isi:not(:first-child),
    .isi-spk-service .isi:not(:first-child) {
        flex: 1;
    }

    .ttd-wrapper {
        display: flex;
        justify-content: flex-end;
    }

    .ttd {
        max-width: 200px;
    }
</style>
<div class="container">
    <div class="kop-wrapper">
        <div class="kop">
            <img src="<?= base_url(); ?>assets/img/suzuki.png" alt="suzuki">
        </div>
        <div class="kop">
            <div class="alamat">
                <h1>pt.suzuki indonesia</h1>
                <p class="text-center">Jl. Pemuda No.65, Pandansari, Kec. Semarang Tengah, <br>Kota Semarang, Jawa Tengah 50139 Telp 024-3565000 Email suzuki@gmail.com</p>
            </div>
        </div>
    </div>
    <hr>
    <div class="nomor-surat-wrapper">
        <h1>surat perintah kerja (spk)</h1>
        <hr>
        <p class="text-center">no.<?= date('d'); ?>/spk-mt/<?= date('m') ?>/<?= date('Y') ?></p>
    </div>
    <h3>Yang bertanda tangan di bawah ini :</h3>
    <div class="isi-spk-pemberi">
        <div class="isi">
            <ul>
                <li>Nama</li>
                <li>Nomor Induk</li>
                <li>Jabatan</li>
                <li>Alamat</li>
            </ul>
        </div>
        <div class="isi">
            <span>: Ilham Dhiya Ulhaq</span><br>
            <span>: JQ987000</span><br>
            <span>: Kepala Service Adisor</span><br>
            <span>: Jl. Tawang Mangu No.18 Semarang</span>
        </div>
    </div>
    <h3>Memberikan perintah kerja kepada :</h3>
    <div class="isi-spk-penerima pb-3">
        <div class="isi">
            <ul>
                <li>Nama</li>
                <li>Nomor Induk</li>
                <li>Jabatan</li>
                <li>Alamat</li>
            </ul>
        </div>
        <div class="isi">
            <span>: Budi Hermawan</span><br>
            <span>: JK008967</span><br>
            <span>: Kepala Mekanik</span><br>
            <span>: Jl. Semarang Indah No.18 Semarang</span>
        </div>
    </div>
    <h3 class="text-bold">Untuk melakukan perbaikan mobil yang rusak dengan kriteria sebagai berikut :</h3>
    <div class="isi-spk-kriteria">
        <div class="isi">
            <ol>
                <li>) Tipe Mobil</li>
                <li>) Nomor Rangka</li>
                <li>) Nomor Mesin</li>
                <li>) Nomor Polisi</li>
            </ol>
        </div>
        <div class="isi">
            <span>: <?= $detail_data_service['tipe_mobil']; ?></span><br>
            <span>: <?= $detail_data_service['nomor_rangka']; ?></span><br>
            <span>: <?= $detail_data_service['nomor_mesin']; ?></span><br>
            <span>: <?= $detail_data_service['nomor_polisi']; ?></span><br>
        </div>
    </div>
    <h3 class="text-bold">Data service mobil di atas :</h3>
    <div class="isi-spk-service">
        <div class="isi">
            <ol>
                <li>) Kode Service</li>
                <li>) Jenis Service</li>
                <?php if ($detail_data_service['jenis_service'] == 'Service Berkala') : ?>
                    <li>) Sub Service</li>
                <?php endif; ?>
                <?php if ($detail_data_service['jenis_service'] == 'Service Lain-lain') : ?>
                    <li>) Service Lain</li>
                <?php endif; ?>
                <li>) Tanggal Service</li>
                <li>) Info Lain</li>
            </ol>
        </div>
        <div class="isi">
            <span>: <?= $detail_data_service['kd_service']; ?></span><br>
            <span>: <?= $detail_data_service['jenis_service']; ?></span><br>
            <?php if ($detail_data_service['jenis_service'] == 'Service Berkala') : ?>
                <span>: <?= $detail_data_service['sub_service']; ?></span><br>
            <?php endif; ?>
            <?php if ($detail_data_service['jenis_service'] == 'Service Lain-lain') : ?>
                <span>: <?= $detail_data_service['service_lain']; ?></span><br>
            <?php endif; ?>
            <span>: <?= $detail_data_service['tgl_service']; ?></span><br>
            <span>: <?= $detail_data_service['info_lain']; ?></span><br>
        </div>
    </div>
    <h3 class="text-bold">Sparepart yang di butuhkan :</h3>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-sm">
            <thead>
                <tr class="text-center">
                    <th>Kode Sparepart</th>
                    <th>Nama Sparepart</th>
                    <th>Harga Spareparts</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data_spareparts as $spareparts) : ?>
                    <tr class="text-center">
                        <th><?= $spareparts['kd_spareparts']; ?></th>
                        <td><?= $spareparts['nama_spareparts']; ?></td>
                        <td><?= rupiah($spareparts['harga_spareparts']); ?></td>
                        <td>1</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <p>Demikian surat perintah ini di buat, agar dapat di laksanakan dengan sebaik-baiknya dengan penuh tanggung jawab. Jika di lapanagan ada kondisi di luar ketebtuan surat ini bisa di diskusikan lebih lanjut.</p><br>
    <div class="ttd-wrapper">
        <div class="ttd">
            <p class="text-center pb-3">Semarang, <?= date('d M Y'); ?><br>PT. Suzuki Indonesia</p>
            <p class="text-center"><b>Ilham Dhiya Ulhaq</b><br>Kepala Service Advisor</p>
        </div>
    </div>
</div>
<script>
    window.print();
</script>