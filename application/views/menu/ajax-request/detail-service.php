<div class="container">
    <div class="header-title">
        <h3 class="text-center text-bold text-uppercase">Detail Data Service</h3>
        <hr>
    </div>
    <div class="content">
        <div class="data-pelanggan">
            <div class="title-data-pelanggan">
                <label for="" class="text-bold">Data Pelanggan</label>
            </div>
            <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%">Nama Lengkap</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['nama_pelanggan']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Nomor Tlp / Wa</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['no_tlp']; ?></td>
                </tr>
                <tr>
                    <td width="20%">NIK</td>
                    <td width="2%">:</td>
                    <td><?= substr($detail_data_service['nik'], 0, -8) . "xxxxxxxx"; ?></td>
                </tr>
                <tr>
                    <td width="20%">Alamat</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['alamat']; ?></td>
                </tr>
            </table>
        </div>
        <div class="data-mobil mt-4">
            <div class="title-data-mobil">
                <label for="" class="text-bold">Data Mobil</label>
            </div>
            <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%">Jenis Mobil</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['jenis_mobil']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Tipe Mobil</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['tipe_mobil']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Merk Mobil</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['merek_mobil']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Nomor Rangka</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['nomor_rangka']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Nomor Mesin</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['nomor_mesin']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Nomor Polisi</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['nomor_polisi']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Warna Mobil</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['warna_mobil']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Tahun Mobil</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['tahun_mobil']; ?></td>
                </tr>
            </table>
        </div>
        <div class="jenis-service mt-4">
            <div class="title-data-mobil">
                <label for="" class="text-bold">Data Jenis Service</label>
            </div>
            <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="20%">Kode Service</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['kd_service']; ?></td>
                </tr>
                <tr>
                    <td width="20%">Jenis Service</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['jenis_service']; ?></td>
                </tr>
                <?php if ($detail_data_service['jenis_service'] == "Service Berkala") : ?>
                    <tr>
                        <td width="20%">Sub Service</td>
                        <td width="2%">:</td>
                        <td><?= $detail_data_service['sub_service']; ?></td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td width="20%">Tanggal Service</td>
                    <td width="2%">:</td>
                    <td><?= $detail_data_service['tgl_service']; ?></td>
                </tr>
            </table>
        </div>
        <div class="spareparts mt-4">
            <div class="title-data-spareparts">
                <label for="" class="text-bold">Data Spareparts</label>
            </div>
            <ol>
                <?php foreach ($data_spareparts as $spareparts) : ?>
                    <li><?= $spareparts['nama_spareparts']; ?></li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
</div>