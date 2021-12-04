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
    <div class="info-box jenis-service" data-jenisservice="<?= $service['nama_service']; ?>" data-hargajasa="<?= $service['harga']; ?>">
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
                    url: "<?= base_url(); ?>service/loadSubService",
                    type: "get",
                    beforeSend: function() {
                        $(".view-jenis-service").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                    },
                    success: function(data) {
                        $(".view-jenis-service").html(data)
                    }
                });
                break;
            case "Service Tune Up":
            case "Service Lain-lain":
                $.ajax({
                    url: "<?= base_url(); ?>service/loadFormDataService",
                    type: "get",
                    data: {
                        nama_service: $(this).data("jenisservice"),
                        harga_jasa: $(this).data("hargajasa")
                    },
                    beforeSend: function() {
                        $(".view-jenis-service").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                    },
                    success: function(data) {
                        $(".view-jenis-service").html(data)
                    }
                });
                break;
            default:
                break;
        }
        e.preventDefault();
    });
</script>