<div class="row justify-content-center">
    <div class="col-md-6">
        <form id="form-tambah-pelanggan">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nama Pelanggan</label>
                <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan">
                <div class="invalid-feedback nama_pelanggan_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">No Tlp / Wa</label>
                <input type="text" class="form-control" name="no_tlp" id="no_tlp">
                <div class="invalid-feedback no_tlp_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">NIK</label>
                <input type="text" class="form-control" name="nik" id="nik">
                <div class="invalid-feedback nik_error">
                </div>
            </div>
            <div class="mb-3">
                <label for="validationTextarea" class="text-sm">Alamat</label>
                <textarea class="form-control" name="alamat" id="alamat"></textarea>
                <div class="invalid-feedback alamat_error">
                </div>
            </div>
            <a href="#" class="proses-tambah-pelanggan">
                <button class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-user-plus"></i> Tambah Pelanggan</button>
            </a>
        </form>
    </div>
    <div class="col-md-6 form-add-mobil" style="display: none;">
        <form action="">
            <input type="hidden" value="" name="id_mobil" id="id_mobil">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Jenis Mobil</label>
                <input type="text" class="form-control" value="" name="jenis_mobil" id="jenis_mobil">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tipe Mobil</label>
                <input type="text" class="form-control" value="" name="tipe_mobil" id="tipe_mobil">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Merek Mobil</label>
                <input type="text" class="form-control" value="" name="merek_mobil" id="kd_service">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Rangka</label>
                <input type="text" class="form-control" value="" name="nomor_rangka" id="nomor_rangka">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Mesin</label>
                <input type="text" class="form-control" value="" name="nomor_mesin" id="nomor_mesin">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Polisi</label>
                <input type="text" class="form-control" value="" name="nomor_polisi" id="nomor_polisi">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Warna Mobil</label>
                <input type="text" class="form-control" value="" name="warna_mobil" id="warna_mobil">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tahun Mobil</label>
                <input type="text" class="form-control" value="" name="tahun_mobil" id="tahun_mobil">
            </div>    
        </form>
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

    $("#form-tambah-pelanggan").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/add_service",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $(".btn-proses-tambah-pelanggan").attr('disable', 'disabled');
                $(".btn-proses-tambah-pelanggan").html('<button class="btn btn-block btn-sm btn-outline-primary"><i class="fa fa-spin fa-spinner"></i></button>');
            },
            complete: function() {
                $(".btn-proses-tambah-pelanggan").removeAttr('disable');
                $(".btn-proses-tambah-pelanggan").html(' <button class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-user-plus"></i> Tambah Pelanggan</button>');
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_pelanggan) {
                        $("[name='nama_pelanggan']").addClass("is-invalid");
                        $(".nama_pelanggan_error").html(data.error.nama_pelanggan);
                    } else {
                        $("[name='nama_pelanggan']").removeClass("is-invalid");
                        $(".nama_pelanggan_error").html("");
                    }

                    if (data.error.no_tlp) {
                        $("[name='no_tlp']").addClass("is-invalid");
                        $(".no_tlp_error").html(data.error.no_tlp);
                    } else {
                        $("[name='no_tlp']").removeClass("is-invalid");
                        $(".no_tlp_error").html("");
                    }

                    if (data.error.nik) {
                        $("[name='nik']").addClass("is-invalid");
                        $(".nik_error").html(data.error.nik);
                    } else {
                        $("[name='nik']").removeClass("is-invalid");
                        $(".nik_error").html("");
                    }

                    if (data.error.alamat) {
                        $("[name='alamat']").addClass("is-invalid");
                        $(".alamat_error").html(data.error.alamat);
                    } else {
                        $("[name='alamat']").removeClass("is-invalid");
                        $(".alamat_error").html("");
                    }
                } else {
                    $("[name='nama_pelanggan']").removeClass("is-invalid");
                    $(".nama_pelanggan_error").html("");
                    $("[name='no_tlp']").removeClass("is-invalid");
                    $(".no_tlp_error").html("");
                    $("[name='nik']").removeClass("is-invalid");
                    $(".nik_error").html("");
                    $("[name='alamat']").removeClass("is-invalid");
                    $(".alamat_error").html("");
                    $(".add-mobil").removeAttr("style");
                    $("#modal-pelanggan").modal("hide");

                    if (data.response == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight',
                            timeout: 3000
                        });
                        $("[name='nama_pelanggan']").val("");
                        $("[name='no_tlp']").val("");
                        $("[name='nik']").val("");
                        $("[name='alamat']").val("");
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
        e.preventDefault();
    });

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