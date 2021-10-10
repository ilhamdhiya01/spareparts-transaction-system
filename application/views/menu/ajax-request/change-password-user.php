<form method="post" class="access-menu">
    <div class="form-row align-items-center">
        <div class="col-sm-6 my-1">
            <label class="" for="inlineFormInputGroupUsername">Password Saat Ini</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-eye-slash"></i></div>
                </div>
                <input type="password" value="" class="form-control" name="change_password_saat_ini" id="change_password_saat_ini">
                <div id="validationServer03Feedback" class="invalid-feedback change_password_error">
                </div>
            </div>
        </div>
        <div class="col-sm-6 my-1">
            <label class="" for="inlineFormInputGroupUsername">Konfirmasi Password</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-eye-slash"></i></div>
                </div>
                <input type="password" value="" class="form-control" name="change_konfirmasi_password" id="change_konfirmasi_password">
                <div id="validationServer03Feedback" class="invalid-feedback change_konfirmasi_password_error">
                </div>
            </div>
        </div>
        <div class="col-sm-12 my-1">
            <label class="" for="inlineFormInputGroupUsername">Password Baru</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-eye-slash"></i></div>
                </div>
                <input type="password" value="" class="form-control" name="password_baru" id="password_baru">
                <div id="validationServer03Feedback" class="invalid-feedback change_password_baru_error">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-danger btn-sm float-right" id="change-password">Ubah Password</button>
    </div>
</form>
<script>
    $("#change-password").click(function(e) {
        e.preventDefault();
        const change_password_saat_ini = $("#change_password_saat_ini").val();
        const change_konfirmasi_password = $("#change_konfirmasi_password").val();
        const password_baru = $("#password_baru").val();
        $.ajax({
            url: "<?= base_url(); ?>menu/change_password",
            type: "post",
            dataType: "json",
            data: {
                change_password_saat_ini: change_password_saat_ini,
                change_konfirmasi_password: change_konfirmasi_password,
                change_password_baru: password_baru
            },
            success: function(data) {
                if (change_password_saat_ini.length <= 0) {
                    $("#change_password_saat_ini").addClass("is-invalid");
                    $(".change_password_error").html(data.required.password_saat_ini);
                } else if (change_password_saat_ini != change_konfirmasi_password) {
                    $("#change_password_saat_ini").addClass("is-invalid");
                    $(".change_password_error").html(data.matches.password_saat_ini);
                } else if (data.matches.password_verify == false) {
                    $("#change_password_saat_ini").addClass("is-invalid");
                    $(".change_password_error").html("Password yang anda masukan salah");
                } else {
                    $("#change_password_saat_ini").removeClass("is-invalid");
                    $(".change_password_error").html("");
                }


                if (change_konfirmasi_password.length == 0) {
                    $("#change_konfirmasi_password").addClass("is-invalid");
                    $(".change_konfirmasi_password_error").html(data.required.konfirmasi_password);
                } else if (change_konfirmasi_password != change_password_saat_ini) {
                    $("#change_konfirmasi_password").addClass("is-invalid");
                    $(".change_konfirmasi_password_error").html(data.matches.konfirmasi_password);
                } else {
                    $("#change_konfirmasi_password").removeClass("is-invalid");
                    $(".change_konfirmasi_password_error").html("");
                }

                if (password_baru.length == 0) {
                    $("#password_baru").addClass("is-invalid");
                    $(".change_password_baru_error").html(data.required.password_baru);
                } else if (password_baru == change_password_saat_ini) {
                    $("#password_baru").addClass("is-invalid");
                    $(".change_password_baru_error").html("Password baru tidak boleh sama dengan password lama");
                } else {
                    $("#password_baru").removeClass("is-invalid");
                    $(".change_password_baru_error").html("");
                }


                // if (change_password_saat_ini != change_konfirmasi_password) {
                //     $("#change_password_saat_ini").addClass("is-invalid");
                //     $(".change_password_error").html(data.matches.password_saat_ini);
                // } else {
                //     $("#change_password_saat_ini").removeClass("is-invalid");
                //     $(".change_password_error").html("");
                // }
                // if (data.matches) {
                //     if (change_password_saat_ini != change_konfirmasi_password) {
                // $("#change_password_saat_ini").addClass("is-invalid");
                // $(".change_password_error").html(data.matches.password_saat_ini);
                //     } else {
                // $("#change_password_saat_ini").removeClass("is-invalid");
                // $(".change_password_error").html("");
                //     }
                // }
                // if (data.error) {
                // if (data.error.password_saat_ini.length == 0) {
                // $("#change_password_saat_ini").addClass("is-invalid");
                // $(".change_password_error").html('Password saat ini tidak boleh kosong');
                // } else {
                // $("#change_password_saat_ini").removeClass("is-invalid");
                // $(".change_password_error").html("");
                // }

                //     if (data.error.konfirmasi_password.length == 0) {
                // $("#change_konfirmasi_password").addClass("is-invalid");
                // $(".change_konfirmasi_password_error").html('Konfirmasi password tidak boleh kosong');
                //     } else {
                // $("#change_konfirmasi_password").removeClass("is-invalid");
                // $(".change_konfirmasi_password_error").html("");
                //     }

                //     if (data.error.password_baru.length == 0) {
                // $("#password_baru").addClass("is-invalid");
                // $(".change_password_baru_error").html('Password baru tidak boleh kosong');
                //     } else {
                // $("#password_baru").removeClass("is-invalid");
                // $(".change_password_baru_error").html("");
                //     }
                // }
            }
        });
    });
</script>