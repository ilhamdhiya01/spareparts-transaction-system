<?php
$no = 1;
foreach ($sub_jenis_service as $sub_service) :
?>
    <div class="info-box  sub-service" data-idsub="<?php $sub_service['id']; ?>" data-harga="<?= $sub_service['harga']; ?>" data-idservice="<?= $sub_service['id_jenis_service']; ?>" data-namaservice="<?= $sub_service['nama_service']; ?>" data-namasub="<?= $sub_service['nama_sub_service']; ?>">
        <span class="info-box-icon bg-warning"><i class="fas fa-tools"></i></span>
        <div class="info-box-content">
            <span class="info-box-text"><?= $sub_service['nama_service'] . " " . $no++; ?></span>
            <small><?= rupiah($sub_service['harga']); ?></small>
            <span class="info-box-number"><?= $sub_service['nama_sub_service']; ?></span>
        </div>
    </div>
<?php endforeach; ?>

<script>
    $(".sub-service").mouseenter(function() {
        $(".sub-service").css("cursor", "pointer");
        $(this).addClass("shadow");
    });
    $(".sub-service").mouseleave(function() {
        $(this).removeClass("shadow");
    });
    $(".sub-service").click(function() {
        const nama_service = $(this).data("namaservice");
        const nama_sub_service = $(this).data("namasub");
        const harga_jasa = $(this).data("harga");
        $.ajax({
            url: "<?= base_url(); ?>service/loadFormDataServicePelanggan",
            type: "get",
            data: {
                nama_service: nama_service,
                nama_sub_service: nama_sub_service,
                harga_jasa: harga_jasa,
                id_pelanggan : "<?= $id_pelanggan; ?>"
            },
            beforeSend: function() {
                $(".modal-pelanggan").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
            },
            success: function(data) {
                setTimeout(function() {
                    $(".modal-pelanggan").html(data);
                }, 500);
            }
        });
    });
</script>