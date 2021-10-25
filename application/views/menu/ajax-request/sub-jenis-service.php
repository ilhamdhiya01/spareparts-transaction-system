<?php
function rupiah($angka)
{
    $hasil = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil;
}
foreach ($sub_jenis_service as $sub_service) :
?>
    <div class="info-box  sub-service" data-idsub="<?php $sub_service['id']; ?>" data-idservice="<?= $sub_service['id_jenis_service']; ?>" data-namaservice="<?= $sub_service['nama_service']; ?>" data-namasub="<?= $sub_service['nama_sub_service']; ?>">
        <span class="info-box-icon bg-warning"><i class="fas fa-tools"></i></span>
        <div class="info-box-content">
            <span class="info-box-text"><?= $sub_service['nama_service']; ?></span>
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
        $.ajax({
            url: "<?= base_url(); ?>service/loadFormDataSubService",
            type: "get",
            data : {
                nama_service : nama_service,
                nama_sub_service : nama_sub_service
            },
            success: function(data) {
                $(".view-jenis-service").html(data);
            }
        });
    });
</script>