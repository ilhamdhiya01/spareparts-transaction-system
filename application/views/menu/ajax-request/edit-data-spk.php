<div class="row justify-content-center">
    <div class="col-md-6">
        <form id="form-ubah-service">
            <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
            <input type="hidden" value="<?= $detail_data_service['id_service']; ?>" name="id_service" id="id_service">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Kode Service</label>
                <input type="text" class="form-control" value="<?= $detail_data_service['kd_service']; ?>" name="kd_service" id="kd_service" readonly>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect1">Jenis Service</label>
                <select class="form-control" id="exampleFormControlSelect1" name="jenis_service" id="jenis_service">
                    <?php foreach ($jenis_service as $service) : ?>
                        <?php if ($service['nama_service'] == $detail_data_service['jenis_service']) : ?>
                            <option value="<?= $service['nama_service']; ?>" selected><?= $service['nama_service']; ?></option>
                        <?php else : ?>
                            <option value="<?= $service['nama_service']; ?>"><?= $service['nama_service']; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>
            <?php if ($detail_data_service['jenis_service'] == 'Service Berkala') : ?>
                <div class="form-group service-berkala">
                    <label for="exampleFormControlSelect1">Sub Service</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="sub_service" id="sub_service">
                        <?php foreach ($sub_service as $sub) : ?>
                            <?php if ($sub['nama_sub_service'] == $detail_data_service['sub_service']) : ?>
                                <option value="<?= $sub['nama_sub_service']; ?>" selected><?= $sub['nama_sub_service']; ?></option>
                            <?php else : ?>
                                <option value="<?= $sub['nama_sub_service']; ?>"><?= $sub['nama_sub_service']; ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php else : ?>
                <div class="form-group service-berkala" style="display:none;">
                    <label for="exampleFormControlSelect1">Sub Service</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="sub_service" id="sub_service">
                        <?php foreach ($sub_service as $sub) : ?>
                            <option value="<?= $sub['nama_sub_service']; ?>"><?= $sub['nama_sub_service']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Harga Jasa</label>
                <input type="text" class="form-control" value="<?= rupiah($detail_data_service['harga']); ?>" name="harga" id="harga" readonly>
            </div>
            <?php if ($detail_data_service['jenis_service'] == 'Service Lain-lain') : ?>
                <div class="mb-3 service-lain">
                    <label for="validationTextarea" class="text-sm label-lain">Service Lain-lain</label>
                    <textarea class="form-control" value="<?= $detail_data_service['service_lain']; ?>" name="service_lain" id="service_lain"><?= $detail_data_service['service_lain']; ?></textarea>
                    <div class="invalid-feedback service_lain_error">
                    </div>
                </div>
            <?php else : ?>
                <div class="mb-3 service-lain" style="display:none;">
                    <label for="validationTextarea" class="text-sm label-lain">Service Lain-lain</label>
                    <textarea class="form-control" value="" name="service_lain" id="service_lain"></textarea>
                    <div class="invalid-feedback service_lain_error">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tgl Service</label>
                <input type="date" class="form-control" value="<?= $detail_data_service['tgl_service']; ?>" name="tgl_service" id="tgl_service">
                <div class="invalid-feedback tgl_service_error">
                </div>
            </div>
            <div class="mb-3">
                <label for="validationTextarea" class="text-sm">Info Lain-lain</label>
                <textarea class="form-control" value="<?= $detail_data_service['info_lain']; ?>" name="info_lain" id="info_lain"><?= $detail_data_service['info_lain']; ?></textarea>
            </div>
            <a href="#" class="btn-proses-tambah-service">
                <button type="submit" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-plus"> Ubah Service</i></button>
            </a>
        </form>
    </div>
    <div class="col-md-6 view-data-spareparts">
    </div>
</div>

<script>
    $.ajax({
        url: "<?= base_url(); ?>service/loadPilihSpareparts",
        type: "get",
        data: {
            id_pelanggan: $("[name='id_pelanggan']").val()
        },
        success: function(data) {
            $(".view-data-spareparts").html(data);
        }
    });

    $("[name='jenis_service']").change(function() {
        switch ($(this).val()) {
            case 'Service Berkala':
                $(".service-berkala").removeAttr("style");
                $(".service-lain").attr("style", "display:none;");
                $("[name='service_lain']").val("");
                // $("[name='sub_service']").val("");
                $.ajax({
                    url: "<?= base_url(); ?>service/getHargaService",
                    type: "post",
                    data: {
                        jenis_service: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("[name='harga']").val(data.harga_jasa.harga);
                    }
                });
                break;
            case 'Service Tune Up':
                $(".service-berkala").attr("style", "display:none;");
                $(".service-lain").attr("style", "display:none;");
                $("[name='service_lain']").val("");
                $("[name='sub_service']").val("");
                $.ajax({
                    url: "<?= base_url(); ?>service/getHargaService",
                    type: "post",
                    data: {
                        jenis_service: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("[name='harga']").val(data.harga_jasa.harga);
                    }
                });
                break;
            case 'Service Lain-lain':
                $(".service-lain").removeAttr("style");
                $(".service-berkala").attr("style", "display:none;");
                $("[name='service_lain']").val("");
                $("[name='sub_service']").val("");
                $.ajax({
                    url: "<?= base_url(); ?>service/getHargaService",
                    type: "post",
                    data: {
                        jenis_service: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("[name='harga']").val(data.harga_jasa.harga);
                    }
                });
                break;
            default:
                break;
        }
    });
    $("[name='sub_service']").change(function() {
        $.ajax({
            url: "<?= base_url(); ?>service/getHargaSubService",
            type: "post",
            data: {
                sub_service: $(this).val()
            },
            dataType: "json",
            success: function(data) {
                $("[name='harga']").val(data.harga_jasa.harga);
            }
        });
    });

    $("#form-ubah-service").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/proses_ubah_data_service",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
                if (data.response == 200) {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: 'Data gagal di ubah',
                        position: 'topRight'
                    });
                }
            }
        });
        e.preventDefault();
    });
</script>