<form method="post" id="submit_change">
    <input type="hidden" value="<?= $id_users; ?>" id="id_change">
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
    // $("#submit_change").submit(function(e){
    //     const data = $(this).serialize();
    //     console.log(data);
    //     e.preventDefault();
    // });
    $("#change-password").click(function(e) {
        e.preventDefault();
        const id_users = $("#id_change").val();
        const change_password_saat_ini = $("#change_password_saat_ini").val();
        const change_konfirmasi_password = $("#change_konfirmasi_password").val();
        const password_baru = $("#password_baru").val();
        $.ajax({
            url: "<?= base_url(); ?>menu/change_password",
            type: "post",
            dataType: "json",
            data: {
                id: id_users,
                change_password_saat_ini: change_password_saat_ini,
                change_konfirmasi_password: change_konfirmasi_password,
                change_password_baru: password_baru
            },
            success: function(data) {
                if (data.error) {
                    if (data.error.password1) {
                        $("#change_password_saat_ini").addClass("is-invalid");
                        $(".change_password_error").html(data.error.password1);
                    }

                    if (data.error.password2) {
                        $("#change_konfirmasi_password").addClass("is-invalid");
                        $(".change_konfirmasi_password_error").html(data.error.password2);
                    }

                    if (password_baru.length == 0) {
                        $("#password_baru").addClass("is-invalid");
                        $(".change_password_baru_error").html("Password baru wajib di isi");
                    } else {

                    }
                } else {
                    $("#change_password_saat_ini").removeClass("is-invalid");
                    $(".change_password_error").html("");
                    $("#change_konfirmasi_password").removeClass("is-invalid");
                    $(".change_konfirmasi_password_error").html("");
                    if (data.response == "password_not_verify") {
                        $("#change_password_saat_ini").addClass("is-invalid");
                        $(".change_password_error").html(data.message);
                    } else {
                        if (data.response == "password_matches") {
                            $("#password_baru").addClass("is-invalid");
                            $(".change_password_baru_error").html(data.message);
                        } else {
                            if (data.response == "min_length") {
                                $("#password_baru").addClass("is-invalid");
                                $(".change_password_baru_error").html(data.message);
                            } else {
                                if (data.response == "success") {
                                    iziToast.success({
                                        title: 'Success',
                                        message: data.message,
                                        position: 'topRight'
                                    });
                                    $("#password_baru").removeClass("is-invalid");
                                    $(".change_password_baru_error").html("");
                                } else {
                                    iziToast.error({
                                        title: 'Error',
                                        message: 'Ubah password gagal',
                                        position: 'topRight'
                                    });
                                }
                            }
                        }
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    });
</script>