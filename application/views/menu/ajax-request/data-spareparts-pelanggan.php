<div class="card card-row card-primary">
    <div class="card-header">
        <h3 class="card-title">
            Spareparts
        </h3>
    </div>
    <div class="card-body auto">
        <?php foreach ($spareparts as $jenis_spareparts) : ?>
            <div class="card card-info card-outline">
                <div class="card-header">
                    <h5 class="card-title"><?= $jenis_spareparts['nama_spareparts']; ?></h5>
                    <div class="card-tools">
                        <a href="#" class="btn btn-tool tambah-sub-spareparts" title="Tambah Spareparts" data-idjenis="" data-toggle="modal" data-target="#modal-form-sub">
                            <?= $jenis_spareparts['kd_spareparts']; ?>
                        </a>
                        <a href="#" class="btn btn-tool tambah-sub-spareparts" title="Tambah Spareparts" data-idjenis="" data-toggle="modal" data-target="#modal-form-sub">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>
                <?php
                $result = $this->db->get_where('tb_sub_spareparts', ['id_spareparts' => $jenis_spareparts['id']])->result_array();
                ?>
                <div class="card-body auto_sub">
                    <table border="1" cellspacing="0" cellpadding="5">
                        <?php foreach ($result as $sub_spareparts) : ?>
                            <tr class="text-sm">
                                <td width="5%" class="text-center">
                                    <div class="form-check">
                                        <input class="form-check-input position-static change-spareparts" data-idsubspareparts="<?= $sub_spareparts['id'] ?>" data-idspareparts="<?= $sub_spareparts['id_spareparts']; ?>" data-idpelanggan="<?= $id_pelanggan; ?>" data-idservice="<?= $id_service; ?>" data-idmobil="<?= $id_mobil ?>" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                                    </div>
                                </td>
                                <!-- <td width="1%"></td> -->
                                <td><?= $sub_spareparts['nama_spareparts']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(".change-spareparts").click(function() {
        const id_pelanggan = $(this).data("idpelanggan");
        const id_spareparts = $(this).data("idspareparts");
        const id_sub_spareparts = $(this).data("idsubspareparts");
        const id_service = $(this).data("idservice");
        const id_mobil = $(this).data("idmobil");

        $.ajax({
            url: "<?= base_url(); ?>service/change_spareparts_pelanggan",
            type: "post",
            dataType: "json",
            data: {
                id_service: id_service,
                id_mobil: id_mobil,
                id_spareparts: id_spareparts,
                id_sub_spareparts: id_sub_spareparts,
                id_pelanggan: id_pelanggan,
            },
            success: function(data) {
                if (data.response == 201) {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000
                    });
                } else {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight',
                        timeout: 3000
                    });
                }
            }
        });
    });
</script>