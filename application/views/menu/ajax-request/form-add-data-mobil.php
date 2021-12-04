<form id="form-tambah-mobil">
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="id_pelanggan" value="<?= $pelanggan['id']; ?>">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nama Pelanggan</label>
                <input type="text" class="form-control" value="<?= $pelanggan['nama_pelanggan']; ?>" name="nama_pelanggan" id="nama_pelanggan" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">No Tlp / Wa</label>
                <input type="text" class="form-control" value="<?= $pelanggan['no_tlp']; ?>" name="no_tlp" id="no_tlp" readonly>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">NIK</label>
                <input type="text" class="form-control" value="<?= $pelanggan['nik']; ?>" name="nik" id="nik" readonly>
            </div>
            <div class="mb-3">
                <label for="validationTextarea" class="text-sm">Alamat</label>
                <textarea class="form-control" value="<?= $pelanggan['alamat']; ?>" name="alamat" id="alamat" readonly><?= $pelanggan['alamat']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Jenis Mobil</label>
                <input type="text" class="form-control" name="jenis_mobil" id="jenis_mobil">
                <div class="invalid-feedback jenis_mobil_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tipe Mobil</label>
                <input type="text" class="form-control" name="tipe_mobil" id="tipe_mobil">
                <div class="invalid-feedback tipe_mobil_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Merek Mobil</label>
                <input type="text" class="form-control" name="merek_mobil" id="merek_mobil">
                <div class="invalid-feedback merek_mobil_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Rangka</label>
                <input type="text" class="form-control" name="nomor_rangka" id="nomor_rangka">
                <div class="invalid-feedback nomor_rangka_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Mesin</label>
                <input type="text" class="form-control" name="nomor_mesin" id="nomor_mesin">
                <div class="invalid-feedback nomor_mesin_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Nomor Polisi</label>
                <input type="text" class="form-control" name="nomor_polisi" id="nomor_polisi">
                <div class="invalid-feedback nomor_polisi_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Warna Mobil</label>
                <input type="text" class="form-control" name="warna_mobil" id="warna_mobil">
                <div class="invalid-feedback warna_mobil_error">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="text-sm">Tahun Mobil</label>
                <input type="text" class="form-control" name="tahun_mobil" id="tahun_mobil">
                <div class="invalid-feedback tahun_mobil_error">
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="btn-proses-tambah-mobil">
        <button class="btn btn-outline-primary btn-block btn-sm"><i class="fas fa-plus"></i> Tambah Mobil</button>
    </a>
</form>

<script>
    $("#form-tambah-mobil").submit(function(e) {
        $.ajax({
            url: "<?= base_url(); ?>service/add_data_mobil",
            type: "post",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $(".btn-proses-tambah-mobil").attr('disable', 'disabled');
                $(".btn-proses-tambah-mobil").html('<button class="btn btn-block btn-sm btn-outline-primary"><i class="fa fa-spin fa-spinner"></i></button>');
            },
            complete: function() {
                $(".btn-proses-tambah-mobil").removeAttr('disable');
                $(".btn-proses-tambah-mobil").html('<button class="btn btn-outline-primary btn-block btn-sm"><i class="fas fa-plus"></i> Tambah Mobil</button>');
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.id_pelanggan) {
                        $.ajax({
                            url: "<?= base_url(); ?>service/loadPageError",
                            type: "get",
                            success: function(data) {
                                $(".view-form-add-mobil").html(data);
                            }
                        });
                    }

                    if (data.error.jenis_mobil) {
                        $("[name='jenis_mobil']").addClass("is-invalid");
                        $(".jenis_mobil_error").html(data.error.jenis_mobil);
                    } else {
                        $("[name='jenis_mobil']").removeClass("is-invalid");
                        $(".jenis_mobil_error").html("");
                    }

                    if (data.error.tipe_mobil) {
                        $("[name='tipe_mobil']").addClass("is-invalid");
                        $(".tipe_mobil_error").html(data.error.tipe_mobil);
                    } else {
                        $("[name='tipe_mobil']").removeClass("is-invalid");
                        $(".tipe_mobil_error").html("");
                    }

                    if (data.error.merek_mobil) {
                        $("[name='merek_mobil']").addClass("is-invalid");
                        $(".merek_mobil_error").html(data.error.merek_mobil);
                    } else {
                        $("[name='merek_mobil']").removeClass("is-invalid");
                        $(".merek_mobil_error").html("");
                    }

                    if (data.error.nomor_rangka) {
                        $("[name='nomor_rangka']").addClass("is-invalid");
                        $(".nomor_rangka_error").html(data.error.nomor_rangka);
                    } else {
                        $("[name='nomor_rangka']").removeClass("is-invalid");
                        $(".nomor_rangka_error").html("");
                    }

                    if (data.error.nomor_mesin) {
                        $("[name='nomor_mesin']").addClass("is-invalid");
                        $(".nomor_mesin_error").html(data.error.nomor_mesin);
                    } else {
                        $("[name='nomor_mesin']").removeClass("is-invalid");
                        $(".nomor_mesin_error").html("");
                    }

                    if (data.error.nomor_polisi) {
                        $("[name='nomor_polisi']").addClass("is-invalid");
                        $(".nomor_polisi_error").html(data.error.nomor_polisi);
                    } else {
                        $("[name='nomor_polisi']").removeClass("is-invalid");
                        $(".nomor_polisi_error").html("");
                    }

                    if (data.error.warna_mobil) {
                        $("[name='warna_mobil']").addClass("is-invalid");
                        $(".warna_mobil_error").html(data.error.warna_mobil);
                    } else {
                        $("[name='warna_mobil']").removeClass("is-invalid");
                        $(".warna_mobil_error").html("");
                    }

                    if (data.error.tahun_mobil) {
                        $("[name='tahun_mobil']").addClass("is-invalid");
                        $(".tahun_mobil_error").html(data.error.tahun_mobil);
                    } else {
                        $("[name='tahun_mobil']").removeClass("is-invalid");
                        $(".tahun_mobil_error").html("");
                    }
                } else {
                    $("[name='jenis_mobil']").removeClass("is-invalid");
                    $(".jenis_mobil_error").html("");
                    $("[name='tipe_mobil']").removeClass("is-invalid");
                    $(".tipe_mobil_error").html("");
                    $("[name='merek_mobil']").removeClass("is-invalid");
                    $(".merek_mobil_error").html("");
                    $("[name='nomor_rangka']").removeClass("is-invalid");
                    $(".nomor_rangka_error").html("");
                    $("[name='nomor_mesin']").removeClass("is-invalid");
                    $(".nomor_mesin_error").html("");
                    $("[name='nomor_polisi']").removeClass("is-invalid");
                    $(".nomor_polisi_error").html("");
                    $("[name='warna_mobil']").removeClass("is-invalid");
                    $(".warna_mobil_error").html("");
                    $("[name='tahun_mobil']").removeClass("is-invalid");
                    $(".tahun_mobil_error").html("");

                    if (data.status == 201) {
                        iziToast.success({
                            title: 'Success',
                            message: data.message,
                            position: 'topRight',
                            timeout: 3000
                        });
                        $("[name='jenis_mobil']").val("");
                        $("[name='tipe_mobil']").val("");
                        $("[name='merek_mobil']").val("");
                        $("[name='nomor_rangka']").val("");
                        $("[name='nomor_mesin']").val("");
                        $("[name='nomor_polisi']").val("");
                        $("[name='warna_mobil']").val("");
                        $("[name='tahun_mobil']").val("");
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
</script>