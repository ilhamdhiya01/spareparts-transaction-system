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
    <a href="#" class="btn-proses-tambah-pelanggan">
        <button class="btn btn-block btn-sm btn-outline-primary"><i class="fas fa-user-plus"></i> Tambah Pelanggan</button>
    </a>
</form>
<script>
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
</script>