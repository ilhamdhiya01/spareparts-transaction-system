<form action="" method="post" class="access-menu">
    <input type="hidden" name="id" value="" id="id-sub-menu">
    <div class="form-group">
        <label for="exampleFormControlFile1">Gambar</label>
        <input type="file" name="gambar" value="" id="gambar" class="form-control-file">
    </div>
    <div class="form-group">
        <label for="">Nama Pegawai<span class="required text-danger pl-1">*</span></label>
        <input type="text" class="form-control" value="" name="nama_pegawai" id="nama_pegawai">
        <div id="validationServer03Feedback" class="invalid-feedback nama_pegawai_error">
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group" id="options">
                <label class="control-label ">Posisi<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="posisi" id="posisi">
                    <option class="text-center">-- Pilih --</option>
                    <?php foreach ($posisi as $data_posisi) : ?>
                        <option value="<?= $data_posisi['id']; ?>"><?= $data_posisi['nama_posisi']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="options">
                <label class="control-label ">Level User<span class="required text-danger pl-1">*</span></label>
                <select class="form-control option" name="level_user" id="level_user">
                    <option class="text-center">-- Pilih --</option>
                    <?php foreach ($level as $data_level) : ?>
                        <option value="<?= $data_level['id']; ?>"><?= $data_level['level']; ?></option>
                    <?php endforeach; ?>
                </select>
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
            <div class="form-group">
                <label for="">Password<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="password" id="password">
                <div id="validationServer03Feedback" class="invalid-feedback password_error">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="">Konfirmasi Password<span class="required text-danger pl-1">*</span></label>
                <input type="text" class="form-control" value="" name="konfirmasi_password" id="konfirmasi_password">
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
    </div>
</form>
<script>
    $("#tambah-user").click(function(e) {
        const nama = $("#nama_pegawai").val();
        const posisi = $("#posisi").val();
        const gambar = $("#gambar").val();
        const username = $("#username").val();
        const password = $("#password").val();
        const konfirmasi_password = $("#konfirmasi_password").val();
        const level = $("#level_user").val();
        let is_active = $("#is_active").val();
        console.log(nama);
        $.ajax({
            url: "<?= base_url('menu/add_user'); ?>",
            type: "post",
            dataType: "json",
            data: {
                nama: nama,
                posisi: posisi,
                gambar: gambar,
                username: username,
                password: password,
                konfirmasi_password: konfirmasi_password,
                level: level,
                is_active: is_active
            },
            success: function(data) {
                if (data.response !== 'success') {
                    // if ($("#nama_pegawai").val() == "") {
                    //     $("#nama_pegawai").addClass("is-invalid");
                    //     $(".nama_pegawai_error").html(data.nama_pegawai);
                    // } else {
                    //     $("#nama_pegawai").removeClass("is-invalid")
                    // }
                    // if (data.nama_pegawai) {
                    //     $("#nama_pegawai").addClass("is-invalid");
                    //     $(".nama_pegawai_error").html(data.nama_pegawai);
                    // }

                    if (data.username) {
                        $("#username").addClass("is-invalid");
                        $(".username_error").html(data.username);
                    }


                    if (data.password) {
                        $("#password").addClass("is-invalid");
                        $(".password_error").html(data.password);
                    }


                    if (data.konfirmasi_password) {
                        $("#konfirmasi_password").addClass("is-invalid");
                        $(".konfirmasi_password_error").html(data.konfirmasi_password);
                    }

                    // if ($("#password").val() == "") {
                    //     $("#password").addClass("is-invalid");
                    //     $(".password_error").html(data.password);
                    // } else {
                    //     $("#password").removeClass("is-invalid")
                    // }

                    // if ($("#konfirmasi_password").val() == "") {
                    //     $("#konfirmasi_password").addClass("is-invalid");
                    //     $(".konfirmasi_password_error").html(data.konfirmasi_password);
                    // } else {
                    //     $("#konfirmasi_password").removeClass("is-invalid")
                    // }
                } else if(data.response == 'success'){
                    iziToast.success({
                        title: 'Success',
                        message: data.message,
                        position: 'topRight'
                    });
                    readAccessMenu();
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
</script>