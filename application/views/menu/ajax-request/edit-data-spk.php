<div class="row justify-content-center">
    <div class="col-md-7">
        <form id="form_edit_service">
            <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan">
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

            <div class="form-group row" style="display:none;">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Harga Jasa<span class="required text-danger pl-1">*</span></label>
                    <input type="text" readonly class="form-control" value="" name="harga" id="harga">
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
            <button type="submit" id="btn_add_service" class="btn btn-sm btn-primary">Simpan</button>
        </form>
    </div>
    <div class="col-md-5" id="pilih-spareparts">
        <div class="data-spareparts">

        </div>
    </div>
    <script>
        $("#jenis_service").change(function() {
            // console.log($(this).val());
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
        });
        // });
        // function loadDataSpareparts() {
        $.ajax({
            url: "<?= base_url(); ?>service/loadPilihSpareparts",
            type: "get",
            data: {
                'id_pelanggan': '<?= $id_pelanggan["id"]; ?>'
            },
            success: function(data) {
                $(".data-spareparts").html(data);
            }
        });
        // }
    </script>
</div>