<form action="" method="post" class="access-menu">
    <input type="hidden" name="id" value="" id="id_access">
    <input type="hidden" class="form-control" value="" name="gambar" id="gambar">
    <input type="hidden" class="form-control" value="" name="date_created" id="date_created">
    <div class="form-group">
        <label for="">Nama Pegawai<span class="text-danger pl-1">*</span></label>
        <input type="text" class="form-control" value="" name="nama" id="nama">
        <div id="validationServer03Feedback" class="invalid-feedback nama_error">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group" id="options">
                <label class="control-label ">Posisi<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="posisi" id="posisi">
                    <option value="" class="text-center">-- Pilih --</option>
                    <?php foreach ($posisi as $data_posisi) : ?>
                        <option value="<?= $data_posisi['id']; ?>"><?= $data_posisi['nama_posisi']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="validationServer03Feedback" class="invalid-feedback posisi_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="options">
                <label class="control-label ">Level User<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="level" id="level">
                    <option value="" class="text-center">-- Pilih --</option>
                    <?php foreach ($level as $data_level) : ?>
                        <option value="<?= $data_level['id']; ?>"><?= $data_level['level']; ?></option>
                    <?php endforeach; ?>
                </select>
                <div id="validationServer03Feedback" class="invalid-feedback level_error">
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="">Username<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="username" id="username">
                <div id="validationServer03Feedback" class="invalid-feedback username_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group password">
                <label for="">Password<span class="required text-danger pl-1">*</span></label>

                <input type="password" class="form-control" value="" name="password" id="password">
                <i class="fa fa-eye-slash hide"></i>

                <div id="validationServer03Feedback" class="invalid-feedback password_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group konfirmasi_password">
                <label for="">Konfirmasi Password<span class="required text-danger pl-1">*</span></label>
                <input type="password" class="form-control" value="" name="konfirmasi_password" id="konfirmasi_password">
                <i class="fa fa-eye-slash"></i>
                <div id="validationServer03Feedback" class="invalid-feedback konfirmasi_password_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Aktivasi User</label>
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input aktivasi-menu" value="0" name="is_active" id="is_active">
                    <label class="custom-control-label" for="is_active" id="status">Tidak Aktif</label>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm" id="tambah-user">Tambah</button>
        <button type="submit" style="display:none;" class="btn btn-primary btn-sm" id="ubah-user">Ubah</button>
    </div>
</form>
<script>
    $("#tambah-user").click(function(e) {
        const nama = $("#nama").val();
        const posisi = $("#posisi").val();
        const username = $("#username").val();
        const password = $("#password").val();
        const konfirmasi_password = $("#konfirmasi_password").val();
        const level = $("#level").val();
        let is_active = $("#is_active").val();
        console.log(nama);
        $.ajax({
            url: "<?= base_url('menu/add_user'); ?>",
            type: "post",
            dataType: "json",
            data: {
                nama: nama,
                posisi: posisi,
                username: username,
                password: password,
                konfirmasi_password: konfirmasi_password,
                level: level,
                is_active: is_active
            },
            beforeSend: function() {
                $("#tambah-user").attr('disable', 'disabled');
                $("#tambah-user").html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $("#tambah-user").removeAttr('disable');
                $("#tambah-user").html('Tambah');
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.nama_pegawai) {
                        $("#nama").addClass("is-invalid");
                        $(".nama_error").html(data.error.nama_pegawai);
                    } else {
                        $("#nama").removeClass("is-invalid");
                        $(".nama_error").html('');
                    }

                    if (data.error.posisi_pegawai) {
                        $("#posisi").addClass("is-invalid");
                        $(".posisi_error").html(data.error.posisi_pegawai);
                    } else {
                        $("#posisi").removeClass("is-invalid");
                        $(".posisi_error").html('');
                    }

                    if (data.error.level_id) {
                        $("#level").addClass("is-invalid");
                        $(".level_error").html(data.error.level_id);
                    } else {
                        $("#level").removeClass("is-invalid");
                        $(".level_error").html('');
                    }

                    if (data.error.username) {
                        $("#username").addClass("is-invalid");
                        $(".username_error").html(data.error.username);
                    } else {
                        $("#username").removeClass("is-invalid");
                        $(".username_error").html('');
                    }


                    if (data.error.password) {
                        $("#password").addClass("is-invalid");
                        $(".password_error").html(data.error.password);
                    } else {
                        $("#password").removeClass("is-invalid");
                        $(".password_error").html('');
                    }


                    if (data.error.konfirmasi_password) {
                        $("#konfirmasi_password").addClass("is-invalid");
                        $(".konfirmasi_password_error").html(data.error.konfirmasi_password);
                    } else {
                        $("#konfirmasi_password").removeClass("is-invalid");
                        $(".konfirmasi_password_error").html('');
                    }

                } else if (data.response == 'success') {
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    readAccessMenu();
                    $("#gambar").val("");

                    $("#nama").removeClass("is-invalid");
                    $("#nama").val("");
                    $(".nama_error").html('');

                    $("#posisi").removeClass("is-invalid");
                    $("#posisi").val("");
                    $(".posisi_error").html('');

                    $("#level").removeClass("is-invalid");
                    $("#level").val("");
                    $(".level_error").html('');

                    $("#username").removeClass("is-invalid");
                    $("#username").val("");
                    $(".username_error").html('');

                    $("#password").removeClass("is-invalid");
                    $("#password").val("");
                    $(".password_error").html('');

                    $("#konfirmasi_password").removeClass("is-invalid");
                    $("#konfirmasi_password").val("");
                    $(".konfirmasi_password_error").html('');

                    if (is_active == 1) {
                        $("#is_active").removeAttr("checked");
                        $("#is_active").val(0);
                        $("#status").html("Tidak Aktif");
                    }
                }
            }
        });
        e.preventDefault();
    });

    $(".aktivasi-menu").click(function() {
        if ($(this).is(":checked")) {
            $("#status").html("Aktif");
            $(this).attr("value", 1);
        } else {
            $("#status").html("Tidak Aktif");
            $(this).attr("value", 0);
        }
    });

    $(".fa-eye-slash").click(function() {
        if ($("#password").attr("type") == "password") {
            $("#password").attr("type", "text");
            $(this).attr("class", "fa fa-eye");
        } else {
            $("#password").attr("type", "password");
            $(this).attr("class", "fa fa-eye-slash");
        }

        if ($("#konfirmasi_password").attr("type") == "password") {
            $("#konfirmasi_password").attr("type", "text");
            $(this).attr("class", "fa fa-eye");
        } else {
            $("#konfirmasi_password").attr("type", "password");
            $(this).attr("class", "fa fa-eye-slash");
        }
    })
</script>