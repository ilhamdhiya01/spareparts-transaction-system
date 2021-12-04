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
foreach ($sub_jenis_service as $sub_service) :
?>
    <div class="info-box sub-service" data-jenisservice="<?= $sub_service['nama_service'] ?>" data-subservice="<?= $sub_service['nama_sub_service'] ?>" data-hargajasa="<?= $sub_service['harga'] ?>">
        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-tools"></i></span>
        <div class="info-box-content">
            <span class="info-box-text"><?= $sub_service['nama_sub_service']; ?></span>
            <small><?= $sub_service['nama_service'] . " " . $no++; ?></small>
            <span class="info-box-number"><?= rupiah($sub_service['harga']); ?></span>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(".sub-service").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/loadFormDataService",
            type: "get",
            data: {
                nama_service: $(this).data("jenisservice"),
                harga_jasa: $(this).data("hargajasa"),
                nama_sub_service : $(this).data("subservice")
            },
            success: function(data) {
                $(".view-jenis-service").html(data)
            }
        });
    });
</script>