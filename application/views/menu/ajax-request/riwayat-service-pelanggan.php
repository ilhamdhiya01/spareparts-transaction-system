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
<div class="row">
    <div class="col-3">
        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
            <a class="nav-link active data-riwayat-service" id="v-pills-home-tab" data-idservice="<?= $id_service ?>" data-idpelanggan="<?= $id_pelanggan ?>" data-idmobil="<?= $id_mobil ?>" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Riwayat Service</a>
            <a class="nav-link add-service" id="v-pills-profile-tab" data-toggle="pill" data-idservice="<?= $id_service ?>" data-idpelanggan="<?= $id_pelanggan ?>" data-idmobil="<?= $id_mobil ?>" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Tambah Service</a>
        </div>
    </div>
    <div class="col-9">
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active show-detail-service" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                <div class="row">
                    <?php
                    foreach ($riwayat_service as $riwayat) :
                        $status = $this->db->get_where('tb_spareparts_service', ['id_service' => $riwayat['id']])->row_array();
                    ?>
                        <div class="col-md-6">
                            <div class="info-box service" data-idservice="<?= $riwayat['id'];  ?>" data-idpelanggan="<?= $riwayat['id_pelanggan'];  ?>">
                                <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-tools"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text text-bold"><?= $riwayat['jenis_service']; ?></span>
                                    <?php if ($status['id_status'] == 1) : ?>
                                        <span class="info-box-text text-bold"><small class="badge badge-danger">Belum Service</small></span>
                                    <?php elseif ($status['id_status'] == 2) : ?>
                                        <span class="info-box-text text-bold"><small class="badge badge-success">Sudah Service</small></span>
                                    <?php else : ?>
                                        <span class="info-box-text text-bold"><small class="badge badge-warning">Proses Service</small></span>
                                    <?php endif; ?>
                                    <span class="info-box-number"><?= $riwayat['tgl_service']; ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="row">
                    <div class="col-md-12 show-jenis-service">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(".service").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/detail_latest_service",
            type: "get",
            data: {
                id_service: $(this).data("idservice"),
                id_pelanggan: $(this).data("idpelanggan"),
            },
            success: (data) => {
                $(".show-detail-service").html(data);
            }
        });
    });

    $(".data-riwayat-service").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/riwayat_service",
            type: "get",
            data: {
                id_pelanggan: $(this).data("idpelanggan"),
                id_mobil: $(this).data("idmobil"),
                id_service: $(this).data("idservice")
            },
            success: (data) => {
                $(".modal-service-body").html(data);
            }
        })
    });

    $(".add-service").click(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/loadBtnJenisServicePelanggan",
            type: "get",
            data: {
                id_pelanggan: $(this).data("idpelanggan"),
                id_mobil: $(this).data("idmobil"),
                id_service: $(this).data("idservice")
            },
            success: function(data) {
                $(".show-jenis-service").html(data);
            }
        });
    });
</script>