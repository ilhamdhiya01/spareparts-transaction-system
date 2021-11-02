<div class="row">
    <div class="col-md-7">
        <form id="form_add_service">
            <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_sebelum" id="id_sebelum">
            <?php if (is_null(@$id_pelanggan['id'])) : ?>
                <input type="hidden" value="" name="id_pelanggan" id="id_pelanggan">
            <?php else : ?>
                <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
            <?php endif; ?>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Kode Service<span class="required text-danger pl-1">*</span></label>
                    <input type="text" readonly class="form-control" value="<?= $kd_service; ?>" name="kode_service" id="kode_service">
                    <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Jenis Service<span class="required text-danger pl-1">*</span></label>
                    <input type="text" readonly class="form-control" value="<?= $nama_service; ?>" name="jenis_service" id="jenis_service">
                    <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Harga Jasa<span class="required text-danger pl-1">*</span></label>
                    <input type="text" readonly class="form-control" value="<?= rupiah($harga_jasa); ?>" name="harga" id="harga">
                    <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                    </div>
                </div>
            </div>

            <div class="form-group row sub_service">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Sub Service<span class="required text-danger pl-1">*</span></label>
                    <input type="text" readonly class="form-control" value="" name="sub_service" id="sub_service">
                    <div id="validationServer03Feedback" class="invalid-feedback nama_customer_error">
                    </div>
                </div>
            </div>

            <div class="form-group row service_lain">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Service Lain-lain<span class="required text-danger pl-1">*</span></label>
                    <textarea class="form-control" value="" id="service_lain" name="service_lain" row="3"></textarea>
                    <div class="invalid-feedback service_lain_error">
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Tanggal Service<span class="required text-danger pl-1">*</span></label>
                    <input type="date" class="form-control" value="" name="tanggal_service" id="tanggal_service">
                    <div id="validationServer03Feedback" class="invalid-feedback tanggal_service_error">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <label for="" class="text-sm">Info Lain-lain</label>
                    <textarea class="form-control" id="info_lain" name="info_lain" row="3"></textarea>
                    <div class="invalid-feedback alamat_customer_error">
                    </div>
                </div>
            </div>
            <button type="submit" id="btn_add_service" class="btn btn-sm btn-primary">Simpan</button>
        </form>
    </div>
    <div class="col-md-5">
        <div class="card card-row card-primary">
            <div class="card-header">
                <h3 class="card-title">
                    Spareparts
                </h3>
            </div>
            <div class="card-body auto">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Labels</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#3</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" disabled>
                            <label for="customCheckbox1" class="custom-control-label">Bug</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" disabled>
                            <label for="customCheckbox2" class="custom-control-label">Feature</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" disabled>
                            <label for="customCheckbox3" class="custom-control-label">Enhancement</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox4" disabled>
                            <label for="customCheckbox4" class="custom-control-label">Documentation</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox5" disabled>
                            <label for="customCheckbox5" class="custom-control-label">Examples</label>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Issue template</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#4</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1_1" disabled>
                            <label for="customCheckbox1_1" class="custom-control-label">Bug Report</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" type="checkbox" id="customCheckbox1_2" disabled>
                            <label for="customCheckbox1_2" class="custom-control-label">Feature Request</label>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create PR template</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#6</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card card-light card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Create Actions</h5>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-link">#7</a>
                            <a href="#" class="btn btn-tool">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>

                    </div>
                    <div class="card-body">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
                            Aenean commodo ligula eget dolor. Aenean massa.
                            Cum sociis natoque penatibus et magnis dis parturient montes,
                            nascetur ridiculus mus.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('[data-spy="scroll"]').each(function() {
        var $spy = $(this).scrollspy('refresh')
    })
    $(document).ready(function() {
        const nama_service = $("#jenis_service").val();
        switch (nama_service) {
            case "Service Berkala":
                $("#sub_service").val("<?= $nama_sub_service; ?>");
                $(".service_lain").css("display", "none");
                break;
            case "Service Tune Up":
                $("#sub_service").val("");
                $(".service_lain").css("display", "none");
                $(".sub_service").css("display", "none");
                break;
            case "Service Lain-lain":
                $("#sub_service").val("");
                $(".sub_service").css("display", "none");
                break;
            default:
                break;
        }
    });
    $("#form_add_service").submit(function(e) {
        const jenis_service = $("#jenis_service").val();
        const data_service = $(this).serialize();
        const tanggal_service = $("#tanggal_service").val();
        const service_lain = $("#service_lain").val();
        switch (jenis_service) {
            case "Service Tune Up":
                // console.log(data_service);
                if ($("#tanggal_service").val() == "" || $("#tanggal_service").val() == undefined) {
                    $("#tanggal_service").addClass("is-invalid");
                    $(".tanggal_service_error").html("Tanggal service wajib di isi");
                    break;
                } else {
                    $("#tanggal_service").removeClass("is-invalid");
                    $(".tanggal_service_error").html("");
                    $.ajax({
                        url: "<?= base_url(); ?>service/addTuneUpService",
                        type: "post",
                        data: {
                            id_pelanggan: $("#id_pelanggan").val(),
                            kode_service: $("#kode_service").val(),
                            jenis_service: $("#jenis_service").val(),
                            harga: $("#harga").val(),
                            sub_service: $("#sub_service").val(),
                            service_lain: $("#service_lain").val(),
                            tgl_service: $("#tanggal_service").val(),
                            info_lain: $("#info_lain").val()
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error) {
                                if (data.error.id_pelanggan) {
                                    $.ajax({
                                        url: "<?= base_url(); ?>service/loadPageError",
                                        type: "get",
                                        success: function(data) {
                                            $(".view-jenis-service").html(data);
                                        }
                                    });
                                }
                            } else {
                                if (data.status == 201) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Data gagal di tambahkan',
                                        position: 'topRight'
                                    });
                                }
                            }
                        }
                    });
                }
                break;
            case "Service Lain-lain":
                if ($("#service_lain").val() == "" || $("#service_lain").val() == undefined || $("#tanggal_service").val() == "" || $("#tanggal_service").val() == undefined) {
                    $("#service_lain").addClass("is-invalid");
                    $(".service_lain_error").html("service lain wajib di isi");
                    $("#tanggal_service").addClass("is-invalid");
                    $(".tanggal_service_error").html("Tanggal service wajib di isi");
                    break;
                } else {
                    $("#service_lain").removeClass("is-invalid");
                    $(".service_lain_error").html("");
                    $("#tanggal_service").removeClass("is-invalid");
                    $(".tanggal_service_error").html("");
                    $.ajax({
                        url: "<?= base_url(); ?>service/addServiceLain",
                        type: "post",
                        dataType: "json",
                        data: {
                            id_pelanggan: $("#id_pelanggan").val(),
                            kode_service: $("#kode_service").val(),
                            jenis_service: $("#jenis_service").val(),
                            harga: $("#harga").val(),
                            sub_service: $("#sub_service").val(),
                            service_lain: $("#service_lain").val(),
                            tgl_service: $("#tanggal_service").val(),
                            info_lain: $("#info_lain").val()
                        },
                        success: function(data) {
                            if (data.error) {
                                if (data.error.id_pelanggan) {
                                    $.ajax({
                                        url: "<?= base_url(); ?>service/loadPageError",
                                        type: "get",
                                        success: function(data) {
                                            $(".view-jenis-service").html(data);
                                        }
                                    });
                                }
                            } else {
                                if (data.status == 201) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Data gagal di tambahkan',
                                        position: 'topRight'
                                    });
                                }
                            }
                        }
                    });
                }
                break;
            case "Service Berkala":
                if ($("#tanggal_service").val() == "" || $("#tanggal_service").val() == undefined) {
                    $("#tanggal_service").addClass("is-invalid");
                    $(".tanggal_service_error").html("Tanggal service wajib di isi");
                    break;
                } else {
                    $("#tanggal_service").removeClass("is-invalid");
                    $(".tanggal_service_error").html("");
                    $.ajax({
                        url: "<?= base_url(); ?>service/addServiceBerkala",
                        type: "post",
                        data: {
                            id_pelanggan: $("#id_pelanggan").val(),
                            kode_service: $("#kode_service").val(),
                            jenis_service: $("#jenis_service").val(),
                            harga: $("#harga").val(),
                            sub_service: $("#sub_service").val(),
                            service_lain: $("#service_lain").val(),
                            tgl_service: $("#tanggal_service").val(),
                            info_lain: $("#info_lain").val()
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.error) {
                                if (data.error.id_pelanggan) {
                                    $.ajax({
                                        url: "<?= base_url(); ?>service/loadPageError",
                                        type: "get",
                                        success: function(data) {
                                            $(".view-jenis-service").html(data);
                                        }
                                    });
                                }
                            } else {
                                if (data.status == 201) {
                                    iziToast.success({
                                        title: 'Success',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Data gagal di tambahkan',
                                        position: 'topRight'
                                    });
                                }
                            }
                        }
                    });
                }
                break;
            default:
                break;
        }
        e.preventDefault();
    })
</script>