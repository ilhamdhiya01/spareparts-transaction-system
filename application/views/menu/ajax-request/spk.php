<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .img-spk {
            width: 60px;
            height: 60px;
            position: relative;
            left: 20px;
            top: 10px;
        }

        .garis {
            position: relative;
            top: -20px;
        }

        h4 {
            text-decoration: underline;
            font-weight: bold;
            /* text-align: center; */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <div class="row justify-content-center">
                <div class="col-1">
                    <img class="img-spk" src="<?= base_url(); ?>assets/img/suzuki.png" alt="">
                </div>
                <div class="col-11">
                    <h5 class="text-bold text-center">PT. MASUKIN TERUS SAMPE MENTOK MAS</h5>
                    <p class="text-center">Jl. Karang Jangkang NO. 18 Mataram Semarang Barat <br> Telp. 081239438228 Fax. 123456789 Email. ulhaqilhamdhiya@gmail.com</p>
                </div>
            </div>
            <div class="garis">
                <hr style="height:3px;border:none;color:#333;background-color:#333;" />
                <hr style="height:1px;border:none;color:#333;background-color:#333; margin-top:-13px;" />
            </div>
            <div class="isi-surat">
                <div class="header-spk text-center">
                    <h4>SURAT PERINTAH KERJA (SPK)</h4>
                    <span style="font-size: 21px; position:relative; top:-10px;">No. <?= date('dm'); ?>/SPK-MT/<?= date('Y'); ?></span>
                </div>
                <p class="ml-3 text-bold">Yang bertanda tangan di bawah ini :</p>
                <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-11">
                        <table class="table-form" border="0" width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="2%">:</td>
                                <td>Ilham Dhiya Ulhaq</td>
                            </tr>
                            <tr>
                                <td width="20%">NIK</td>
                                <td width="2%">:</td>
                                <td>JK00236</td>
                            </tr>
                            <tr>
                                <td width="20%">Jabatan</td>
                                <td width="2%">:</td>
                                <td>Service Advicer</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <p class="mt-3 ml-3 text-bold">Memberikan perintah kerja kepada :</p>
                <div class="row">
                    <div class="col-1">

                    </div>
                    <div class="col-11">
                        <table class="table-form" border="0" width="80%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td width="20%">Nama</td>
                                <td width="2%">:</td>
                                <td>Nurdin Enmtop</td>
                            </tr>
                            <tr>
                                <td width="20%">NIK</td>
                                <td width="2%">:</td>
                                <td>JK00125</td>
                            </tr>
                            <tr>
                                <td width="20%">Jabatan</td>
                                <td width="2%">:</td>
                                <td>Kepala Teknisi</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <p class="mt-3 ml-3 text-bold">Untuk melakukan perbaikan mobil dengan kriteria sebagai berikut :</p>
                <div class="data-mobil">
                    <div class="title-data-mobil">
                        <label for="" class="text-bold">Data Mobil</label>
                    </div>
                    <table class="table-form" border="1" width="80%" cellpadding="5" cellspacing="0">
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
                            <td><?= $detail_data_service['merek_mobil']; ?></< /td>
                        </tr>
                        <tr>
                            <td width="20%">Nomor Rangka</td>
                            <td width="2%">:</td>
                            <td><?= $detail_data_service['nomor_rangka']; ?></< /td>
                        </tr>
                        <tr>
                            <td width="20%">Nomor Mesin</td>
                            <td width="2%">:</td>
                            <td><?= $detail_data_service['nomor_mesin']; ?></td>
                        </tr>
                        <tr>
                            <td width="20%">Nomor Polisi</td>
                            <td width="2%">:</td>
                            <td><?= $detail_data_service['nomor_polisi']; ?></< /td>
                        </tr>
                    </table>
                </div>
                <div class="jenis-service mt-4">
                    <div class="title-data-mobil">
                        <label for="" class="text-bold">Data Jenis Service</label>
                    </div>
                    <table class="table-form" border="1" width="80%" cellpadding="5" cellspacing="0">
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
                <p class="mt-4 ml-3">Demikian surat perintah ini di buat agar dapat dilaksanakan sebaik-baiknya dengan penuh<br> tanggung jawab jika di lapangan terdapat suatu kondisi di luar ketentuan surat ini<br> dapat di bicarakan lebih lanjut. </p>
                <br>
                <div class="ttd-spk ml-3">
                    <span class="">Semarang, <?= date('d M Y') ?></span><br>
                    <span>PT. MASUKIN TERUS SAMPE MENTOK MAS</span><br><br><br>
                    <span style="font-weight: bold; text-decoration:underline;">Ilham Dhiya Ulhaq</span><br>
                    <span>Service Advicer</span>
                </div>
            </div>
        </div>
    </div>
    <script>
        print();
    </script>
</body>

</html>