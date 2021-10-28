<?php 
$no=1;
foreach ($jenis_service as $js) : 
?>
    <div class="info-box btn-service" data-id="<?= $js['id']; ?>" data-nama="<?= $js['nama_service']; ?>" data-harga="<?= $js['harga']; ?>">
        <span class="info-box-icon bg-primary"><i class="fas fa-tools"></i></span>

        <div class="info-box-content">
            <span class="info-box-text">Pilihan <?= $no++; ?></span>
            <small><?= rupiah($js['harga']); ?></small>
            <span class="info-box-number"><?= $js['nama_service']; ?></span>
        </div>
        <!-- /.info-box-content -->
    </div>
<?php endforeach; ?>
<script>
    $(".btn-service").mouseenter(function() {
        $(".btn-service").css("cursor", "pointer");
        $(this).addClass("shadow");
    });
    $(".btn-service").mouseleave(function() {
        $(this).removeClass("shadow");
    });
    $(".btn-service").click(function(e) {
        const nama_service = $(this).data("nama");
        // const nama_sub_service = $(".sub-service").data("namaservice");
        const harga_jasa = $(this).data("harga");
        console.log(harga_jasa);
        switch (nama_service) {
            case "Service Berkala":
                $.ajax({
                    url: "<?= base_url(); ?>service/loadSubService",
                    type: "get",
                    success: function(data) {
                        $(".view-jenis-service").html(data);
                        // console.log(data);
                    }
                });
                break;
            case "Service Tune Up":
            case "Service Lain-lain":
                $.ajax({
                    url: "<?= base_url(); ?>service/loadFormDataService",
                    type: "get",
                    data: {
                        nama_service: nama_service,
                        harga_jasa : harga_jasa
                    },
                    success: function(data) {
                        $(".view-jenis-service").html(data);
                        // console.log(data);
                    }
                });
                // alert("Tune up dan Lainlain")
                break;
            default:
                break;
        }
    });
</script>