<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-7">
            <form id="form_edit_service">
                <input type="hidden" value="<?= $detail_data_service['id_service']; ?>" name="id_service" id="id_service">
                <input type="hidden" value="<?= $detail_data_service['id_pelanggan']; ?>" name="id_pelanggan" id="id_pelanggan">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label for="" class="text-sm">Kode Service<span class="required text-danger pl-1">*</span></label>
                        <input type="text" readonly class="form-control" value="<?= $detail_data_service['kd_service']; ?>" name="kode_service" id="kode_service">
                        <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label>Jenis Service<span class="required text-danger pl-1">*</span></label>
                        <select class="form-control" name="jenis_service" id="jenis_service">
                            <?php foreach ($jenis_service as $service) : ?>
                                <?php if ($detail_data_service['jenis_service'] == $service['nama_service']) : ?>
                                    <option value="<?= $service['nama_service']; ?>" selected><?= $service['nama_service']; ?></option>
                                <?php else : ?>
                                    <option value="<?= $service['nama_service']; ?>"><?= $service['nama_service']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                        </div>
                    </div>
                </div>

                <?php if ($detail_data_service['jenis_service'] == "Service Berkala") : ?>
                    <div class="form-group row sub_service_edit">
                        <div class="col-sm-10">
                            <label>Sub Service<span class="required text-danger pl-1">*</span></label>
                            <select class="form-control" name="sub_service" id="sub_service">
                                <?php foreach ($sub_service as $subservice) : ?>
                                    <?php if ($detail_data_service['sub_service'] == $subservice['nama_sub_service']) : ?>
                                        <option value="<?= $subservice['nama_sub_service']; ?>" selected><?= $subservice['nama_sub_service']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $subservice['nama_sub_service']; ?>"><?= $subservice['nama_sub_service']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="form-group row sub_service_edit" style="display:none;">
                        <div class="col-sm-10">
                            <label>Sub Service<span class="required text-danger pl-1">*</span></label>
                            <select class="form-control" name="sub_service" id="sub_service">
                                <?php foreach ($sub_service as $subservice) : ?>
                                    <option value="<?= $subservice['nama_sub_service']; ?>"><?= $subservice['nama_sub_service']; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row" style="display: none;">
                    <div class="col-sm-10">
                        <label for="" class="text-sm">Harga Jasa<span class="required text-danger pl-1">*</span></label>
                        <input type="text" readonly class="form-control" value="<?= $detail_data_service['harga']; ?>" name="harga" id="harga">
                        <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                        </div>
                    </div>
                </div>

                <?php if ($detail_data_service['jenis_service'] == "Service Lain-lain") : ?>
                    <div class="form-group row service_lain_edit">
                        <div class="col-sm-10">
                            <label for="" class="text-sm">Service Lain-lain<span class="required text-danger pl-1">*</span></label>
                            <textarea class="form-control" value="<?= $detail_data_service['service_lain']; ?>" id="service_lain" name="service_lain" row="3"><?= $detail_data_service['service_lain']; ?></textarea>
                            <div class="invalid-feedback service_lain_error">
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <div class="form-group row service_lain_edit" style="display:none;">
                        <div class="col-sm-10">
                            <label for="" class="text-sm">Service Lain-lain<span class="required text-danger pl-1">*</span></label>
                            <textarea class="form-control" value="" id="service_lain" name="service_lain" row="3"></textarea>
                            <div class="invalid-feedback service_lain_error">
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="form-group row">
                    <div class="col-sm-10">
                        <label for="" class="text-sm">Tanggal Service<span class="required text-danger pl-1">*</span></label>
                        <input type="date" class="form-control" value="<?= $detail_data_service['tgl_service']; ?>" name="tanggal_service" id="tanggal_service">
                        <div id="validationServer03Feedback" class="invalid-feedback tanggal_service_error">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <label for="" class="text-sm">Info Lain-lain</label>
                        <textarea class="form-control" value="<?= $detail_data_service['info_lain']; ?>" id="info_lain" name="info_lain" row="3"><?= $detail_data_service['info_lain']; ?></textarea>
                        <div class="invalid-feedback alamat_customer_error">
                        </div>
                    </div>
                </div>
                <button type="submit" id="btn_ubah_service" class="btn btn-sm btn-primary">Update</button>
            </form>
        </div>
        <div class="col-md-5" id="pilih-spareparts">
            <div class="data-spareparts">

            </div>
        </div>
        <script>
            // window.location.reload(true);
            $("#jenis_service").change(function() {
                switch ($(this).val()) {
                    case "Service Berkala":
                        $(".sub_service_edit").removeAttr("style");
                        $(".service_lain_edit").attr("style", "display:none;");
                        break;
                    case "Service Lain-lain":
                        $(".service_lain_edit").removeAttr("style");
                        $(".sub_service_edit").attr("style", "display:none;");
                        break;
                    case "Service Tune Up":
                        $(".service_lain_edit").attr("style", "display:none;");
                        $(".sub_service_edit").attr("style", "display:none;");
                        break;
                    default:
                        break;
                }
                $.ajax({
                    url: "<?= base_url(); ?>service/getHargaService",
                    type: "post",
                    data: {
                        jenis_service: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#harga").val(data.harga_jasa.harga);
                    }
                });
            });
            $("#sub_service").change(function() {
                $.ajax({
                    url: "<?= base_url(); ?>service/getHargaSubService",
                    type: "post",
                    data: {
                        sub_service: $(this).val()
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#harga").val(data.harga_jasa.harga);
                    }
                });
            });
            // function loadDataSpareparts() {
            $.ajax({
                url: "<?= base_url(); ?>service/loadPilihSpareparts",
                type: "get",
                data: {
                    'id_pelanggan': '<?= $detail_data_service["id_pelanggan"]; ?>'
                },
                success: function(data) {
                    $(".data-spareparts").html(data);
                }
            });
            // }

            // proses ubah data service
            $("#btn_ubah_service").click(function(e) {
                const id_service = $("#id_service").val();
                const id_pelanggan = $("#id_pelanggan").val();
                const kd_service = $("#kode_service").val();
                const jenis_service = $("#jenis_service").val();
                const sub_service = $("#sub_service").val();
                const harga_jasa = $("#harga").val();
                const service_lain = $("#service_lain").val();
                const tgl_service = $("#tanggal_service").val();
                const info_lain = $("#info_lain").val();

                $.ajax({
                    url: "<?= base_url(); ?>service/prosess_ubah_data_service",
                    type: "post",
                    data: {
                        id_service: id_service,
                        id_pelanggan: id_pelanggan,
                        kd_service: kd_service,
                        jenis_service: jenis_service,
                        sub_service: sub_service,
                        harga_jasa: harga_jasa,
                        service_lain: service_lain,
                        tgl_service: tgl_service,
                        info_lain: info_lain
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.response == 200) {
                            iziToast.success({
                                title: 'Success',
                                message: data.message,
                                position: 'topRight'
                            });
                            $.ajax({
                                url: "<?= base_url(); ?>service/loadTableDataSpk",
                                type: "get",
                                beforeSend: function() {
                                    $(".view-table-cetak-spk").html('<center><img style="margin-top:50px" src="<?= base_url(); ?>assets/img/loading-icon.gif"></center>');
                                },
                                success: function(data) {
                                    setTimeout(function() {
                                        $(".view-table-cetak-spk").html(data);
                                    }, 500);
                                }
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
    </div>
</div>