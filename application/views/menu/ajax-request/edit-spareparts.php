<div class="card card-row card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Spareparts
        </h3>
    </div>
    <div class="card-body auto">
        <?php foreach ($spareparts as $spr) : ?>
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h5 class="card-title"><?= $spr['nama_spareparts']; ?></h5>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool btn-link"><?= $spr['kd_spareparts']; ?></a>
                        <a href="#" class="btn btn-tool">
                            <i class="fas fa-pen"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body auto_sub">
                    <?php
                    $this->db->select('tb_spareparts.kd_spareparts, tb_sub_spareparts.*');
                    $this->db->from('tb_sub_spareparts');
                    $this->db->join('tb_spareparts', 'tb_sub_spareparts.id_spareparts = tb_spareparts.id');
                    $this->db->where('id_spareparts', $spr['id']);
                    $result = $this->db->get()->result_array();
                    foreach ($result as $sub_spr) :
                    ?>
                        <div class="form-check">
                            <?php
                            $this->db->select('tb_data_mobil.id');
                            $this->db->from('tb_data_mobil');
                            $this->db->where('id_pelanggan', $id_pelanggan);
                            $id_mobil = $this->db->get()->row_array();

                            $this->db->select('tb_data_service.id');
                            $this->db->from('tb_data_service');
                            $this->db->where('id_pelanggan', $id_pelanggan);
                            $id_service = $this->db->get()->row_array();
                            ?>
                            <input class="form-check-input edit-pilih-spareparts" type="checkbox" <?= change_spareparts_checked($id_pelanggan, $sub_spr['id']); ?> data-idservice="<?= $id_service['id']; ?>" data-idmobil="<?= $id_mobil['id']; ?>" data-spareparts="<?= $spr['id']; ?>" data-subspareparts="<?= $sub_spr['id']; ?>" data-idpelanggan="<?= $id_pelanggan; ?>" value="" id="">
                            <label class="form-check-label text-sm" for="defaultCheck1">
                                <?= $sub_spr['nama_spareparts']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    $(".edit-pilih-spareparts").click(function() {
        const id_service = $(this).data("idservice");
        const id_mobil = $(this).data("idmobil");
        const id_spareparts = $(this).data("spareparts");
        const id_sub_spareparts = $(this).data("subspareparts");
        const id_pelanggan = $(this).data("idpelanggan");
        const id_status = "<?= $id_status; ?>";
        $.ajax({
            url: "<?= base_url(); ?>service/change_edit_spareparts",
            type: "post",
            data: {
                id_service: id_service,
                id_mobil: id_mobil,
                id_spareparts: id_spareparts,
                id_sub_spareparts: id_sub_spareparts,
                id_pelanggan: id_pelanggan,
                id_status: id_status
            },
            dataType : "json",
            success: function(data) {
                console.log(data);
                if (data.response == 201) {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                }
            }
        });
    });
</script>