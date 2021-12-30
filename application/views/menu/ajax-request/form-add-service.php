<div class="row justify-content-center">
    <div class="col-md-6">
        <form id="form-tambah-service">
            <input type="hidden" value="<?= $id_pelanggan['id']; ?>" name="id_pelanggan" id="id_pelanggan">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Kode Service</label>
                <input type="text" class="form-control" value="<?= $kd_service; ?>" name="kd_service" id="kd_service" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Jenis Service</label>
                <input type="text" class="form-control" value="<?= $nama_service; ?>" name="jenis_service" id="jenis_service" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Harga Jasa</label>
                <input type="text" class="form-control" value="<?= rupiah($harga_jasa); ?>" name="harga" id="harga" readonly>
            </div>
            <?php if ($nama_service == 'Service Berkala') : ?>
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-sm">Sub Service</label>
                    <input type="text" class="form-control" value="<?= $nama_sub_service; ?>" name="sub_service" id="sub_service" readonly>
                </div>
            <?php else : ?>
                <div class="form-group" style="display:none;">
                    <label for="exampleInputEmail1" class="text-sm">Sub Service</label>
                    <input type="text" class="form-control" value="<?= $nama_sub_service; ?>" name="sub_service" id="sub_service" readonly>
                </div>
            <?php endif; ?>
            <?php if ($nama_service == 'Service Lain-lain') : ?>
                <div class="mb-3">
                    <label for="validationTextarea" class="text-sm">Service Lain-lain</label>
                    <textarea class="form-control" name="service_lain" id="service_lain"></textarea>
                    <div class="invalid-feedback service_lain_error">
                    </div>
                </div>
            <?php else : ?>
                <div class="mb-3" style="display:none;">
                    <label for="validationTextarea" class="text-sm">Service Lain-lain</label>
                    <textarea class="form-control" name="service_lain" id="service_lain"></textarea>
                    <div class="invalid-feedback service_lain_error">
                    </div>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tgl Service</label>
                <input type="date" class="form-control" name="tgl_service" id="tgl_service">
                <div class="invalid-feedback tgl_service_error">
                </div>
            </div>
            <div class="mb-3">
                <label for="validationTextarea" class="text-sm">Info Lain-lain</label>
                <textarea class="form-control" name="info_lain" id="info_lain"></textarea>
            </div>
            <a href="#" class="btn-proses-tambah-service">
                <button type="submit" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-plus"> Tambah Service</i></button>
            </a>
        </form>
    </div>
    <div class="col-md-6 view-data-spareparts" style="display: none;">
    </div>
</div>

<script>
    function load_data_spareparts() {
        $(".view-data-spareparts").removeAttr("style");
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
    }

    $("#form-tambah-service").submit(function(e) {
        const jenis_service = $("[name='jenis_service']").val();
        switch (jenis_service) {
            case "Service Berkala":
                $.ajax({
                    url: "<?= base_url(); ?>service/addServiceBerkala",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $(".btn-proses-tambah-service").attr('disable', 'disabled');
                        $(".btn-proses-tambah-service").html('<button class="btn btn-block btn-sm btn-outline-primary"><i class="fa fa-spin fa-spinner"></i></button>');
                    },
                    complete: function() {
                        $(".btn-proses-tambah-service").removeAttr('disable');
                        $(".btn-proses-tambah-service").html('<button type="submit" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-plus"> Tambah Service</i></button>');
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

                            if (data.error.tgl_service) {
                                $("[name='tgl_service']").addClass("is-invalid");
                                $(".tgl_service_error").html(data.error.tgl_service);
                            } else {
                                $("[name='tgl_service']").removeClass("is-invalid");
                                $(".tgl_service_error").html("");
                            }
                        } else {
                            $("[name='tgl_service']").removeClass("is-invalid");
                            $(".tgl_service_error").html("");
                            if (data.status == 201) {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight',
                                    timeout: 3000
                                });
                                load_data_spareparts();
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Data gagal di tambahkan',
                                    position: 'topRight',
                                    timeout: 3000
                                });
                            }
                        }
                    }
                });
                break;
            case "Service Tune Up":
                $.ajax({
                    url: "<?= base_url(); ?>service/addTuneUpService",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $(".btn-proses-tambah-service").attr('disable', 'disabled');
                        $(".btn-proses-tambah-service").html('<button class="btn btn-block btn-sm btn-outline-primary"><i class="fa fa-spin fa-spinner"></i></button>');
                    },
                    complete: function() {
                        $(".btn-proses-tambah-service").removeAttr('disable');
                        $(".btn-proses-tambah-service").html('<button type="submit" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-plus"> Tambah Service</i></button>');
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

                            if (data.error.tgl_service) {
                                $("[name='tgl_service']").addClass("is-invalid");
                                $(".tgl_service_error").html(data.error.tgl_service);
                            } else {
                                $("[name='tgl_service']").removeClass("is-invalid");
                                $(".tgl_service_error").html("");
                            }
                        } else {
                            $("[name='tgl_service']").removeClass("is-invalid");
                            $(".tgl_service_error").html("");
                            if (data.status == 201) {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight',
                                    timeout: 3000
                                });
                                load_data_spareparts();
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Data gagal di tambahkan',
                                    position: 'topRight',
                                    timeout: 3000
                                });
                            }
                        }
                    }
                });
                break;
            case "Service Lain-lain":
                $.ajax({
                    url: "<?= base_url(); ?>service/addServiceLain",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $(".btn-proses-tambah-service").attr('disable', 'disabled');
                        $(".btn-proses-tambah-service").html('<button class="btn btn-block btn-sm btn-outline-primary"><i class="fa fa-spin fa-spinner"></i></button>');
                    },
                    complete: function() {
                        $(".btn-proses-tambah-service").removeAttr('disable');
                        $(".btn-proses-tambah-service").html('<button type="submit" class="btn btn-block btn-outline-primary btn-sm"><i class="fas fa-plus"> Tambah Service</i></button>');
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

                            if (data.error.service_lain) {
                                $("[name='service_lain']").addClass("is-invalid");
                                $(".service_lain_error").html(data.error.service_lain);
                            } else {
                                $("[name='service_lain']").removeClass("is-invalid");
                                $(".service_lain_error").html("");
                            }

                            if (data.error.tgl_service) {
                                $("[name='tgl_service']").addClass("is-invalid");
                                $(".tgl_service_error").html(data.error.tgl_service);
                            } else {
                                $("[name='tgl_service']").removeClass("is-invalid");
                                $(".tgl_service_error").html("");
                            }
                        } else {
                            $("[name='service_lain']").removeClass("is-invalid");
                            $(".service_lain_error").html("");
                            $("[name='tgl_service']").removeClass("is-invalid");
                            $(".tgl_service_error").html("");
                            if (data.status == 201) {
                                iziToast.success({
                                    title: 'Success',
                                    message: data.message,
                                    position: 'topRight',
                                    timeout: 3000
                                });
                                load_data_spareparts();
                            } else {
                                iziToast.error({
                                    title: 'Error',
                                    message: 'Data gagal di tambahkan',
                                    position: 'topRight',
                                    timeout: 3000
                                });
                            }
                        }
                    }
                });
                break;
            default:
                break;
        }
        e.preventDefault();
    });
</script>