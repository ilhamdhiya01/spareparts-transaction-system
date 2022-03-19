<style>
    .info-box:hover {
        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.5);
        cursor: pointer;
    }

    .info-box {
        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
        cursor: pointer;
    }
</style>
<?php
$no = 1;
foreach ($jenis_service as $service) :
?>
    <div class="info-box jenis-service" data-idservice="<?= $id_service ?>" data-idpelanggan="<?= $id_pelanggan ?>" data-idmobil="<?= $id_mobil ?>" data-jenisservice="<?= $service['nama_service']; ?>" data-hargajasa="<?= $service['harga']; ?>">
        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-cogs"></i></span>
        <div class="info-box-content">
            <span class="info-box-text"><?= $service['nama_service']; ?></span>
            <small>Service <?= $no++; ?></small>
            <span class="info-box-number"><?= rupiah($service['harga']); ?></span>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(".jenis-service").click(function(e) {
        switch ($(this).data("jenisservice")) {
            case "Service Berkala":
                $.ajax({
                    url: "<?= base_url(); ?>service/loadSubServicePelanggan",
                    type: "get",
                    data: {
                        id_pelanggan: $(this).data("idpelanggan"),
                        id_service: $(this).data("idservice"),
                        id_mobil: $(this).data("idmobil"),
                    },
                    success: function(data) {
                        $(".show-jenis-service").html(data)
                    }
                });
                break;
            case "Service Tune Up":
            case "Service Lain-lain":
                $.ajax({
                    url: "<?= base_url(); ?>service/loadFormDataServicePelanggan",
                    type: "get",
                    data: {
                        nama_service: $(this).data("jenisservice"),
                        harga_jasa: $(this).data("hargajasa"),
                        id_pelanggan: $(this).data("idpelanggan"),
                        id_mobil: $(this).data("idmobil"),
                        id_service: $(this).data("idservice"),
                    },
                    success: function(data) {
                        $(".show-jenis-service").html(data)
                    }
                });
                break;
            default:
                break;
        }
        e.preventDefault();
    });
</script>